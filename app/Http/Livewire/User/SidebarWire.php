<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class SidebarWire extends Component
{
    protected $listeners =["render"];
    public function render() : view
    {
        $img= Auth::user()->img;
        return view("layouts.web.panel.user.sidebar",['img'=>$img])->layout("layouts.web.panel.main");
    }

}
