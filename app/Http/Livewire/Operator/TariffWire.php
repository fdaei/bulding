<?php

namespace App\Http\Livewire\Operator;

use App\Models\Tariff as Model;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class TariffWire extends Component
{
    use WithPagination,AlertTrait;
    protected $listeners = ["delete"];
    protected $paginationTheme = 'bootstrap';
    public ?Model $model;
    public bool $update_mode=false;
    public function mount(): void
    {
            $this->model = new Model;
    }
    protected function rules():array
    {
        $validation = "";
        if ($this->model->time == -1)
        {
            $validation = "nullable";
        }
        else{
            $validation = "required";
        }
        return [
            'model.time' => 'required|numeric',
            'model.notice_type' => 'nullable|',
            'model.price' => 'required|numeric',
            'model.revival'=> $validation.'|numeric'
        ];
    }
    public function update():void
    {
        if($this->validate()){
            $this->model->update();
            $this->successAlert("تعرفه با موفقیت ویرایش شد");
            $this->model=null;
            $this->model = new Model;
            $this->update_mode=false;
        }
    }
    public function edit($id):void
    {
        $this->model = Model::find($id);
        $this->update_mode=true;
    }
    public function delete($id):void
    {
        Model::destroy($id);
        $this->successAlert();
    }
    public function insert():void
    {
        if($this->validate())
        {
            if($this->model->notice_type==null)
            {
                $this->model->notice_type=0;
            }
            $this->model->save();
            $this->successAlert("تعرفه با موفقیت ثبت شد");
            $this->model = null;
            $this->model = new Model;
        }
    }
    public function changestatus($id,$condition):void
    {
        $this->model = Model::find($id);
        $this->model->status=$condition;
        $this->model->update();
    }
    public function render():View
    {
        $items=Model::orderby('id', 'desc')->paginate();
        return view('operator.livewire.tariff.index',['items'=>$items])->extends('layouts.operator.main')->section('content');
    }
}
