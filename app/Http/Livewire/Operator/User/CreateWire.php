<?php

namespace App\Http\Livewire\Operator\User;

use App\Models\User as Model;
use App\Traits\AlertTrait;
use Livewire\Redirector;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CreateWire extends Component
{
    use AlertTrait;
    public ?Model $model;
    public string $password="";
    public bool $update_mode=false;
    public function mount(): void
    {
        $this->model = new Model;
    }
    protected function rules():array
    {
        $rules = [
            'model.first_name' => 'required|persian_alpha|max:25',
            'model.last_name' => 'persian_alpha|max:25|nullable',
            'model.phone_number' => 'required|numeric|ir_mobile',
            'model.email' => 'email|nullable',
            'model.instagram' => 'nullable',
            'model.website' => 'nullable',
            'model.status' => 'nullable',
        ];

        if ($this->update_mode) {
            $rules['password'] = 'nullable';
        }
        else{
            $rules['password'] = 'required';
        }
        return $rules;
    }

    public function insert():Redirector
    {
        if($this->validate())
        {

            $this->model->password=Hash::make($this->password);
            $this->model->save();
            $this->model = null;
            $this->model=new Model;
            $this->SuccessAlertWithRedirect();
        }
        return redirect()->route('operator.index');
    }
    public function update():Redirector
    {
        if($this->validate()){
            $this->model->update();
            $this->model=new  Model;
            $this->SuccessAlertWithRedirect();
        }
        return redirect()->route('operator.index');
    }
    public function render():View
    {
        return view('operator.livewire.user.create')->extends('layouts.operator.main')->section('content');

    }
}
