<?php

namespace VinhHoang\OAuth2\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laravel\Socialite\SocialiteManager
 */
class Azure extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'azure';
    }
}
