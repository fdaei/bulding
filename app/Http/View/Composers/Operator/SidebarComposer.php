<?php


namespace App\Http\View\Composers\Operator;


use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SidebarComposer
{
    private function sidebar(): array
    {
        return [
            [
                'name' => 'داشبورد',
                'icon'=>'fa fa-tachometer-alt',
                'is_active' => $this->checkIsActive(["dashboard"]) ? "active" : "",
                'link' => route("operator.dashboard"),
            ],
            [
                'name' => 'دسته بندی',
                'icon'=>'fas fa-clipboard-list',
                'is_active' => $this->checkIsActive(["category"]) ? "active" : "",
                'link' => route("operator.category"),
            ],
            [
                'name' => 'مشخصه دسته بندی',
                'icon'=>'fas fa-clone',
                'is_active' => $this->checkIsActive(["feature"]) ? "active" : "",
                'link' => route("operator.category.feature"),
            ],
            [
                'name' => 'ثبت کاربر جدید',
                'icon'=>'fas fa-user-circle',
                'is_active' => $this->checkIsActive(["create"]) ? "active" : "",
                'link' => route("operator.create"),
            ],
            [
                'name' => 'نمایش کاربران',
                'icon'=>'fas fa-users',
                'is_active' => $this->checkIsActive(["index"]) ? "active" : "",
                'link' => route("operator.index"),
            ],
            [
                'name' => 'پیام ها',
                'icon'=>'fal fa-envelope',
                'is_active' => $this->checkIsActive(["message"]) ? "active" : "",
                'link' => route("operator.message"),
            ],
            [
                'name' => 'دیدگاه ها',
                'icon'=>'fab fa-gg',
                'is_active' => $this->checkIsActive(["comment"]) ? "active" : "",
                'link' => route("operator.comment"),
            ],
            [
                'name' => 'تعرفه',
                'icon'=>'fas fa-money-check-alt',
                'is_active' => $this->checkIsActive(["tariff"]) ? "active" : "",
                'link' => route("operator.tariff"),
            ],
            [
                'name' => 'آگهی',
                'icon'=>'far fa-newspaper',
                'is_active' => $this->checkIsActive(["notice"]) ? "active" : "",
                'link' => route("operator.notice"),
            ],
            [
                'name' => 'ثبت آگهی ',
                'icon'=>'far fa-newspaper',
                'is_active' => $this->checkIsActive(["noticecreate"]) ? "active" : "",
                'link' => route("operator.noticecreate"),
            ],
            [
                'name' => 'سفارشات',
                'icon'=>'fab fa-first-order-alt',
                'is_active' => $this->checkIsActive(["orders"]) ? "active" : "",
                'link' => route("operator.orders"),
            ],
            [
                'name' => 'تنظیمات',
                'icon'=>'fas fa-cogs',
                'is_active' => $this->checkIsActive(["settings"]) ? "active" : "",
                'link' => route("operator.settings"),
            ],
            [
                'name' => 'ثبت تیکت',
                'icon'=>'fas fa-comment',
                'is_active' => $this->checkIsActive(["ticket-create"]) ? "active" : "",
                'link' => route("operator.ticket-create"),
            ],
            [
                'name' => 'تیکت ها',
                'icon'=>'fas fa-comments',
                'is_active' => $this->checkIsActive(["ticket-index","ticket-show"]) ? "active" : "",
                'link' => route("operator.ticket-index"),
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
