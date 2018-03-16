<?php

require __DIR__ . '/autoload.php';

use UTCode\Encode;

// UTCoding a PHP Array
$json
    = '{
  "id": "MLB727873516",
  "site_id": "MLB",
  "seller_id": 159165037,
  "title": "Cártamo + Chia Termogênico 6 Potes De 60 Caps De 1000mg Cada",
  "buying_mode": "buy_it_now",
  "price": 189.99,
  "available_quantity": 42,
  "sold_quantity": 0,
  "total_sales": 0.0,
  "official_store_id": null,
  "condition": "new",
  "listing_type_id": "gold_pro",
  "currency_id": "BRL",
  "shipping": {
    "free_shipping": true,
    "mode": "me2",
    "tags": [],
    "logistic_type": "drop_off"
  },
  "timestamp": "2018-03-15T00:44:48.577455",
  "category_id": "MLB194985",
  "main_category": "MLB194985",
  "manufacturer": "Vitaminas",
  "model": "Óleo de Cartamo",
  "type": "suplemento",
  "seller": {
    "power_seller_status": "silver",
    "level_id": "5_green",
    "nickname": "DACOSTARODRIGOLUIZ",
    "store_name": null
  },
  "country": "BR",
  "city": "Curitiba",
  "free_shipping": true,
  "ratings": {
    "negative": 0.02,
    "neutral": 0.01,
    "positive": 0.97
  },
  "state": "PR",
  "transactions": {
    "total": 6006,
    "completed": 5869
  },
  "start_time": "2015-12-07T18:37:48.000Z",
  "cumulative_sold_quantity": 0
}';

$code = new Encode(\json_decode($json, JSON_OBJECT_AS_ARRAY));
echo $code, PHP_EOL;
