# Laravel Bootstrap Forms

Using [@stidges](https://github.com/stidges)' code for bootstrap forms to create a composer package. You can find the original article here: http://blog.stidges.com/post/easy-bootstrap-forms-in-laravel

## Install

```
composer require manavo/laravel-bootstrap-forms ~0.0
```

## Configure

```php
<?php
// File: app/config/app.php

return array(
    // ...
    'providers' => array(
        // ...
        // 'Illuminate\Html\HtmlServiceProvider',
        'Manavo\BootstrapForms\BootstrapFormsServiceProvider',
        // ...
    ),
    // ...
);
```
