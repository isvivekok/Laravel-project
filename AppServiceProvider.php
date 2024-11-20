<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Blade;
use App\Models\Hospital;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    Schema::defaultStringLength(191);

    if (Schema::hasTable('hospitals')) {
        $setting = Hospital::first();
        view()->share(compact('setting'));
    } else {
        $setting = null;
    }

    Blade::directive('permission', function ($permission) {
        return "<?php if ( Auth::check() && in_array($permission, Auth::user()->role->permissions->pluck('name')->toArray())): ?>";
    });

    Blade::directive('endpermission', function () {
        return "<?php endif; ?>";
    });
}


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
