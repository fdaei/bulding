<?php

namespace App\Http\Livewire\Operator\Notice;

use App\Models\Gallery;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Notice as Model;

class ShowWire extends Component
{
    public ?Model $model;
    public $images;
    public function mount($id):void
    {
        $this->model=Model::find($id);
        $this->images=Gallery::orderby('id')->where('notice_id',$id)->get();
    }
    public function render():View
    {
        return view('operator.livewire.notice.show',['images'=>$this->images])->extends('layouts.operator.main')->section('content');
    }
}
