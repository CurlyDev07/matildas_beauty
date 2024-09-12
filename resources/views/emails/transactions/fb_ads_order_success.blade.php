<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FB ADS</title>
    
  </head>
  <body style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;background-color:#f5f5f5;">
    <div class="email-container" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;font-size:14px;line-height:1.45;font-family:'Arial', 'Helvetica', 'sans-serif', '-apple-system';color:black;padding:30px;width:100%;max-width:800px;margin-left:auto;margin-right:auto;background-color:white;border:1px solid #eeeeee;">
      <div class="logo-container" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;text-align:center;margin-bottom:15px;">
        <img src="https://matildasbeauty.com/images/logo/main.png" alt="Matilda's Beauty Logo" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;max-width:146px;height:auto;"/>
    </div>
      <h1 style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;font-size:24px;font-weight:bold;text-align:center;color:grey;margin-bottom:15px;">Your order is being processed</h1>
      <div class="delivery-truck" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;width:100%;max-width:64px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
        <img src="https://matildasbeauty.com/images/etc/truck.png" alt="Truck" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;max-width:100%;height:auto;"/>
    </div>
      <!-- <div class="view-order" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;text-align:center;margin-bottom:30px;">
        <a href="#" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;background-color:#2d7bbf;padding:8px 15px;color:white;text-decoration:none;border-radius:3px;">View Order</a>
      </div> -->
      <div class="order-details" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;background-color:#f5f5f5;border:1px solid #eeeeee;border-bottom:0;border-right:0;font-size:0;margin-bottom:30px;">
        <div class="summary" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;width:100%;max-width:368px;height:141px;font-size:14px;padding:20px;vertical-align:top;border-bottom:1px solid #eeeeee;border-right:1px solid #eeeeee;">
          <div class="title" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;text-transform:uppercase;font-weight:bold;margin-bottom:5px;">Summary</div>
          <div class="summary-row" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
            <div class="label" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;margin-bottom:5px;width:24%;color:grey;">Ref No.:</div>
            <div class="value" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;margin-bottom:5px;width:73%;color:grey;">
              {{ $order['order_number'] }}
            </div>
          </div>
          <div class="summary-row" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
            <div class="label" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;margin-bottom:5px;width:24%;color:grey;">Date:</div>
            <div class="value" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;margin-bottom:5px;width:73%;color:grey;">
              {{ $order['date'] }}
            </div>
          </div>
          <div class="summary-row" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
            <div class="label" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;margin-bottom:5px;width:24%;color:grey;">Total:</div>
            <div class="value" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;margin-bottom:5px;width:73%;color:grey;">Php 
              {{ number_format($order['amount'] ,2) }}
            </div>
          </div>
        </div>
        <div class="address" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;width:100%;max-width:368px;height:141px;font-size:14px;padding:20px;vertical-align:top;border-bottom:1px solid #eeeeee;border-right:1px solid #eeeeee;">
          <div class="title" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;text-transform:uppercase;font-weight:bold;margin-bottom:5px;">Shipping Address</div>
          <div class="value" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;color:grey;">
            {{ $order['address'] }}
          </div>
        </div>
      </div>
      <div class="items-container" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
        <table style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;width:100%;border-collapse:collapse;">
          <thead style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
            <tr style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
              <th style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;background-color:#f5f5f5;border:1px solid #eeeeee;padding:5px 10px;text-align: left;">Items</th>
              <th style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;background-color:#f5f5f5;border:1px solid #eeeeee;padding:5px 10px;text-align: center;">Qty</th>
              <th style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;background-color:#f5f5f5;border:1px solid #eeeeee;padding:5px 10px;text-align: center; width: 125px;">Price</th>
            </tr>
          </thead>
          <tbody style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
              <tr style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
                <td style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:10px;border-bottom:1px solid #eeeeee;color:grey;">
                  <div class="item-image" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;width:100%;max-width:90px;display:inline-block;vertical-align:middle;padding-right:15px;">
                    <img src="https://matildasbeauty.com/images/logo/main.png" alt="logo" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;max-width:100%;height:auto;"/>
                </div>
                  <div class="item-name" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;display:inline-block;width:75%;vertical-align:middle;">{{ $order['promo'] }}</div>
                </td>
                <td style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:10px;border-bottom:1px solid #eeeeee;color:grey;text-align: center;">1</td>
                <td style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:10px;border-bottom:1px solid #eeeeee;color:grey;text-align: center; color: #2d7bbf; font-weight: bold;">Php {{ number_format($order['amount'] ,2) }}</td>
              </tr>
          </tbody>
          <tfoot style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
            <tr style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
              <td colspan="2" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;text-align: right; padding-top: 20px;">
                Subtotal:
              </td>
              <td style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;text-align: center; padding-top: 20px; color: grey;">
                Php 
                {{ number_format($order['amount']) }}
              </td>
            </tr>
            <tr style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
              <td colspan="2" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;text-align: right;">
                Shipping Fee:
              </td>
              <td style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;text-align: center; color: grey;">
                Php 
                {{ number_format(0, 2) }}
              </td>
            </tr>
            {{-- <tr style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
              <td colspan="2" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;text-align: right;">Estimated Tax:</td>
              <td style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;text-align: center; color: grey;">Php 100.00</td>
            </tr> --}}
            <tr style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">
              <td colspan="2" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;font-weight: bold; text-align: right;">
                Total:
              </td>
              <td style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;padding:3px 10px;font-weight: bold; color: #2d7bbf; text-align: center;">
                Php 
                {{ number_format($order['amount'], 2) }}
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="cta-container" style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;background-color: #2d7bbf;color: #ffffff;text-align:center;margin-top:20px;padding:10px;">Call us at <strong style="margin:0;padding:0;border:0;outline:none;box-sizing:border-box;">0955-009-0156</strong> or reply to this email</div>
    </div>
  </body>
</html>