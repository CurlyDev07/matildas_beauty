# GCash-Style PH Mobile Number Input

This guide explains how to use your reusable GCash-style Philippine mobile number input in Laravel.

---

## 1. Asset imports in Blade

Add these in your Blade file or main layout:

```blade
<link rel="stylesheet" href="{{ asset('js/gcash_mobile_number_input/gcash_mobile_number.css') }}">
<script src="{{ asset('js/gcash_mobile_number_input/gcash_mobile_number.js') }}" defer></script>
```

---

## 2. Example HTML

```html
<div class="ph-mobile-field" data-phone-field>
    <label class="phone-label">Mobile Number</label>

    <div class="phone-line">
        <div class="phone-prefix">+63</div>

        <div class="phone-input-wrap">
            <div class="phone-mask" data-phone-mask>123 456 7890</div>

            <input
                type="tel"
                name="phone_number"
                inputmode="numeric"
                autocomplete="tel"
                data-phone-input
                value="{{ old('phone_number') }}"
            >
        </div>
    </div>

    <small class="phone-message" data-phone-message></small>

    <input type="hidden" name="phone_number_full" data-phone-full>
</div>
```

---

## 3. What users can type

Users can type or paste common PH formats such as:

- `09171234567`
- `9171234567`
- `639171234567`
- `+639171234567`

Your JS normalizes them into the same clean result.

Visible input becomes:

- `917 123 4567`

Hidden full value becomes:

- `+639171234567`

---

## 4. How to get the mobile number

You have **2 values**:

### A. Visible input

```html
name="phone_number"
```

Example submitted value:

```text
917 123 4567
```

This is the formatted display value.

### B. Hidden normalized full number

```html
name="phone_number_full"
```

Example submitted value:

```text
+639171234567
```

This is the recommended value to save in your database.

---

## 5. Laravel controller example

```php
public function store(Request $request)
{
    $mobileNumber = $request->phone_number_full;

    // example save
    Customer::create([
        'phone_number' => $mobileNumber,
    ]);
}
```

Recommended:

```php
$mobileNumber = $request->phone_number_full;
```

---

## 6. If you want local PH format instead

If you prefer saving this format:

```text
09171234567
```

You can convert it in Laravel:

```php
$mobileNumber = $request->phone_number_full;
$localMobileNumber = $mobileNumber ? preg_replace('/^\+63/', '0', $mobileNumber) : null;
```

---

## 7. Recommended database format

Best practice is to store:

```text
+639171234567
```

Why:

- standardized format
- cleaner for SMS integrations
- easier to compare
- easier to normalize across systems

---

## 8. Validation example in Laravel

```php
$request->validate([
    'phone_number_full' => ['required', 'regex:/^\+639\d{9}$/'],
]);
```

This accepts only valid PH mobile numbers in full format.

---

## 9. Summary

### Use this for saving:

```php
$request->phone_number_full
```

### Example saved value:

```text
+639171234567
```

### Visible input shown to user:

```text
917 123 4567
```

