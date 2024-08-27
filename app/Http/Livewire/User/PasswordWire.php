<?php

namespace App\Http\Livewire\User;

use App\Models\User as Model;
use App\Rules\VerifyPassword;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;

class PasswordWire extends Component
{
    use AlertTrait;
    public string $currentPassword = "" , $newPassword = "" , $confirmationPassword = "";
    public Model $model;
    public function mount() : void
    {
        $this->model = Model::find(Auth::id());
    }
    public function update() : void
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
        return view('user.livewire.password.index')
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
