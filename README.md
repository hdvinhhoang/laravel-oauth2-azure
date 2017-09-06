# Oauth2 Azure login

This package is built based on this source [Azure Active Directory Provider for OAuth 2.0 Client](https://github.com/TheNetworg/oauth2-azure). 

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

Also, add the `Azure` facade to the `aliases` array in your `app` configuration file:

```php
'Azure' =>  VinhHoang\OAuth2\Facades\Azure::class
```

You will also need to add credentials for the OAuth services your application utilizes. These credentials should be placed in your `config/oauth2azure.php` configuration file:

```php
[
    'clientId'          => 'your-client-id',
    'clientSecret'      => 'your-client-secret',
    'redirectUri'       => 'your-redirect-uri',
    'tenant'            => 'your-tenant',
],
```

### Basic Usage

```php
<?php

namespace App\Http\Controllers;

use Azure;

class LoginController
{
    public function login()
    {
        return Azure::redirect();
    }

    public function handleCallback()
    {
        $token = Azure::getAccessToken('authorization_code', [
            'code' => $_GET['code'],
            'resource' => 'https://graph.windows.net',
        ]);

        try {
            // We got an access token, let's now get the user's details
              $me = Azure::get("me", $token);

        } catch (\Exception $e) {
            //
        }

        // Use this to interact with an API on the users behalf

        echo $token->getToken();
    }

    public function logout()
    {
        $redirect_url = "http://example.com";
        return redirect(Azure::getLogoutUrl($redirect_url));
    }
}
```

You will need to define routes to your controller methods:

```php
Route::get('login', 'LoginController@login');
Route::get('login/callback', 'LoginController@handleCallback');
Route::get('logout', 'LoginController@logout');
```


## Resource Owner
With version 1.1.0 and onward, the Resource Owner information is parsed from the JWT passed in `access_token` by Azure Active Directory. It exposes few attributes and one function.

**Example:**
```php
$resourceOwner = $provider->getResourceOwner($token);
echo 'Hello, '.$resourceOwner->getFirstName().'!';
```
The exposed attributes and function are:
- `getId()` - Gets user's object id - unique for each user
- `getEmail()` - Gets user's email - unique for each user
- `getFirstName()` - Gets user's first name
- `getLastName()` - Gets user's family name/surname
- `getTenantId()` - Gets id of tenant which the user is member of
- `getUpn()` - Gets user's User Principal Name, which can be also used as user's e-mail address
- `claim($name)` - Gets any other claim (specified as `$name`) from the JWT, full list can be found [here](https://azure.microsoft.com/en-us/documentation/articles/active-directory-token-and-claims/)