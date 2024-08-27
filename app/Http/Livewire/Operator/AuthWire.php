<?php

namespace App\Http\Livewire\Operator;

use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;

class AuthWire extends Component
{
    use AlertTrait;
    public ?string $username = null;
    public ?string $password = null;
    protected array $rules = [
        'username' => 'required',
        'password' => 'required|min:6',
    ];
    public function login(): void
    {
        if ($this->validate() && Auth::guard('operator')->attempt(['username' => $this->username, 'password' => $this->password], 1)) {
            redirect()->route("operator.profile");
        }else{
            $this->dangerAlert('نام کاربری یا کلمه عبور اشتباه می باشد.');
        }
    }

    public function render():View
    {
        return view('operator.livewire.auth.index')->extends('layouts.auth.main')->section('content');
    }

}
