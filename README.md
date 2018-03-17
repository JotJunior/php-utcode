# UTCode for PHP

### Install via Composer
```shell
$ mkdir project_name
$ cd project_name
$ composer require jotjunior/php-utcode:dev-master
```

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

Result:
```ut:d:k2:idi:1ek9:firstNameu8:Sm9obg==k8:lastNameu4:RG9lk5:ratiof:3.800000zk8:categoryd:k2:idi:1234ek4:nameu12:VGVzdCBVc2Vyee```

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

Result:
```ut:d:k2:idi:1ek9:firstNameu8:Sm9obg==k8:lastNameu4:RG9lk5:ratiof:3.800000zk8:categoryd:k2:idi:1234ek4:nameu12:VGVzdCBVc2Vyee```

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

Result:
```ut:d:k2:idi:1ek9:firstNameu8:Sm9obg==k8:lastNameu4:RG9lk5:ratiof:3.800000zk8:categoryd:k2:idi:1234ek4:nameu12:VGVzdCBVc2Vyee```
