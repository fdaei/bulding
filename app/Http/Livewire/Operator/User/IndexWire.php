<?php

namespace App\Http\Livewire\Operator\User;

use App\Models\User as Model;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination,AlertTrait;
    protected $paginationTheme = 'bootstrap';
    public string $search="";
    protected $listeners = ["delete"];
    public function delete($id):void
    {
        Model::destroy($id);
        $this->successAlert();
    }
    public function render():View
    {
        $items=Model::orderby('id', 'desc')->orwhere('phone_number','LIKE','%'.$this->search.'%')->orwhere('first_name','LIKE','%'.$this->search.'%')->orwhere('last_name','LIKE','%'.$this->search.'%')->paginate();
        return view('operator.livewire.user.index',['items'=>$items])->extends('layouts.operator.main')->section('content');
    }
}
