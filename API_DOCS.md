# Matilda's Beauty API Documentation

## Base URL
```
https://matildasbeauty.com
```

## Authentication

All endpoints require an API key passed as a request header.

| Header | Value |
|--------|-------|
| `X-Api-Key` | Your secret API key |

If the key is missing or wrong, you will receive:
```json
HTTP 401
{ "error": "Unauthorized" }
```

---

## Endpoints

### 1. Get Order Sources
Fetch the list of available order sources. You need this to get the correct `source_id` before creating an order.

```
GET /api/order-sources
```

**Headers**
```
X-Api-Key: your-secret-key
Accept: application/json
```

**Response `200`**
```json
[
  {
    "id": 1,
    "name": "Facebook",
    "type": "social",
    "description": "Orders from Facebook Ads",
    "color": "#ec4899"
  },
  {
    "id": 2,
    "name": "Instagram",
    "type": "social",
    "description": null,
    "color": "#a855f7"
  }
]
```

> Use the `id` from this response as the `source_id` when creating an order.

---

### 2. Create Order
Submit a new customer order.

```
POST /api/fbads/orders
```

**Headers**
```
X-Api-Key: your-secret-key
Content-Type: application/json
Accept: application/json
```

**Request Body**

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| `full_name` | string | Yes | Customer's full name |
| `phone_number` | string | Yes | Customer's mobile number |
| `address` | string | Yes | Customer's full delivery address |
| `product` | string | Yes | **Must always be `"MissTisa"`** |
| `promo` | string | Yes | Free text — the specific promo/variant ordered (see examples below) |
| `total` | number | Yes | Order total amount in Philippine Peso |
| `source_id` | integer | No | ID from the Get Order Sources endpoint |

**`promo` field examples**
```
"MissTisa_1pc"
"MissTisa_2pcs"
"1 Gold Serum"
"1 Soap + 1 Sunscreen"
"MissTisa 1pc + 1 Serum"
```

**Example Request**
```json
{
  "full_name": "Maria Santos",
  "phone_number": "09551234567",
  "address": "123 Rizal St, Brgy. Poblacion, Makati City",
  "product": "MissTisa",
  "promo": "MissTisa_1pc + 1 Gold Serum",
  "total": 1149,
  "source_id": 1
}
```

**Response `201` — Success**
```json
{
  "message": "Order created",
  "order_id": 142
}
```

**Response `422` — Validation Error**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "phone_number": ["The phone number field is required."],
    "product": ["The product field is required."]
  }
}
```

---

## Workflow

The recommended flow for creating an order:

```
1. GET  /api/order-sources       → pick the source_id for the channel
2. POST /api/fbads/orders        → submit the order with source_id
```

---

## Notes
- All orders are created with status `TO ENCODE` by default and will appear in the admin panel for staff to process.
- The `product` field must always be `"MissTisa"` — do not change this value.
- The `total` field is the final amount in Philippine Peso (e.g., `499`, `849`, `1149`).

---

## Mobile App Auth (Bearer Token, 1-Year)

This auth flow is for mobile app login using existing web user credentials.

### Auth Base
```
https://matildasbeauty.com/api/mobile-auth
```

### 1. Login
```
POST /api/mobile-auth/login
```

**Headers**
```
Content-Type: application/json
Accept: application/json
```

**Request Body**
| Field | Type | Required | Notes |
|-------|------|----------|-------|
| `email` | string | Yes | Existing user email |
| `password` | string | Yes | Existing user password |
| `device_name` | string | No | Example: `Android - Samsung A55` |

**Example Request**
```json
{
  "email": "user@example.com",
  "password": "your-password",
  "device_name": "Android - Samsung A55"
}
```

**Response `200`**
```json
{
  "message": "Login successful.",
  "token_type": "Bearer",
  "access_token": "plain_text_token_here",
  "expires_at": "2027-05-18 10:30:45",
  "user": {
    "id": 1,
    "first_name": "Reg",
    "last_name": "User",
    "email": "user@example.com",
    "role": "admin"
  }
}
```

Store `access_token` securely on device (Keychain/Keystore).

### 2. Get Current User (`me`)
```
GET /api/mobile-auth/me
```

**Headers**
```
Authorization: Bearer {access_token}
Accept: application/json
```

**Response `200`**
```json
{
  "user": {
    "id": 1,
    "first_name": "Reg",
    "last_name": "User",
    "email": "user@example.com",
    "role": "admin"
  }
}
```

### 3. Logout (Revoke Current Token)
```
POST /api/mobile-auth/logout
```

**Headers**
```
Authorization: Bearer {access_token}
Accept: application/json
```

**Response `200`**
```json
{
  "message": "Logged out successfully."
}
```

### Error Responses

**Invalid login credentials**
```json
HTTP 401
{
  "message": "Invalid credentials."
}
```

**Missing bearer token**
```json
HTTP 401
{
  "message": "Unauthorized. Missing bearer token."
}
```

**Invalid or expired token**
```json
HTTP 401
{
  "message": "Unauthorized. Invalid or expired token."
}
```

### Mobile Integration Flow
```
1. POST /api/mobile-auth/login
2. Save access_token securely
3. Send Authorization: Bearer {token} on protected calls
4. On 401 invalid/expired, force re-login
5. On user sign-out, call POST /api/mobile-auth/logout and clear local token
```

---

## Mobile Pancake Orders API

Fetch Pancake VIP orders for mobile app.  
Default behavior returns **today's data** (Asia/Manila timezone).

### Endpoint
```
GET /api/mobile-auth/pancake/orders
```

### Auth
Requires mobile bearer token from:
```
POST /api/mobile-auth/login
```

**Headers**
```
Authorization: Bearer {access_token}
Accept: application/json
```

### Query Parameters
| Field | Type | Required | Notes |
|-------|------|----------|-------|
| `date` | string | No | Format: `YYYY-MM-DD`. If omitted, API uses today's date. |

### Example Requests

**A) Default (today)**
```http
GET /api/mobile-auth/pancake/orders
Authorization: Bearer {access_token}
```

**B) Specific date**
```http
GET /api/mobile-auth/pancake/orders?date=2026-05-19
Authorization: Bearer {access_token}
```

### Response `200`
```json
{
  "date": "2026-05-19",
  "total": 2,
  "orders": [
    {
      "id": 101,
      "tracking_number": "JT0018027352301",
      "phone_number": "+639670661711",
      "customer": "Lyra Villanueva",
      "product_list": "SET + SERUM + LOTION + VSPerfume x 1",
      "workflow_stage": "sales",
      "status": "active",
      "created_at": "2026-05-19T01:23:45.000000Z"
    }
  ]
}
```

### Validation Error `422`
If invalid date format is sent:
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "date": [
      "The date does not match the format Y-m-d."
    ]
  }
}
```

### Unauthorized `401`
If bearer token is missing/invalid/expired:
```json
{
  "message": "Unauthorized. Invalid or expired token."
}
```

### Recommended Mobile Implementation
```
1. Login once via /api/mobile-auth/login and store token securely.
2. On screen load, call /api/mobile-auth/pancake/orders (no date) for today's list.
3. If user picks a date, call /api/mobile-auth/pancake/orders?date=YYYY-MM-DD.
4. If 401, redirect to login and clear local token.
```
