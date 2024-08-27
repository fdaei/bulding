<?php

namespace App\Http\Livewire\Web\Notice;

use App\Helper\Utility;
use App\Models\Admin;
use App\Models\Gallery;
use App\Models\Notice;
use App\Models\NoticeFeature;
use App\Models\Order;
use App\Models\User;
use App\Models\User as Model;
use App\Traits\AlertTrait;
use App\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;

class SubmitOrderWire extends Component
{
    use AuthTrait , AlertTrait;
    public string $name = "" , $tel = "" , $password = "" , $passwordConfirmation = "" , $loginTel = "" , $loginPassword = "";
    public ?int $currentStep = 4 ;
    public Model $model;
    public $temp;
    public function mount(Model $instance) : void
    {
        $this->model = $instance;
    }
    public function login() : void
    {
        $validation_rules = [
            "loginTel" => "required|regex:/(09)[0-9]{9}/",
            "loginPassword" => "required|min:6",
        ];

        if($this->traitLogin($validation_rules))
        {
            $this->successAlert("با موفقیت وارد شدید.");
        }
        else{
            $this->dangerAlert('شماره تلفن یا کلمه عبور اشتباه می باشد.');

        }

    }
    public function register() : void
    {
        $validation_rules = [
            "name" => "required|",
            "tel" => "required|regex:/(09)[0-9]{9}/",
            "password" => "required|min:6",
            "passwordConfirmation" => "required|min:6|same:password",
        ];
        $user = $this->traitRegisterUser($validation_rules);
        Auth::login($user);
        $this->successAlert("شما با موفقیت ثبت نام شدید");
    }
    public function submitOrder() : void
    {
        if (Auth::guest()) $this->dangerAlert("ابتدا وارد حساب کاربری خود شوید.");
        else
        {
            $tempImage = new TemporaryUploadedFile(session()->get("noticeData.image"),config('filesystems.default'));
            $notice = Notice::create([
                "user_id" => Auth::id(),
                "title" => session()->get("noticeData.title"),
                "context" => session()->get("noticeData.context"),
                "category_id" => session()->get("noticeData.category_id"),
                "image" => $tempImage->store(Utility::pathUploads() , "public"),
                "address" => session()->get("noticeData.address"),
                "city_id" => session()->get("noticeData.city_id"),
                "state_id" => session()->get("noticeData.state_id"),
                "lat" => session()->get("noticeData.lat"),
                "lng" => session()->get("noticeData.lng"),
                "especial" => session()->get("noticeData.special"),
            ]);
            if(session()->get("noticeData.gallery"))
            {
                foreach (session()->get("noticeData.gallery") as $item)
                {
                    $tempGallery = new TemporaryUploadedFile($item,config('filesystems.default'));
                    Gallery::create([
                        "notice_id" => $notice->id,
                        "path" => $tempGallery->store(Utility::pathUploads(), "public"),
                    ]);
                }
            }

            // select storing
            if(session()->get("featureData.select")){
                foreach (session()->get("featureData.select") as $key => $item){
                    if ($item <> null)
                    {
                        NoticeFeature::create([
                            "category_feature_id" => $key,
                            "value" => $item,
                            "notice_id" => $notice->id ,
                        ]);
                    }
                }
            }
            ////text storing
            if(session()->get("featureData.text")){
                foreach (session()->get("featureData.text") as $key => $item){
                    if ($item <> null)
                    {
                        NoticeFeature::create([
                            "category_feature_id" => $key,
                            "value" => $item,
                            "notice_id" => $notice->id ,
                        ]);
                    }
                }
            }
            //
            ////radio storing
            if(session()->get("featureData.radio")){
                foreach (session()->get("featureData.radio") as $key => $item){
                    NoticeFeature::create([
                        "category_feature_id" => $key,
                        "value" => $item,
                        "notice_id" => $notice->id ,
                    ]);
                }
            }
            //
            ////checkbox storing
            if(session()->get("featureData.checkbox")){
                foreach (session()->get("featureData.checkbox") as $key => $item){
                    if($item)
                    {
                        $checkboxItem = [];
                        foreach ($item as $value)
                        {
                            if ($value <> false) $checkboxItem[] = $value;
                        }
                        $optionalFeatures =implode("#" , $checkboxItem);
                        NoticeFeature::create([
                            "category_feature_id" => $key,
                            "value" => $optionalFeatures,
                            "notice_id" => $notice->id,
                        ]);
                    }
                }

            }
            //
            Order::create([
                "user_id" => Auth::id(),
                "notice_id" =>$notice->id,
                "price" => session()->get("noticeData.price"),
                "is_paid" => 0,
                "tariff_id" => session()->get("noticeData.tariff_id"),
            ]);
        }
    }
    public function render() : view
    {
        return view('web.livewire.notice-create.submit-order')
            ->extends("layouts.web.main")
            ->section("content");
    }
}
