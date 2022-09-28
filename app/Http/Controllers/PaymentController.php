<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Transaction;
use App\TransactionPayment;
use App\TransactionProducts;
use App\Product;
use App\PaymentMethod;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Transactions\OrderSuccess;

class PaymentController extends Controller
{
    public $gateway;
 
    public function __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(false); //set it to 'false' when go live
    }
 
    public function index(){
        $seo = [
            'title' => "Checkout",
            'image' => "",
            'description' => "",
            'robots' => 'none',
        ];

        return view('payment', compact('seo'));
    }
 
    public function charge(Request $request) {
        $payment_method = $this->get_payment_method($request->payment_method);// get payment method

        if ($payment_method == 'COD') {
            return $this->cod($request);
        }

       $this->paypal($request);
    }

    public function get_payment_method($payment_method_id){
        return PaymentMethod::find($payment_method_id)->toArray()['name'];
    }
   
    public function cod($request){
        $markdown = $this->save_products($request);// save the transaction and get the markdown
        $markdown['payment_id'] = "LX-".strtoupper(Str::random(20));
        $markdown['payer_id'] = "N/A";
        $markdown['payer_email'] = $request->email;
        $markdown['currency'] = "PHP";
        $markdown['payment_status'] = 'completed';// set payment status and update to completed when user paid the amount
        $transaction_payment = TransactionPayment::create($markdown);

        $transaction = Transaction::with([
            "payments:id,transaction_id,shipping_fee,subtotal,total",
            "products",
            "products.product:id,title,price",
        ])->find($transaction_payment->id)->toArray();

        Mail::to([$transaction_payment->payer_email, 'shopickers007@gmail.com'])->send(new OrderSuccess($transaction));

        $seo = [
            'title' => "Order Success",
            'image' => "",
            'description' => "",
            'robots' => 'none',
        ];
            
        return view('pages.front.payment_success', [
            'order_number' => $transaction['order_number'],
            'total_amount' => number_format($transaction['payments']['total'], 2),
            'seo' => $seo
        ]);// redirect to success payment page
    }

    public function save_products($request){ // return total amount to charge
        $items_decode = json_decode(base64_decode($request->base64_item_details));

        $items = [];
        $shipping = 0;
        $subtotal = 0;

        $transaction = Transaction::create([
            'sold_from_id' => 1,// 1 = Sold from onsite/website
            'payment_method_id' => $request->payment_method,
            'user_id' => Auth::check()? Auth::id() : 0,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name, 
            "phone_number" => $request->phone_number,  
            "email" => $request->email, 
            "address" => $request->address,   
            "barangay" => $request->barangay,  
            "city" => $request->city,  
            "province" => $request->province,  
            "zip_code" => $request->zip_code,  
        ]);

        $transaction->update([
            'order_number' => generateOrderNumber($transaction['id'])
        ]);// Add transaction id

        // CREATE TRANSACTION PRODUCTS
        foreach ($items_decode as $item) {
            $products = Product::where('id', $item->id)->get()->toArray();

            $transaction->products()->create([
                'product_id' => $products[0]['id'],
                'price' => $products[0]['price'],
                'qty' => $item->qty,
                'subtotal' => ($products[0]['price'] * $item->qty),
            ]); // save item
            $subtotal += ($products[0]['price'] * $item->qty);// add subtotal
        }
        
        return [
            "transaction_id" => $transaction['id'],
            "shipping_fee" => $shipping,
            "subtotal" => $subtotal,
            "total" => ($shipping + $subtotal)
        ];
    }

    public function payment_success(){
    }

    public function paypal($request){
        if($request->input('submit')){
           try {
               $markdown = $this->save_products($request);// save the transaction and get the markdown

               $response = $this->gateway->purchase(array(
                   'amount' => $markdown['total'],
                   'currency' => currency_text(),
                   'returnUrl' => url('payment-success-paypal'),
                   'cancelUrl' => url('payment-error'),
               ))->send();// send the payload to paypal

               $markdown['payment_id'] = $response->getTransactionReference()?? '';
               $markdown['payment_status'] = 'declined';// set payment status and update to approved when user paid the amount
               TransactionPayment::create($markdown);

               if ($response->isRedirect()) {
                   $response->redirect(); // this will automatically forward the customer
               } else {
                   // not successful
                   return $response->getMessage();
               }
           } catch(Exception $e) {
               return $e->getMessage();
           }
       }
    }// not used yet

    public function payment_success_paypal(Request $request){
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
         
            if ($response->isSuccessful()){
                // The customer has successfully paid.
                $arr_body = $response->getData();
                
                // Insert transaction data into the database
                $update_payment = TransactionPayment::where('payment_id', $arr_body['id']);
                $payment = $update_payment->first();
                $update_payment->update([
                    'payment_id' => $arr_body['id'],
                    'payer_id' => $arr_body['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr_body['payer']['payer_info']['email'],
                    'total' => $arr_body['transactions'][0]['amount']['total'],
                    'currency' => currency_text(),
                    'payment_status' => "completed",
                ]);
                
                $transaction = Transaction::with([
                    "payments:id,transaction_id,shipping_fee,subtotal,total",
                    "products",
                    "products.product:id,title,price",
                ])->find($payment->id)->toArray();
                
                Mail::to([$transaction['email'], 'shopickers007@gmail.com'])->send(new OrderSuccess($transaction));

                $seo = [
                    'title' => "Order Success",
                    'image' => "",
                    'description' => "",
                    'robots' => 'none',
                ];
                    
                return view('pages.front.payment_success', [
                    'order_number' => $transaction['order_number'],
                    'total_amount' => number_format($transaction['payments']['total'], 2),
                    'seo' => $seo
                ]);// redirect to success payment page
                
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }// not used yet
    
    public function payment_error(){
        return redirect('/');
    }// not used yet
}