# UTCode for PHP

### Install via Composer
```$ composer require jotjunior/php-utcode:dev-master```

### Examples

#### Encoding an Array

```php
$array = [
    'id'        => 1,
    'firstName' => 'John',
    'lastName'  => 'doe',
    'ratio'     => 3.8,
    'category'  => [
        'id'   => 1234,
        'name' => 'Test User'
    ]
];
$code = new Encode($array);
echo $code, PHP_EOL;
```

#### Encoding a PHP Object

```php 
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
``` 

#### Encoding a JSON string
```php
$json
    = '{
   "id": 1,
   "firstName": "John",
   "lastName": "Doe",
   "ratio": 3.8,
   "category": {
       "id": 1234,
       "name": "Test User"
   }
}';
$code = new Encode($json);
echo $code, PHP_EOL;
```