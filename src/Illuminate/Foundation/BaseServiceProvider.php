<?php namespace Illuminate\Foundation;

use Silex\ServiceProviderInterface;

class BaseServiceProvider implements ServiceProviderInterface {

	/**
	 * Register the service provider.
	 *
	 * @param  Silex\Application  $app
	 * @return void
	 */
	public function register(\Silex\Application $app)
	{
		// The Illuminate file system provides a nice abstraction over the file
		// system, which makes testing code that gets or puts files on disk
		// much easier, since the file systems can easily be mocked out.
		$app['files'] = $app->share(function()
		{
			return new \Illuminate\Filesystem;
		});

		// The Illuminate event dispatcher provides a simpler, yet powerful way
		// to build de-coupled systems using events, including queueing and
		// flushing events. We'll go ahead and register a shared object.
		$app['events'] = $app->share(function()
		{
			return new \Illuminate\Events\Dispatcher;
		});

		// The Illuminate encrypter service provides a nice, convenient wrapper
		// around the mcrypt encryption library. By default, strong AES-256
		// encryption is provided out of the box. Just be sure to change
		// your application key, as strong encryption depends on it!
		$app['encrypter.key'] = 'YourSecretKey';

		$app['encrypter'] = $app->share(function() use ($app)
		{
			$key = $app['encrypter.key'];

			return new \Illuminate\Encrypter(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC, $key);
		});

		// The Illuminate session library provides a variety of simple, clean
		// session drivers for use by your application. By default, we'll
		// use the light Cookie driver for convenience and simplicity.
		$app['session'] = $app->share(function() use ($app)
		{
			return new \Illuminate\Session\CookieStore($app['encrypter'], $app['cookie']);
		});
	}

}