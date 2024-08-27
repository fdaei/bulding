<?php

namespace App\Http\Livewire\Operator;

use App\Models\Admin as Model;
use App\Rules\VerifyPassword;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;

class PasswordWire extends Component
{
    use AlertTrait;
    public $currentPassword;
    public $newPassword;
    public $confirmationPassword;
    public Model $model;
    public function mount() : void
    {
        $this->model = Model::find(Auth::guard("operator")->id());
    }
    public function update()
    {
        $this->validate([
            "currentPassword" => ['required',new VerifyPassword($this->model->password)],
            "newPassword" => "required|min:6",
            "confirmationPassword" => "required|min:6|same:newPassword|required_with:newPassword",
        ]);
        $this->model->password = Hash::make($this->newPassword);
        $this->model->update();
        $this->successAlert();
        unset($this->newPassword , $this->confirmationPassword , $this->currentPassword);
    }
    public function render():View
    {
        return view('operator.livewire.password.index')->extends('layouts.operator.main')->section('content');
    }
}
