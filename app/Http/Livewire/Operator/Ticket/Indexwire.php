<?php

namespace App\Http\Livewire\Operator\Ticket;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Indexwire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function seen(int $id):void
    {
        $ticket  = Ticket::find($id);
        if($ticket->to_admin)
        {
            $ticket->is_read = 1;
            $ticket->update();

            foreach ($ticket->responses as $item)
            {
                if ($item->to_admin)
                {
                    $item->is_read = 1;
                    $item->update();
                }
            }
        }
    }
    public function read( int $id)
    {
        $count1 = count(TicketResponse::where('ticket_id', $id)->where('is_read', 0)->where('to_admin', 1)->get());
        $count2 = count(Ticket::where('id', $id)->where('is_read', 0)->where('to_admin', 1)->get());
        return $count1+$count2;
    }
    public function render():View
    {
        $items=Ticket::orderby('priority')->orderby('is_close')->paginate();
        return view('operator.livewire.ticket.index',['items'=>$items])->extends('layouts.operator.main')->section('content');
    }
}
