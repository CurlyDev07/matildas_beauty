# Fraud Shield Usage Guide

This file explains how to use:

- `public/js/fraud/fraud-shield.js`

It is a plug-and-play frontend helper for:

- FingerprintJS visitor ID generation
- Blocklist checking (`/order-signal/check-block-user`)
- Attempt counting for blocked users (`/order-signal/attempt-count`)
- Popup display for blocked users
- Order signal sending (`/order-signal`)
- Local anti-spam order limit check

---

## 1) Include the script

In your Blade or HTML page:

```html
<script src="{{ asset('js/fraud/fraud-shield.js') }}"></script>
```

---

## 2) Create an instance

```html
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fraud = window.FraudShield.create({
        website: 'matildasbeauty.com',
        sessionId: 'sess_server_abc123',

        endpoints: {
            checkBlock: '/order-signal/check-block-user',
            attemptCount: '/order-signal/attempt-count',
            collectSignal: '/order-signal'
        },

        selectors: {
            fullName: '#full_name',
            phoneNumber: '#phone_number'
        },

        popup: {
            enabled: true,
            title: 'Unusual Activity Detected',
            message: 'We detected an unsual activity. If you still want to order, click the button below.',
            buttonText: 'Order in Messenger',
            buttonLink: 'https://m.me/262215796983675'
        },

        lockRules: {
            maxSamePromoPerDay: 1,
            maxTotalPerDay: 3,
            lockDays: 3
        },

        debug: true,
        autoShowPopupOnBlocked: true,
        autoRegisterAttemptOnBlocked: true
    });

    fraud.init().then(function (state) {
        console.log('Fraud state:', state);
        // state = {
        //   fingerprintjs_visitor_id,
        //   blocked,
        //   attempt_count,
        //   last_attempt_at
        // }
    });
});
</script>
```

---

## 3) Guard submit if blocked

Add this at the top of your submit handler:

```js
$('form').on('submit', function (e) {
    if (!fraud.guardSubmitIfBlocked(e)) {
        return;
    }

    // continue normal submit flow
});
```

---

## 4) Send order signal after successful order

```js
fraud.sendOrderSignal({
    fb_ads_id: 49070,
    promo: 'MissTisaMelasma_1_Set',
    full_name: $('#full_name').val(),
    phone_number: $('#phone_number').val(),
    website: 'matildasbeauty.com',
    session_id: 'sess_backend_abc123'
}).then(function (res) {
    console.log('order signal response:', res);
});
```

---

## 5) Optional local anti-spam rule

Use this when deciding whether to continue purchase UI flow:

```js
const isAllowed = fraud.validateAndRecordOrder('MissTisaMelasma_1_Set');

if (!isAllowed) {
    alert('Order limit reached. Our team will contact you shortly.');
    return;
}
```

---

## 6) Read current state anytime

```js
const state = fraud.getState();
console.log(state.blocked);         // true/false
console.log(state.attempt_count);   // number
console.log(state.last_attempt_at); // unix timestamp or null
```

---

## Minimal copy-paste example

```html
<script src="{{ asset('js/fraud/fraud-shield.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    window.fraud = window.FraudShield.create({
        website: '{{ $website }}',
        sessionId: '{{ $session_id }}',
        debug: true
    });

    window.fraud.init();

    $('form').on('submit', function (e) {
        if (!window.fraud.guardSubmitIfBlocked(e)) return;

        // your AJAX submit here...
    });
});
</script>
```

---

## Notes

- `attemptCount` endpoint is called automatically when blocked (if `autoRegisterAttemptOnBlocked = true`).
- `collectSignal` is not automatic; call `sendOrderSignal(...)` where your order succeeds.
- This is frontend protection + tracking. Always enforce final blocking on backend endpoints too.
