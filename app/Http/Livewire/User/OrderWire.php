<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class OrderWire extends Component
{
    use WithPagination;



    protected $paginationTheme = 'bootstrap';
    public function render() : view
    {
        $orders = Order::orderBy("id" , "DESC")->where("user_id" , Auth::id())->paginate();
        return view('user.livewire.order.index' , compact("orders"))
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
