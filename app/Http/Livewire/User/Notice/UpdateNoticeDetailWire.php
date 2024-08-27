<?php

namespace App\Http\Livewire\User\Notice;

use App\Helper\Utility;
use App\Models\Gallery;
use App\Models\Notice;
use App\Models\Notice as Model;
use App\Models\NoticeFeature;
use App\Models\State;
use App\Traits\AlertTrait;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UpdateNoticeDetailWire extends Component
{
    use WithFileUploads , AlertTrait;
    public ?int $state_id = null , $city_id = null;
    public $lat , $lng;
    public Model $model;
    public $newImage;
    public  $gallery;
    public array $galleryIds = [];
    public $selectInputs = [] , $textInputs = [] , $checkboxInputs = [] , $radioInputs = [];
    public bool $currentIndexImage = true , $is_image_set = false;
    public function mount($id) : void
    {
        $this->model = Notice::find($id);
        $this->state_id = $this->model->state_id;
        $this->city_id = $this->model->city_id;
        $this->state = State::all();
        $this->city = State::find($this->state_id)->cities;
        $this->lat = $this->model->lat;
        $this->lng = $this->model->lng;

        $selects = NoticeFeature::join("category_features" , 'category_features.id' , "=" , "notice_features.category_feature_id")
            ->where("category_features.type" , 1)->where("notice_features.notice_id" , $this->model->id)->get();
        foreach($selects as $item)
        {
            $this->selectInputs[$item["category_feature_id"]] = $item["value"];
        }

        $texts = NoticeFeature::join("category_features" , 'category_features.id' , "=" , "notice_features.category_feature_id")
            ->where("category_features.type" , 0)->where("notice_features.notice_id" , $this->model->id)->get();
        foreach($texts as $item)
        {
            $this->textInputs[$item["category_feature_id"]] = $item["value"];
        }
        $radios = NoticeFeature::join("category_features" , 'category_features.id' , "=" , "notice_features.category_feature_id")
            ->where("category_features.type" , 2)->where("notice_features.notice_id" , $this->model->id)->get();
        foreach($radios as $item)
        {
            $this->radioInputs[$item["category_feature_id"]] = $item["value"];
        }
        $checkBoxes = NoticeFeature::join("category_features" , 'category_features.id' , "=" , "notice_features.category_feature_id")
            ->where("category_features.type" , 3)->where("notice_features.notice_id" , $this->model->id)->get();
        foreach($checkBoxes as  $item)
        {
            $temp = 0;
            $array = explode("#" , $item["value"]);
            foreach($array as $val)
            {
                if ($temp == 0)
                {
                    $this->checkboxInputs[$item["category_feature_id"]] = [$val => $val];
                }
                $this->checkboxInputs[$item["category_feature_id"]] += [$val => $val];
                $temp++;
            }
        }
    }
    protected function rules() : array
    {
        $newImageRule = null;
        if ($this->is_image_set == false)  $newImageRule = "nullable|image|max:1024|mimes:jpg,jpeg,png,bmp,tiff";
        else $newImageRule = "required|image|max:1024|mimes:jpg,jpeg,png,bmp,tiff";
        return [
            "model.title" => "required",
            "model.context" => "required",
            "newImage" => $newImageRule,
            "gallery.*" => "nullable|image|max:1024|mimes:jpg,jpeg,png,bmp,tiff",
            "model.address" => "required",
            "model.state_id" => "required",
            "model.city_id" => "required",
        ];

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
    public function deleteIndexImage() : void
    {
        $this->currentIndexImage = false;
        $this->is_image_set = true;
    }
    public function deleteGalleryImage($id) : void
    {
        $this->galleryIds[] = $id;
    }
    public function submit():Redirector
    {
        $this->validate();
        if($this->is_image_set == true)
        {
            Utility::removeImage("/storage/".$this->model->image);
            $this->model->image = $this->newImage->store(Utility::pathUploads() , "public");
        }
        if ($this->model->gallerys()->exists())
        {
            if($this->gallery and (count($this->galleryIds) == 0))
            {
                foreach ($this->gallery as $item)
                {
                    Gallery::create([
                        "notice_id" => $this->model->id,
                        "path" => $item->store(Utility::pathUploads() , "public"),
                    ]);
                }
            }
            elseif(count($this->galleryIds) and $this->gallery == null)
            {
                foreach ($this->galleryIds as $item)
                {
                    Utility::removeImage("/storage/".Gallery::find($item)->path);
                    Gallery::find($item)->delete();
                }
            }
            elseif(count($this->galleryIds) and $this->gallery)
            {
                if(count($this->gallery) > count($this->galleryIds))
                {
                    foreach ($this->gallery as $key => $item)
                    {
                        if ($key < count($this->galleryIds))
                        {
                            $current_image = Gallery::find($this->galleryIds[$key]);
                            Utility::removeImage("/storage/".$current_image->path);
                            $current_image->path = $item->store(Utility::pathUploads() , "public");
                            $current_image->update();
                            continue;
                        }
                        Gallery::create([
                            "notice_id" => $this->model->id,
                            "path" => $item->store(Utility::pathUploads() , "public"),
                        ]);
                    }
                }
                //working
                elseif(count($this->gallery) < count($this->galleryIds))
                {
                    foreach ($this->galleryIds as $key => $item)
                    {
                        if ($key < count($this->gallery))
                        {
                            $current_image = Gallery::find($item);
                            Utility::removeImage("/storage/".$current_image->path);
                            $current_image->path = $this->gallery[$key]->store(Utility::pathUploads() , "public");
                            $current_image->update();
                            continue;
                        }
                        Utility::removeImage("/storage/".Gallery::find($item)->path);
                        Gallery::find($item)->delete();
                    }

                }
                else
                {
                    foreach ($this->gallery as $key => $item)
                    {
                        $current_image = Gallery::find($this->galleryIds[$key]);
                        Utility::removeImage("/storage/".$current_image->path);
                        $current_image->path = $item->store(Utility::pathUploads() , "public");
                        $current_image->update();
                    }
                }
            }
        }
        foreach ($this->textInputs as $key => $item)
        {
            $feature = NoticeFeature::where("notice_id" , $this->model->id)->where("category_feature_id" , $key)->get();
            if ($feature->count() == 0)
            {
                NoticeFeature::create([
                    "category_feature_id" => $key,
                    "value" => $item,
                    "notice_id" => $this->model->id ,
                ]);
            }
            foreach ($feature as $val)
            {
                $val->value = $item;
                $val->update();
            }
        }
        foreach ($this->selectInputs as $key => $item)
        {
            $feature = NoticeFeature::where("notice_id" , $this->model->id)->where("category_feature_id" , $key)->get();
            if ($feature->count() == 0)
            {
                NoticeFeature::create([
                    "category_feature_id" => $key,
                    "value" => $item,
                    "notice_id" => $this->model->id ,
                ]);
            }
            foreach ($feature as $val)
            {
                $val->value = $item;
                $val->update();
            }
        }
        foreach ($this->radioInputs as $key => $item)
        {
            $feature = NoticeFeature::where("notice_id" , $this->model->id)->where("category_feature_id" , $key)->get();
            if ($feature->count() == 0)
            {
                NoticeFeature::create([
                    "category_feature_id" => $key,
                    "value" => $item,
                    "notice_id" => $this->model->id ,
                ]);
            }
            foreach ($feature as $val)
            {
                $val->value = $item;
                $val->update();
            }
        }
        foreach ($this->checkboxInputs as $key => $item)
        {
            $feature = NoticeFeature::where("notice_id" , $this->model->id)->where("category_feature_id" , $key)->get();
            if ($feature->count() == 0)
            {
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
                        "notice_id" => $this->model->id,
                    ]);
                }
                continue;
            }
            if($item)
            {
                $checkboxItem = [];
                foreach ($item as $value)
                {
                    if ($value <> false) $checkboxItem[] = $value;
                }
                $optionalFeatures =implode("#" , $checkboxItem);
                foreach ($feature as $val)
                {
                    $val->value = $optionalFeatures;
                    $val->update();
                }
            }
        }
        $this->model->status = 2;
        $this->model->city_id = $this->city_id;
        $this->model->state_id = $this->state_id;
        $this->model->lat = $this->lat;
        $this->model->lng = $this->lng;
        if ($this->model->expire_time <> null)
        {
            $date = Carbon::parse($this->model->expire_time);
            $now = Carbon::now();
            $this->model->remained_days = $date->diffInDays($now) +1;
            $this->model->expire_time = null;
        }
        $this->model->update();
        $this->ToastSuccessAlertWithRedirect("آگهی با موفقیت ویرایش شد.");
        return redirect()->route("user.notice-index");
    }
    public function render():View
    {
        return view('user.livewire.notice.update-notice-detail')
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
