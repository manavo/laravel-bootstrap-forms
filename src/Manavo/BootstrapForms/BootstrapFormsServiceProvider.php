<?php namespace Manavo\BootstrapForms;

use Collective\Html\HtmlServiceProvider as CollectiveHtmlServiceProvider;

class BootstrapFormsServiceProvider extends CollectiveHtmlServiceProvider
{

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
        $app = $this->app;
        if (version_compare($app::VERSION, '5.0') < 0) {
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
        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'],
                $app['view'], $app['session.store']->getToken());

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
