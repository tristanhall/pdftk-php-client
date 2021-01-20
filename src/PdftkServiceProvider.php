<?php

namespace MinuteMan\PdftkClient;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

/**
 * Class PdftkServiceProvider
 *
 * @package MinuteMan\PdftkClient
 */
class PdftkServiceProvider extends ServiceProvider
{

    /**
     * Publish the configuration file.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/minuteman_pdftk_client.php' => $this->app->configPath('minuteman_pdftk_client.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ApiClient::class, function () {
            return new ApiClient(
                Config::get('minuteman_pdftk_client.endpoint_url', ''),
                Config::get('minuteman_pdftk_client.api_key', '')
            );
        });

        $this->app->bind(PdftkDocument::class, function (Application $app) {
            return new PdftkDocument($app->make(ApiClient::class));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [PdftkDocument::class];
    }

}