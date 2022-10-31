<?php

namespace App\Providers;

use App\Models\Contact;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer([
            'Layoutss.sidebar',
            'contact.index'
        ], function ($view) {
            return $view->with('contactCount',Contact::latest("id")->get());
        });
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
