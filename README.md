# Laravel Bootstrap Forms

Using @stidges' code for bootstrap forms to create a composer package. You can find the original article here: http://blog.stidges.com/post/easy-bootstrap-forms-in-laravel

## Install

```
composer require manavo/laravel-bootstrap-forms dev-master
```

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
