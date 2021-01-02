<?php

namespace PWWEB\Jira;

use Carbon\Carbon;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

/**
 * PWWEB\Jira
 *
 * Jira Service Provider.
 *
 * @author    FP <fp@pw-websolutions.com>
 * @author    RAB <rab@pw-websolutions.com>
 * @copyright 2021 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class JiraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfiguration();

        parent::register();
    }

    /**
     * Boostrap the services of the package.
     *
     * @return void
     */
    public function boot()
    {
        if (true === function_exists('config_path')) {
            $this->publishConfiguration();
        }

        $this->commands(
            [
                Commands\CheckIntegration::class,
            ]
        );

        $loader->alias('Jira', \PWWEB\Jira\Facades\Jira::class);
    }

    /**
     * Register configuration for the package.
     *
     * @return void
     */
    protected function registerConfiguration(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/resources/config/jira.php',
            'pwweb.jira'
        );
    }

    /**
     * Publishes the configuration file for the package to allow for alterations.
     *
     * @return void
     */
    protected function publishConfiguration(): void
    {
        $this->publishes(
            [
                __DIR__.'/resources/config/jira.php' => config_path('pwweb/jira.php'),
            ],
            'pwweb.jira.config'
        );
    }
}
