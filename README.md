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

[Rangoo\Lockscreen\Traits\LockscreenMethods](https://github.com/Guja1501/lockscreen/blob/v1.0.1/src/Traits/LockscreenMethods.php)

```php
// Controller

use Illuminate\Routing\Controller;
use Rangoo\Lockscreen\Traits\LockscreenMethods;

class LockscreenController extends Controller {
	use LockscreenMethods;
}
```

```php
// Routes

// Init routes for lockscreen methods
Route::get('/lockscreen', 'LockscreenController@showUnlockForm')->middleware('auth.locked');
Route::post('/lockscreen', 'LockscreenController@lock')->middleware('auth.unlocked');
Route::delete('/lockscreen', 'LockscreenController@unlock')->middleware('auth.locked');

// If any guard: 'auth.unlocked:guard1,guard2,guard3'
Route::middleware('auth.unlocked')->group(function(){
  // Routes goes here
  // Where must be logged in and unlocked
});
```

***auth.lock blade***
```blade
<form action="{{ url('/lockscreen') }}" method="post">
   {{ csrf_field() }}
   <input name="_method" type="hidden" value="DELETE">
   <h3>{{ auth()->user()->name }}, are you here?</h3>
   <input type="password" name="password"/>
   <input type="submit" value="Unlock" />
</form>
```

***layout blade***

```blade
<html>
  <head>
    <script>
      window.Lockscreen = {
        locked: {{ session()->get('lockscreen', 0) }},
        route: '{{ url('/lockscreen') }}',
      };
    </script>
  </head>
  <body>
    
    <!-- include javascript -->
  </body>
</html>
```

***webpack***

In this example using packages: [SensorAFK](https://github.com/Guja1501/sensor-afk), [axios](https://github.com/axios/axios)

```js
const SensorAFK = require('sensor-afk');
const axios = require('axios');

if(!window.Lockscreen.locked){
  new SensorAFK({
    callback: () => {
      axios.post(window.Lockscreen.route)
        .then(() => {
          location.reload();
        })
        .catch(() => {
          alert('something went wrong');
        });
    }
  });
}
```

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/Guja1501/lockscreen/tags). 

## Authors

* **Guja Babunashvili** - *Initial work* - [Guja1501](https://github.com/Guja1501)

* **Vakho Nakashidze** - [vakhovakho](https://github.com/vakhovakho)

* **Ricardo Simão** - [rpsimao](https://github.com/rpsimao)

* **Fernando Parada** - [fernandoparada18](https://github.com/fernandoparada18)

See also the list of [contributors](https://github.com/Guja1501/lockscreen/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
