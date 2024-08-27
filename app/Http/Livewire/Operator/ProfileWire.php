<?php

namespace App\Http\Livewire\Operator;

use App\Models\Admin as Model;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class ProfileWire extends Component
{
    use AlertTrait;
    public Model $model;
    public function rules() : array
    {
        return
            [
                "model.first_name" => "required",
                "model.last_name" => "required",
                "model.username" => "required",
                "model.phone_number" => 'required|regex:/(09)[0-9]{9}/',
                "model.email" => "required|email:rfc,dns|unique:admins,email," . Auth::guard("operator")->id(),
            ];
    }
    public function mount() : void
    {
        $this->model = Auth::guard('operator')->user();
    }
    public function update() : void
    {
        $this->validate();
        $this->model->update();
        $this->successAlert("پروفایل با موفقیت ویرایش گردید.");
    }
    public function render() : view
    {
        return view('operator.livewire.profile.index')->extends('layouts.operator.main')->section('content');
    }
}
