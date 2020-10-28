# Dillinger

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
        ->markAsDone(true, "Im done"),
```
