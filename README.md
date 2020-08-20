 Auth with Facebook  Laravel package for Jubilee interview 
-



System requirement
-
PHP >= 7.2
Laravel >=5.0

Installation
-
You can install derek/jubilee-laravel-auth via Composer by adding "derek/jubilee-laravel-auth": "^1.0" as requirement to your composer.json.     
     
     composer require derek/jubilee-laravel-auth 

Service Provider
-
If you are using Laravel 5.5 or higher the package will automatically register itself. 

Otherwise you need to add Jubilee\Click108\TwelveConstellationsProvider to 

your [providers](https://laravel.com/docs/master/providers#registering-providers) array.
 
Then you will have access to the services above.

This package has configuration files which can be configured to your needs.

    php artisan vendor:publish --provider="Jubilee\Auth\AuthProvider"
    php artisan vendor:publish --provider="Jubilee\Auth\FacebookProvider"

After run command you can find config file in config/custom_auth.php and config/facebook.php, 
in this file you can change logged or registered redirect url and setting 
facebook client_id and client_secret and redirect_url(host_url/auth/facebook/feedback)
at env 

    JUBILEE_AUTHED_HOME_URL=
    JUBILEE_FACEBOOK_CLIENT_ID=
    JUBILEE_FACEBOOK_CLIENT_REDIRECT_URL=

Database
-
Setup your database migrations for the auth user table and Seed

    php artisan migrate 
    php artisan db:seed --class=CreateUsersTable
        

      
 
