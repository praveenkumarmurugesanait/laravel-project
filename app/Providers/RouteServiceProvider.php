<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home'; // or '/dashboard'

    public function boot(): void
    {
        parent::boot();
    }
}
