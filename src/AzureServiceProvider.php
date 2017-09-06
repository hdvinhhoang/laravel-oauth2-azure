<?php

namespace VinhHoang\OAuth2;

use App;
use Illuminate\Support\ServiceProvider;

class AzureServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/oauth2azure.php' => config_path('oauth2azure.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('azure', function () {
            return new \VinhHoang\OAuth2\Client\Provider\Azure;
        });
    }
}
