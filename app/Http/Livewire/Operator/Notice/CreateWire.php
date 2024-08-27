<?php

namespace App\Http\Livewire\Operator\Notice;

use App\Helper\Utility;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Notice as Model;
use App\Models\Order;
use App\Models\State;
use App\Models\User;
use App\Traits\AlertTrait;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;
class CreateWire extends Component
{
    use WithFileUploads,AlertTrait;
    public Model $model;
    public string  $address ="" , $path= "",$title="";
    public $lat , $lng , $image , $gallery = [] , $city;
    protected $rules = [
        "model.title" => "required",
        "model.user_id"=>"required",
        "model.category_id"=>"required",
        "image" => "nullable|image|max:1024|mimes:jpg,jpeg,png,bmp,tiff",
        "gallery.*" => "nullable|image|max:1024|mimes:jpg,jpeg,png,bmp,tiff",
        "model.address" => "nullable",
        "model.state_id" => "nullable",
        "model.city_id" => "nullable",
        "model.especial"=>"nullable",
        "model.context"=>"nullable",
    ];
    public function mount(){
        $this->model=new Model;
        $this->image="";
        $this->gallery="";
        $this->model->city_id=298;
        $this->model->state_id =21;
        $this->model->especial=0;
        $this->city = State::find(21)->cities;
    }
    public function chooseState($id) : void
    {
        if ($id)
        {
            $this->city = State::find($id)->cities;
        }
    }
    public function secondStepSubmit()
    {
        if($this->validate())
        {

            if($this->image)
            {
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
            $this->model->lat=$this->lat;
            $this->model->lng=$this->lng;
            $this->model->save();
            Order::create([

                'user_id' =>$this->model->user_id,
                'notice_id' =>$this->model->id,
                'price'=>0,
                'is_paid'=>1,
                'status'=>1,
                'tariff_id'=>-1,
            ]);
            $this->image="";
            $this->gallery="";
            $this->model=new Model;
            $this->successAlert("آگهی با موفقیت ثبت شد ");
        }

    }
    public function render()
    {
        $this->state=State::all();
        $categorys=Category::all();
        $users=User::all();
        return view('operator.livewire.notice.create',["categorys"=>$categorys,"users"=>$users])->extends('layouts.operator.main')->section('content');;
    }
}
