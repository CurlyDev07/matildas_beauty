



    <!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '375777585581364');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=375777585581364&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->

{{-- =================== TIKTOK PIXEL AND VIEW CONTENT  =================== --}}

<!-- TikTok Pixel Code Start -->
<script>
    !function (w, d, t) {
      w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
    var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
    ;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
    
    
      ttq.load('CSCC313C77UAC5GF74F0');
      ttq.page();
    }(window, document, 'ttq');
    </script>
    <!-- TikTok Pixel Code End -->


<script> // TIKTOK PIXEL VIEW CONTENT
    // add this before event code to all pages where PII data postback is expected and appropriate 
    ttq.identify({
        "email": "", // string. The email of the customer if available. It must be hashed with SHA-256 on the client side.
        "phone_number": "", // string. The phone number of the customer if available. It must be hashed with SHA-256 on the client side.
        "external_id": "2536" // string. Any unique identifier, such as loyalty membership IDs, user IDs, and external cookie IDs.It must be hashed with SHA-256 on the client side.
    });


    ttq.track('ViewContent', {
        "contents": [
            {
                "content_id": "10225", // string. ID of the product. Example: "1077218".
                "content_type": "product", // string. Either product or product_group.
                "content_name": "gingerOil" // string. The name of the page or product. Example: "shirt".
            }
        ],
        "value": "0", // number. Value of the order or items sold. Example: 100.
        "currency": "PHP" // string. The 4217 currency code. Example: "USD".
    });
</script>

{{-- =================== TIKTOK PIXEL AND VIEW CONTENT  =================== --}}