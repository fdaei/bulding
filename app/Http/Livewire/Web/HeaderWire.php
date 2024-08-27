<?php

namespace App\Http\Livewire\Web;

use App\Models\Category;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;
use Livewire\Redirector;
use phpDocumentor\Reflection\Types\Integer;

class HeaderWire extends Component
{
    public string $searchCity = "";
    public string $searchCategory="";
    public string $searchAdv="";
    public  $category_id;
    public $currentUrl;
    public function mount():void
    {
        $this->currentUrl = Route::currentRouteName();
    }
    public function Search() :Redirector
    {
        return redirect()->route('operator.notice');
    }
    public function ShowNotices($id) : Redirector
    {
        return redirect()->route('search.notices' , ["id" => $id]);
    }
    public function select_category($id) : void
    {
        $this->category_id=$id;
    }
    public function render():View
    {
        $states = [];
        $category=Category::orderby('weight')->whereIsRoot()->get();
            $states=State::all();
        $kerman=State::where('name','کرمان')->get();
        if($kerman->count()){
            $states=City::where('state_id',$kerman[0]->id)->get();
        }
        return view('layouts.web.partial.header',['categories'=>$category,'states'=>$states]);
    }
}

