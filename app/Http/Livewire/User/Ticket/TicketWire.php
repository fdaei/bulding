<?php

namespace App\Http\Livewire\User\Ticket;

use App\Helper\Utility;
use App\Models\Ticket;
use App\Models\Ticket as Model;
use App\Models\TicketResponse;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TicketWire extends Component
{
    use WithPagination , WithFileUploads , AlertTrait;
    protected $paginationTheme = 'bootstrap';
    public bool $send_mode = false;
    public Model $model;
    public $file;
    protected $rules = [
        "model.title" => "required",
        "model.priority" => "required",
        "model.message" => "required",
        "file" => "nullable",
    ];
    public function changeMode(Model $instance) : void
    {
        $this->send_mode = true;
        $this->model = $instance;
    }
    public function sendTicket() : void
    {
        $this->validate();
        $this->model->user_id = Auth::id();
        $this->model->to_admin = 1;
        $this->model->save();
        if(isset($this->file)){
            $this->model->file()->create([
                "path" => $this->file->store(Utility::pathUploads()),
            ]);
        }
        $this->successAlert("تیکت با موفقیت ارسال شد.");
        $this->model = new Model;
        $this->send_mode = false;
    }
    public function read( int $id)
    {
        $count1 = count(TicketResponse::where('ticket_id',$id)->where('is_read',0)->where('to_admin',0)->get());
        $count2 = count(Ticket::where('id',$id)->where('is_read',0)->where('to_admin',0)->get());
        return $count1+$count2;
    }
    public function render() : view
    {
        $tickets = Model::orderby("id" , "DESC")->where("user_id" , Auth::id())->orWhere("user_id" , 0)->paginate();
        return view("user.livewire.ticket.index" , compact("tickets"))
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
