<?php

namespace App\Http\Livewire\Web\Notice;

use App\Helper\Utility;
use App\Models\Category;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\Redirector;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Type\Decimal;

class NoticeWire extends Component
{
    use WithFileUploads;
    public ?int $currentStep = 2 , $category_id = 0 ,$state_id = null , $city_id = null;
    public string $context = "" , $address ="" , $path= "";
    public string $title="";
    public $lat , $lng;
    public bool $previewBoxIndex = false , $previewBoxGallery = false;
    public $previewImage;
    public $previewGallery = [];
    public $image;
    public $gallery = [] , $selectInputs = [] , $textInputs = [] , $checkboxInputs = [] , $radioInputs = [];
    protected $rules = [
        "title" => "required",
        "context" => "nullable",
        "image" => "nullable|image|max:1024|mimes:jpg,jpeg,png,bmp,tiff",
        "gallery.*" => "nullable|image|max:1024|mimes:jpg,jpeg,png,bmp,tiff",
        "address" => "nullable",
        "state_id" => "nullable",
        "city_id" => "nullable",
    ];
    public function mount() : void
    {
        $this->category_id = session()->get("noticeData.category_id");
        $this->state = State::all();
        if (session()->get("noticeData.title"))
        {
            $this->initialize();
        }
    }
    public function chooseState($id) : void
    {
        if ($id)
        {
            $this->city = State::find($id)->cities;
            $this->city_id = $this->city[0]->id;
        }
        else $this->city = null;
    }
    public function secondStepSubmit() : Redirector
    {
        $this->validate();
        $featureData = [
          "select" => $this->selectInputs,
          "radio" => $this->radioInputs,
          "checkbox" => $this->checkboxInputs,
          "text" => $this->textInputs,
        ];
        Session::put("featureData" , $featureData);
        Session::put("noticeData.title" , $this->title);
        Session::put("noticeData.context" , $this->context);
        Session::put("noticeData.state_id" , $this->state_id);
        Session::put("noticeData.city_id" , $this->city_id);
        Session::put("noticeData.address" , $this->address);
        Session::put("noticeData.lat" , $this->lat);
        Session::put("noticeData.lng" , $this->lng);

        return redirect()->route("notice-tariff");
    }
    public function initialize() : void
    {
        $this->title = session()->get("noticeData.title");
        $this->lat = session()->get("noticeData.lat");
        $this->lng = session()->get("noticeData.lng");
        $this->state_id = session()->get("noticeData.state_id");
        $this->city_id = session()->get("noticeData.city_id");
        $this->address = session()->get("noticeData.address");
        $this->context = session()->get("noticeData.context");
        $this->selectInputs = session()->get("featureData.select");
        $this->checkboxInputs = session()->get("featureData.checkbox");
        $this->radioInputs = session()->get("featureData.radio");
        $this->textInputs = session()->get("featureData.text");
        $this->image = new TemporaryUploadedFile(session()->get("noticeData.image"),config('filesystems.default'));
        if (session()->get("noticeData.gallery"))
        {
            foreach (session()->get("noticeData.gallery") as $item)
            {
                $this->gallery[] = new TemporaryUploadedFile($item,config('filesystems.default'));
            }
        }
        $this->city = State::find($this->state_id)->cities;
    }
    public function render() : view
    {
        return view('web.livewire.notice-create.notice-details')
            ->extends("layouts.web.main")
            ->section("content");
    }
}
