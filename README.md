# Lockscreen

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/Guja1501)
[![Latest Stable Version](https://poser.pugx.org/rangoo/lockscreen/v/stable)](https://packagist.org/packages/rangoo/lockscreen)
[![Total Downloads](https://poser.pugx.org/rangoo/lockscreen/downloads)](https://packagist.org/packages/rangoo/lockscreen)
[![License](https://poser.pugx.org/rangoo/lockscreen/license)](https://packagist.org/packages/rangoo/lockscreen)

[rangoo/lockscreen](https://packagist.org/packages/rangoo/lockscreen) is Package for [Laravel](https://laravel.com) on [Packagist](https://packagist.org)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

```
composer require rangoo/lockscreen
```

### Help

Lockscreen Middlewares `auth.locked` and `auth.unlocked` is extended to `auth` Middleware

`auth.locked` middleare means that user must be **locked**

`auth.unlocked` middleware means that user must be **unlocked**

Both of them means user must be **logged in**.

### Examples

```php
Route::middleware('auth.unlocked')->group(function(){
  // Routes goes here
});
```

```php
Route::get('/lockscreen', 'LockscreenController@lockscreen')->middleware('auth.locked');
```

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/Guja1501/lockscreen/tags). 

## Authors

* **Guja Babunashvili** - *Initial work* - [Guja1501](https://github.com/Guja1501)

See also the list of [contributors](https://github.com/Guja1501/lockscreen/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
