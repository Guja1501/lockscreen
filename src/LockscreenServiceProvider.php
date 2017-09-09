<?php

namespace Rangoo\Lockscreen;

use Illuminate\Support\ServiceProvider;

class LockscreenServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->registerMiddleware();

		$this->loadConfig();
	}

	private function loadConfig() {
		$this->publishes([
			__DIR__ . '/config/lockscreen.php' => config_path('lockscreen.php')
		], 'lockscreen-config');
	}

	private function registerMiddleware() {
		/** @var \Illuminate\Routing\Router $router */
		$router = $this->app['router'];

		$router->aliasMiddleware('auth.locked', Middleware\RedirectIfNotLocked::class);
		$router->aliasMiddleware('auth.unlocked', Middleware\RedirectIfNotUnlocked::class);
	}
}
