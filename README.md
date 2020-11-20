# Dynamic field

Laravel Nova Dynamic field

# Installation :

```sh
composer require haythem/dynamic-field
```

# How to use it :

create an end-point first

```php
    Route::get('/dynamicfield', function () {
        return [
        "value" => rand(0, 100) . "%",
        "show" => true, "stop" => false,
        "showAnimation" => true,
        "showValue" => true];
    });
```

Add the field

```php
   DynamicField::make("Dynamic Field")
       ->endPoint('/dynamicfield')
        ->callEvery(500) // time in ms
        ->badgesMap([ "5"=>"primary","1"=>"success", "2"=>"danger", "3"=>"warning", "4"=>"info","6"=>"#71504e"]) // if you need to make it a badge
        ->markAsDone(true, "Im done"),
```
