<?php

namespace Rangoo\Lockscreen;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LockscreenServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->loadRoutes()
			->setUpBlade();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this
			->registerMiddleware()
			->loadConfig();
	}

	private function loadConfig() {
		$this->publishes([
			__DIR__ . '/config/lockscreen.php' => config_path('lockscreen.php')
		], 'lockscreen-config');

		return $this;
	}

	private function registerMiddleware() {
		/** @var \Illuminate\Routing\Router $router */
		$router = $this->app['router'];

		$router->aliasMiddleware('locked', Middleware\RedirectIfUnlocked::class);
		$router->aliasMiddleware('unlocked', Middleware\RedirectIfLocked::class);

		return $this;
	}

	private function loadRoutes() {
		$this->loadRoutesFrom(__DIR__ . 'routes/web.php');

		return $this;
	}

	private function setUpBlade() {
		Blade::if('lockscreen', function ($status) {
			if(gettype($status) === 'string') {
				$status = $status === 'locked';
			}

			return $status === session()->get(config('lockscreen.name', 'lockscreen'), false);
		});

		Blade::if('locked', function () {
			return session()->get(config('lockscreen.name', 'lockscreen'), false);
		});

		Blade::if('unlocked', function () {
			return !session()->get(config('lockscreen.name', 'lockscreen'), false);
		});
	}
}
