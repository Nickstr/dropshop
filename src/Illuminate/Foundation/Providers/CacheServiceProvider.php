<?php namespace Illuminate\Foundation\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Cache\MemcachedConnector;
use Illuminate\Foundation\Managers\CacheManager;

class CacheServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @param  Illuminate\Foundation\Application  $app
	 * @return void
	 */
	public function register(Application $app)
	{
		$app['cache'] = $app->share(function($app)
		{
			return new CacheManager($app);
		});

		$app['memcached.connector'] = $app->share(function()
		{
			return new MemcachedConnector;
		});
	}

}