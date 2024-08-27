<?php

namespace App\Http\Livewire\Operator;

use App\Models\Notice;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class DashboardWire extends Component
{
    public function render():View
    {
        $users = User::all()->count();
        $ads = Notice::all()->count();
        $order=Order::all()->count();
        $ticket=Ticket::all()->count();
        return view('operator.livewire.dashboard.index' ,compact("users" , "ads","order","ticket"))
        ->extends('layouts.operator.main')
        ->section('content');
    }
}
