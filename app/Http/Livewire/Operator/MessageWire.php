<?php

namespace App\Http\Livewire\Operator;

use App\Models\Message as Model;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class MessageWire extends Component
{
    use WithPagination,AlertTrait;
    protected $listeners = ["delete"];
    public ?Model $model;
    public bool $update_mode=false;
    protected $paginationTheme = 'bootstrap';
    public function edit($id):void
    {
        $this->model = Model::find($id);
        $this->update_mode=!$this->update_mode;
    }
    public function delete($id):void
    {
        Model::destroy($id);
        $this->successAlert();
    }
    public function render():View
    {
        $items=Model::orderby('id', 'desc')->paginate();
        return view('operator.livewire.message.index',['items'=>$items])->extends('layouts.operator.main')->section('content');
    }
}
