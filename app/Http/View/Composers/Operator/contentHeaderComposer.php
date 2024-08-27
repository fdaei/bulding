<?php


namespace App\Http\View\Composers\Operator;


use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class contentHeaderComposer
{
    protected string $routeName = "";
    public function __construct()
    {
        $this->routeName = Route::currentRouteName();
    }

    public function prepareArray() : array
    {
        $title = null;
        switch ($this->routeName){
            case $this->routeName == "operator.dashboard":
                $title = [
                    "title" => "داشبورد"
                ];
                break;
            case $this->routeName == "operator.category":
                $title = [
                    "title" => "دسته بندی"
                ];
                break;
            case $this->routeName == "operator.category.feature":
                $title = [
                    "title" => "مشخصه دسته بندی"
                ];
                break;
            case $this->routeName == "operator.create":
                $title =[
                    "title" => "ثبت کاربر جدید"
                ];
                break;
            case $this->routeName == "operator.index":
                $title = [
                    "title" => "نمایش کاربران"
                ];
                break;
            case $this->routeName == "operator.update":
                $title = [
                    "parent" => "نمایش کاربران",
                    "title" =>"ویرایش کاربران"
                ];
                break;
            case $this->routeName == "operator.message":
                $title = [
                    "title" => "پیام ها"
                ];
                break;
            case $this->routeName == "operator.comment":
                $title = [
                    "title" =>"دیدگاه ها"
                ];
                break;
            case $this->routeName == "operator.tariff":
                $title = [
                    "title" => "تعرفه"
                ];
                break;
            case $this->routeName == "operator.profile":
                $title = [
                    "title" => "پروفایل"
                ];
                break;
            case $this->routeName == "operator.notice":
                $title = [
                    "title" => "آگهی"
                ];
                break;
            case $this->routeName == "operator.notice.update":
                $title = [
                    "parent" => "آگهی",
                    "title" =>"ویرایش آگهی"
                ];
                break;
            case $this->routeName == "operator.notice.show":
                $title = [
                    "parent" => "آگهی",
                    "title" => "نمایش آگهی"
                ];
                break;
            case $this->routeName == "operator.noticefeature.update":
                $title = [
                    "parent" => "آگهی",
                    "title" => "ویرایش دسته"
                ];
                break;
            case $this->routeName == "operator.orders":
                $title = [
                    "title" => "سفارشات"
                ];
                break;
            case $this->routeName == "operator.settings":
                $title = [
                    "title" => "تنظیمات"
                ];
                break;
            case $this->routeName == "operator.changePassword":
                $title = [
                    "title" =>"تغییر کلمه عبور"
                ];
                break;
            default:
                $title = "";

        }
        return $title;
    }
    public function compose(View $view)
    {
        $view->with([
            'contentHeader' => $this->prepareArray()
        ]);
    }
}
