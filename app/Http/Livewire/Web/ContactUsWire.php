<?php

namespace App\Http\Livewire\Web;

use App\Models\Message as Model;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;

class ContactUsWire extends Component
{
    use AlertTrait;
    public ?Model $model;
    protected  $rules=[
        'model.subject'=>'required',
        'model.phone_number'=>'required',
        'model.context'=>'required'
    ];
    public function mount() : void
    {
        $this->model=new Model;
    }
    public function create() : void
    {
        if($this->validate())
        {
            $this->model->save();
            $this->successAlert(" با موفقیت ارسال گردید.");
            $this->model=new Model;
        }

    }
    public function render():View
    {
        return view('web.livewire.site.contactus')->extends('layouts.web.main')->section('content');
    }
}
