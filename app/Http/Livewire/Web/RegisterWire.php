<?php

namespace App\Http\Livewire\Web;

use App\Models\User;
use App\Models\User as Model;
use App\Traits\AlertTrait;
use App\Traits\AuthTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class RegisterWire extends Component
{
    use AlertTrait , AuthTrait;
    public string $name = "" ,$tel = "" , $password = "" , $passwordConfirmation = "";
    protected $messages = [
        'tel.unique' => 'این شماره تلفن قبلا ثبت شده است.',
    ];
    public function registerUser() : Redirector
    {
        $validation_rules  = [
            "name" => "required|",
            "tel" => "max:11|required|regex:/(09)[0-9]{9}/|unique:users,phone_number",
            "password" => "required|min:6",
            "passwordConfirmation" => "required|min:6|same:password",
        ];

        $this->traitRegisterUser($validation_rules);
        $this->ToastSuccessAlertWithRedirect("شما با موفقیت ثبت نام کردید .");
        return redirect()->route("login");


    }
    public function render() : view
    {
        return view('web.livewire.register.index')->extends('layouts.web.auth.main')->section('content');
    }
}
