<?php

namespace App\Http\Livewire\Web;

use App\Models\Category;
use App\Models\Notice;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithPagination;

class SiteWire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function ShowNotices($id) : Redirector
    {
        return redirect()->route('search.notices' , ["id" => $id]);
    }
    public function render():View
    {
        $especialnotice=Notice::orderby('id','DESC')->where('especial',1)->where('status',1)->paginate(8);
        $notice=Notice::orderby('id','DESC')->where('especial',0)->where('status',1)->paginate(40);
        $category=Category::where("name" ,"<>" , "بدون دسته بندی")->orderby('weight')->paginate(10);
        return view('web.livewire.site.home',['noticeitems'=>$notice,'categories'=>$category,'especialnotice'=>$especialnotice])->extends('layouts.web.main')->section('content');
    }
}
