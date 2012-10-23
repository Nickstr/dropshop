<?php namespace Illuminate\Foundation\Providers;

use Swift_Mailer;
use Illuminate\Mail\Mailer;
use Illuminate\Support\ServiceProvider;
use Swift_SmtpTransport as SmtpTransport;

class MailServiceProvider extends ServiceProvider {

	/**
	 * Indicates if the service provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @param  Illuminate\Foundation\Application  $app
	 * @return void
	 */
	public function register($app)
	{
		$this->registerSwiftMailer($app);

		$app['mailer'] = $app->share(function($app)
		{
			// Once we have create the mailer instance, we will set a container instance
			// on the mailer. This allows us to resolve mailer classes via containers
			// for maximum testability on said classes instead of passing Closures.
			$mailer = new Mailer($app['view'], $app['swift.mailer']);

			$mailer->setContainer($app);

			return $mailer;
		});
	}

	/**
	 * Register the Swift Mailer instance.
	 *
	 * @param  Illuminate\Foundation\Application  $app
	 * @return void
	 */
	protected function registerSwiftMailer($app)
	{
		$config = $app['config']['mail'];

		$this->registerSwiftTransport($app, $config);

		// Once we have the transporter registered, we will register the actual Swift
		// mailer instance, passing in the transport instances, which allows us to
		// override this transporter instances during app start-up if necessary.
		$app['swift.mailer'] = $app->share(function($app)
		{
			return new Swift_Mailer($app['swift.transport']);
		});
	}

	/**
	 * Register the Swift Transport instance.
	 *
	 * @param  Illuminate\Foundation\Application  $app
	 * @param  array  $config
	 * @return void
	 */
	protected function registerSwiftTransport($app, $config)
	{
		$app['swift.transport'] = $app->share(function($app) use ($config)
		{
			extract($config);

			// The Swift SMTP transport instance will allow us to use any SMTP backend
			// for delivering mail such as Sendgrid, Amazon SMS, or a custom server
			// a developer has available. We will just pass this configured host.
			$transport = SmtpTransport::newInstance($host, $port);

			if (isset($encryption))
			{
				$transport->setEncryption($encryption);
			}

			// Once we have the transport we will check for the presence of a username
			// and password. If we have it we will set the credentials on the Swift
			// transporter instance so that we'll properly authenticate delivery.
			if (isset($username))
			{
				$transport->setUsername($username);

				$transport->setPassword($password);
			}

			return $transport;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function getProvidedServices()
	{
		return array('mailer', 'swift.mailer', 'swift.transport');
	}

}