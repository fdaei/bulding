<?php

namespace App\Http\View\Composers\User;


use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SidebarComposer
{
    private function sidebar(): array
    {
        return [
            [
                "title" => "داشبورد",
                "icon" => "fal fa-tachometer-alt",
                "link" => route("user.dashboard"),
                "is_active" => $this->checkIsActive(["dashboard"]) ? "active" : "",
            ],
            [
                "title" => "پروفایل",
                "icon" => "fal fa-user-circle",
                "link" => route("user.profile"),
                "is_active" => $this->checkIsActive(["profile"]) ? "active" : "",
            ],
            [
                "title" => "آگهی ها",
                "icon" => "fal fa-bullhorn",
                "link" => route("user.notice-index"),
                "is_active" => $this->checkIsActive(["notice-index"]) ? "active" : "",
            ],
            [
                "title" => "سفارشات",
                "icon" => "fal fa-clipboard-list-check",
                "link" => route("user.order"),
                "is_active" => $this->checkIsActive(["order"]) ? "active" : "",
            ],
            [
                "title" => "تیکت",
                "icon" => "fal fa-envelope",
                "link" => route("user.ticket"),
                "is_active" => $this->checkIsActive(["ticket"]) ? "active" : "",
            ],
            [
                "title" => "تغییر رمز عبور",
                "icon" => "far fa-key",
                "link" => route("user.password"),
                "is_active" => $this->checkIsActive(["password"]) ? "active" : "",
            ],
            [
                "title" => "خروج",
                "icon" => "fal fa-sign-out-alt",
                "link" => route("logout"),
                "is_active" => "",
            ],
        ];
    }
    private function checkIsActive(array $routes): bool
    {
        $arr_route = explode('.',Route::currentRouteName());
        return in_array($arr_route[count($arr_route) - 1] , $routes);
    }
    public function compose(View $view)
    {
        $view->with([
            'sidebar' => $this->sidebar()
        ]);
    }
}
