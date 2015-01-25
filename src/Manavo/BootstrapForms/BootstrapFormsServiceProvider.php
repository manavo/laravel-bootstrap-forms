<?php namespace Manavo\BootstrapForms;

use Illuminate\Html\HtmlServiceProvider as IlluminateHtmlServiceProvider;

class BootstrapFormsServiceProvider extends IlluminateHtmlServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$laravel = app();
		if (version_compare($laravel::VERSION, '4.2', '<='))
		{
			$this->package('manavo/bootstrap-forms');
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function registerFormBuilder()
	{
		$this->app->bindShared('form', function($app)
		{
			$form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

			return $form->setSessionStore($app['session.store']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
