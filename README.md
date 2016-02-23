# Laravel Bootstrap Forms

Using [@stidges](https://github.com/stidges)' code for bootstrap forms to create a composer package. You can find the original article here: http://blog.stidges.com/post/easy-bootstrap-forms-in-laravel

Note this is not compatible with Laravel < 5.2.

## Install

```
composer require manavo/laravel-bootstrap-forms ~0.1
```

## Configure

Make sure you comment out the existing HtmlServiceProvider (Collectve\Html\HtmlServiceProvider):

```php
<?php
// File (Laravel 5): config/app.php

return array(
    // ...
    'providers' => array(
        // ...
        // 'Collective\Html\HtmlServiceProvider',
        'Manavo\BootstrapForms\BootstrapFormsServiceProvider',
        // ...
    ),
    // ...
);
```

No change is necessary for the Form Facade.

## Example

```
{!! Form::open([ 'route' => 'posts.store' ]) !!}

    {!! Form::openGroup('title', 'Title') !!}
        {!! Form::text('title') !!}
    {!! Form::closeGroup() !!}

    {!! Form::openGroup('status', 'Status') !!}
        {!! Form::select('status', $statusOptions) !!}
    {!! Form::closeGroup() !!}

{!! Form::close() !!}
```
