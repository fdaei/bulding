<?php

namespace App\Http\Livewire\User;

use App\Helper\Utility;
use App\Models\User as Model;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileWire extends Component
{
    use AlertTrait,WithFileUploads;
    public Model $model;
    public $image;
    protected $rules = [
        "model.first_name" => "required",
        "model.last_name" => "nullable",
        "model.phone_number" => "required|regex:/(09)[0-9]{9}/",
        "model.instagram" => "nullable",
        "model.email" => "nullable|email",
        "model.website" => "nullable",
        "image"=>"nullable|mimes:jpg,jpeg,png"
    ];
    public function mount(Model $instance) : void
    {
        $this->model = Auth::user();

    }
    public function insert() : void
    {
        $this->validate();
        if($this->image)$this->model->img=$this->image->store(Utility::pathUploads(),'public');
        $this->model->update();
        $this->emitTo("user.sidebar-wire" , "render");
        $this->successAlert();
    }
    public function render() : View
    {
        return view('user.livewire.profile.index')->extends("layouts.web.panel.main")->section("content");
    }
}
