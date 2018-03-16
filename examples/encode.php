<?php

require __DIR__ . '/autoload.php';

use UTCode\Encode;

// Encoding an Array
$array = [
    'id'        => 1,
    'firstName' => 'John',
    'lastName'  => 'Doe',
    'ratio'     => 3.8,
    'category'  => [
        'id'   => 1234,
        'name' => 'Test User'
    ]
];
$code = new Encode($array);
echo $code, PHP_EOL;

// Encoding and Object
$object = new \stdClass();
$object->id = 1;
$object->firstName = 'John';
$object->lastName = 'Doe';
$object->ratio = 3.8;
$object->category = new \stdClass();
$object->category->id = 1334;
$object->category->name = 'Test User';
$code = new Encode($object);
echo $code, PHP_EOL;

// Encoding a json string
$json
    = '{
   "category": {
       "id": 1234,
       "name": "Test User"
   },
   "firstName": "John",
   "id": 1,
   "lastName": "Doe",
   "ratio": 3.8
}';
$code = new Encode($json);
echo $code, PHP_EOL;

