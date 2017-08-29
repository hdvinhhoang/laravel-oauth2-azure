<?php
namespace VinhHoang\OAuth2;
use Illuminate\Support\ServiceProvider;

class AzureServiceProvider extends ServiceProvider{

    public function boot(){
        $this->publishes([
            __DIR__ . '/Config/oauth2azure.php' => config_path('oauth2azure.php')
        ]);
    }
}
