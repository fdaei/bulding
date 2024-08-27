<?php

namespace App\Http\Livewire\Web;

use App\Traits\AlertTrait;
use App\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class LoginWire extends Component
{
    use AlertTrait , AuthTrait;
    public string $loginTel = "" , $loginPassword = "";
    public function login()
    {
        $validation_rules = [
            "loginTel" => "required|regex:/(09)[0-9]{9}/",
            "loginPassword" => "required|min:6",
        ];
        if($this->Traitlogin($validation_rules)) redirect()->route("user.dashboard"); else $this->dangerAlert('شماره تلفن یا کلمه عبور اشتباه می باشد.');
    }
    public function render() : view
    {
        return view('web.livewire.login.index')->extends('layouts.web.auth.main')->section('content');
    }
}
