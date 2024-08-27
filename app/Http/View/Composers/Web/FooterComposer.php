<?php
namespace App\Http\View\Composers\Web;


use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
class FooterComposer
{
    private function footer(): array
    {
        $setting=Setting::all();
        if($setting->count() <> 0)
        {
            return [
                [
                    "check" => "tel",
                    'icon'=>'fa fa-phone-volume',
                    'title' =>'شماره تماس:',
                    'value' => $setting[0]->tel
                ],
                [
                    "check" => "email",
                    'icon'=>'fas fa-envelope',
                    'title' =>'ایمیل:',
                    'value'=>$setting[0]->email,
                ],
                [
                    "check" => "insta",
                    'icon'=>'fab fa-instagram',
                    'title' =>'اینستاگرام:',
                    'value'=>$setting[0]->instagram,
                ],
            ];
        }
        else{
              return [
                  [
                      "check" => "tel",
                      'icon'=>'fa fa-phone-volume',
                      'title' =>'شماره تماس:',
                      'value' => null,
                  ],
                  [
                      "check" => "email",
                      'icon'=>'fas fa-envelope',
                      'title' =>'ایمیل:',
                      'value'=>null,
                  ],
                  [
                      "check" => "insta",
                      'icon'=>'fab fa-instagram',
                      'title' =>'اینستاگرام:',
                      'value'=> null,
                  ],
            ];
        }
    }
    public function compose(View $view)
    {
        $view->with([
            'footer' => $this->footer()
        ]);
    }
}
