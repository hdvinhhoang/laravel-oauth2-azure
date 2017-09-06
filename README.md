# Oauth2 Azure login

## Installation

To install, use composer:

```
composer require vinhhoang/oauth2-azure
```

### Configuration

After installing the Socialite library, register the `VinhHoang\OAuth2\AzureServiceProvider` in your `config/app.php` configuration file:

```php
'providers' => [
    // Other service providers...

    VinhHoang\OAuth2\AzureServiceProvider::class,
],
```