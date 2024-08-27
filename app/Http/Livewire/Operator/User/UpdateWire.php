<?php

namespace App\Http\Livewire\Operator\User;

use App\Models\User as Model;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Illuminate\Support\Facades\Hash;

class UpdateWire extends Component
{
    use AlertTrait;
    public ?Model $model;
    public string $password="";
    public bool $update_mode=false;
    public function mount($id): void
    {
        $this->model = Model::find($id);
        $this->update_mode=true;
    }
    protected $rules = [
        'model.first_name' => 'required|',
        'model.last_name' => 'required|',
        'model.phone_number' => 'required|',
        'model.email' => 'required|email',
        'model.instagram' => 'nullable',
        'model.website' => 'nullable',
        'model.status' => 'nullable',
        'password' => 'nullable',
    ];
    public function update():Redirector
    {
        if($this->validate()){
            if($this->password)
            {
                $this->model->password= Hash::make($this->password);
            }
            $this->model->update();
            $this->model=new Model;
            $this->successAlert();
            return redirect()->route('operator.index');
        }
    }
    public function render():View
    {
        return view('operator.livewire.user.create')->extends('layouts.operator.main')->section('content');

    }
}
