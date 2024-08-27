<?php

namespace App\Http\Livewire\Operator\Notice;

use App\Helper\Utility;
use App\Models\Category;
use App\Models\City;
use App\Models\Gallery;
use App\Models\NoticeFeature;
use App\Models\State;
use App\Traits\AlertTrait;
use App\Traits\CityTrait;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Notice as Model;
use Livewire\Redirector;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UpdateWire extends Component
{
    use WithPagination,WithFileUploads,CityTrait,AlertTrait;
    public Model $model;
    public  $city_id;
    public $image;
    public $gallery;
    public $images;
    public $parents;
    public $lat;
    public $lng;
    public $expire_time;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'model.title'=>'required',
        'image' => 'nullable',
        'gallery.*' => 'nullable',
        'expire_time'=>'nullable',
        'model.address'=>'required',
        'model.state_id'=>'required',
        'model.status'=>'required',
        'city_id'=>'required',
        'model.especial'=>'required',
        'model.expired'=>'required',
        'model.context'=>'required',
        'model.category_id'=>'required',
    ];
    public function mount($id):void
    {
        $this->model =Model::find($id);
        $this->city_id=$this->model->city_id;
        $this->lat=$this->model->lat;
        $this->lng=$this->model->lng;
        $this->expire_time=Utility::convertToS($this->model->expire_time);
        $this->cities=City::where('state_id',$this->model->state_id)->get();
       $this->images=Gallery::orderby('id')->where('notice_id',$id)->get();
        $this->States=State::all();
    }
    public function update():Redirector
    {
        if($this->validate()){
            $this->model->city_id=$this->city_id;
            if($this->image)
            {
                Utility::removeImage(Utility::pathImage().$this->model->image);
                $this->model->image=$this->image->store(Utility::pathUploads(),'public');
            }
            if($this->gallery)
            {
                foreach($this->gallery as $img){
                    $image=new Gallery;
                    $image->notice_id=$this->model->id;
                    $image->path=$img->store(Utility::pathUploads(),'public');
                    $image->save();
                }
            }
            if($this->model->category->ancestors!=null)
            {
                foreach($this->model->category->ancestors as $item){
                    $newfeatures[]=$item->categoryFeatures;
                };
            }
            $newfeatures[]=$this->model->category->categoryFeatures;
            $newfeatures= Arr::flatten($newfeatures);
            $oldfeatures=$this->model->notice_features;
            $bool=true;
            $same=[];
            if($oldfeatures==!null){
                foreach ($oldfeatures as $item) {
                    foreach ($newfeatures as $key){
                        if($key->id==$item->category_feature_id)
                        {
                            $same[]=$item;
                            $bool=false;
                        }
                    }
                    if($bool){
                        NoticeFeature::destroy($item->id);
                    }
                    $bool=true;
                }
                $bool=true;
            }
            if($same)
            {
                foreach ($newfeatures as $key){
                    foreach ($same as $item){
                        if($key->id==$item->category_feature_id)
                        {
                            $bool=false;
                        }
                    }
                    if($bool){
                        NoticeFeature::create([
                            'category_feature_id'=> $key->id,
                            'value' => "",
                            'notice_id'=>$this->model->id,
                        ]);
                    }
                    $bool=true;
                }
            }
            else{
                foreach ($newfeatures as $key){
                    NoticeFeature::create([
                        'category_feature_id'=> $key->id,
                        'value' => "",
                        'notice_id'=>$this->model->id,
                    ]);
                }
            }
            if($this->expire_time)
            {
                $this->model->expire_time=Utility::convertToAd($this->expire_time);
                $this->model->status=1;
            }
            else{
                $this->model->expire_time=null;
            }
            $this->model->lat=$this->lat;
            $this->model->lng=$this->lng;

            $this->model->update();
            $this->model->image="";
            $this->model->gallery="";
            $this->SuccessAlertWithRedirect();
            return redirect()->route('operator.notice');
        }
    }
    public function delete($id):void
    {
        Gallery::destroy($id);
        $this->images=Gallery::orderby('id')->where('notice_id',$this->model->id)->get();
    }
    public function render():View
    {
        $this->parents=Category::all();
        return view('operator.livewire.notice.update'
        )->extends('layouts.operator.main',[
            'parents'=>$this->parents,
            'images'=>$this->images,
            'States'=>$this->States,
            'cities' => $this->cities,
        ])->section('content');
    }


}
