<?php

namespace App\Http\Livewire\Operator\Category;

use App\Models\CategoryFeature;
use App\Models\CategoryFeatureCategory;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithPagination;

class SelectWire extends Component
{
    use WithPagination,AlertTrait;
    protected $paginationTheme = 'bootstrap';
    public $category_id;
    public function mount($id):void
    {
        $this->category_id=$id;
    }
    public function add($id):Redirector
    {
        $model=new CategoryFeatureCategory;
        $model->category_id=$this->category_id;
        $model->category_feature_id=$id;
        $model->save();
        return redirect()->route('operator.category.feature.show',['id'=>$this->category_id]);
    }
    public function render():view
    {
        $items=CategoryFeature::orderby('id')->paginate();
        return view('operator.livewire.category.select',['items'=>$items])->extends('layouts.operator.main')->section('content');
    }
}
