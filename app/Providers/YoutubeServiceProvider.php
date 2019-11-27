<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class YoutubeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(\Google_Service_YouTube::class, function ($app) {
            $client = new \Google_Client(config('google'));

            return new \Google_Service_YouTube($client);
        });
    }

}
