<?php

namespace App\Http\Livewire\User;

use App\Helper\Utility;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\User as Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class DashboardWire extends Component
{
    public Model $model;
    public function mount() : void
    {
        $this->model = Auth::user();
    }
    public function render():View
    {
        $openedTicket = Ticket::where("is_close" , "0")->where("user_id" , $this->model->id)->count();
        $orders = Order::where("user_id" , $this->model->id)->count();
        $activeNotice = Notice::where("expired" , "0")->where("user_id" , $this->model->id)->count();
        $joinDate = Utility::convertToSWithOutTime(Auth::user()->created_at);
        return view('user.livewire.dashboard.index', compact("openedTicket" , "orders" , "activeNotice" , "joinDate"))
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
