<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Trait AuthTrait{
    public function traitRegisterUser($rules)
    {
        $this->validate($rules);
        $user = User::create([
            "first_name" => $this->name,
            "phone_number" => $this->tel,
            "password" => Hash::make($this->password)
        ]);
        return $user;
    }
    public function traitLogin($rules) : bool
    {
        if ($this->validate($rules) && Auth::guard('web')->attempt(['phone_number' => $this->loginTel, 'password' => $this->loginPassword], 1)) {
            return true;
        }else{
            return false;
        }
    }
}
