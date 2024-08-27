<?php

namespace App\Providers;

use App\Http\View\Composers\User\SidebarComposer as userSidebar;
use App\Http\View\Composers\Web\FooterComposer;
use App\Http\View\Composers\Operator\SidebarComposer;
use App\Http\View\Composers\Operator\contentHeaderComposer;
use App\Http\View\Composers\Web\HeaderComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.operator.partial.sidebar' , SidebarComposer::class);
        View::composer('layouts.web.partial.footer' , FooterComposer::class);
        View::composer('layouts.web.panel.user.sidebar' , userSidebar::class);
        View::composer('layouts.web.partial.header' , HeaderComposer::class);
//        View::composer('layouts.operator.partial.content-header' , contentHeaderComposer::class);
    }
}
