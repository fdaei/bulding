<?php
namespace App\Http\View\Composers\Web;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
class HeaderComposer
{
    private function header(): array
    {
        return [
            [
                "title" => "صفحه اصلی",
                "link" => route('home'),
                "is_active" => $this->checkIsActive(["home"]) ? "active" : "",
            ],
            [
                "title" => "  آگهی ها ",
                "link" => route('search.notices'),
                "is_active" => $this->checkIsActive(["notices"]) ? "active" : "",
            ],
            [
                "title" => "  آگهی های ویژه ",
                "link" => route('notices.vip'),
                "is_active" => $this->checkIsActive(["vip"]) ? "active" : "",
            ],
            [
                "title" => "وبلاگ ",
                "link" => "http://test11fgp.ir",
                "is_active" => $this->checkIsActive(["#"]) ? "active" : "",
            ],
//            [
//                "title" => "درباره ما ",
//                "link" => '',
//                "is_active" => $this->checkIsActive(["#"]) ? "active" : "",
//            ],
            [
                "title" => "تماس با ما",
                "link" => route('contactus'),
                "is_active" => $this->checkIsActive(["contactus"]) ? "active" : "",
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
            'header' => $this->header()
        ]);
    }
}
