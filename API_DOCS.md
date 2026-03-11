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
