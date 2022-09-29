

===================================================================================
            EXPORT BIG SELLER ORDERS TO EXCEL INVENTORY SYSTEM
===================================================================================


// Step 1
// * Paste This code to console
var script = document.createElement('script');
script.src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js";
document.getElementsByTagName('head')[0].appendChild(script);

var script = document.createElement('script');
script.src = "//unpkg.com/xlsx/dist/xlsx.full.min.js";
document.getElementsByTagName('head')[0].appendChild(script);


// Step 2
// * Paste This code to console
var order = [];


// Step 3
// * Paste This code to console
$("tbody > tr").each(function(){
    var sku = $(this).first().first().find('.col_3').text();
    var qty = $(this).first().first().find('.col_4').first().text();
     console.log(sku +'-'+ qty)

    order.push({'Sku': sku}, {"Qty":qty})
})


// Step 4
// * Paste This code to console
console.log(JSON.stringify(order))


// Step 5
// copy the result text
// Go to this website and paste the copied text
// https://www.convertcsv.com/json-to-csv.htm


// Step 6
// Click JSON to Excel