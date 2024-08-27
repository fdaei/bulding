<?php

namespace App\Http\Livewire\Operator\Category;

use App\Models\Category;
use App\Models\Ticket;
use Brick\Math\BigInteger;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ShowWire extends Component
{
    public ?Collection $featurecategory=null;
    public $id_category;
    public function mount($id):void
    {
        $this->id_category=$id;
        $this->featurecategory=Category::find($id)->categoryFeatures;
    }
    public function render():View
    {
        return view('operator.livewire.category.feature',['items'=>$this->featurecategory,'id_category'=>$this->id_category])->extends('layouts.operator.main')->section('content');
    }
}
