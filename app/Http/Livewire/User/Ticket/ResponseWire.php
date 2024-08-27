<?php

namespace App\Http\Livewire\User\Ticket;

use App\Helper\Utility;
use App\Models\Ticket;
use App\Models\TicketResponse as Model;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ResponseWire extends Component
{
    use WithPagination , WithFileUploads , AlertTrait;
    protected $paginationTheme = 'bootstrap';
    public int $ticket_id = 0;
    public Ticket $ticket;
    public Model $model;
    public $file;
    protected $rules = [
        "model.message" => "required",
        "file" => "nullable",
    ];
    public function mount(int $id , Model $instance) : void
    {
        $this->model = $instance;
        $this->ticket_id = $id;
        $this->ticket = Ticket::find($id);
        $this->ticket->is_read=1;
        $this->ticket->save();
    }
    public function sendResponse() : void
    {
        $this->validate();
        $this->model->ticket_id = $this->ticket_id;
        $this->model->to_admin = 1;
        $this->model->is_read = 0;
        $this->is_read = 0;
        $this->model->save();
        if(isset($this->file)){
            $this->model->file()->create([
                "path" => $this->file->store(Utility::pathUploads()),
            ]);
        }
        $this->successAlert("تیکت با موفقیت ارسال شد.");
        $this->model = new Model;
        unset($this->file);
    }
    public function seen($id) : void
    {
        $read_message = Model::find($id);
        if(!$read_message->to_admin)
        {
            $read_message->is_read = 1;
            $read_message->update();
        }
    }
    public function download($id)
    {
        $response_file =Model::find($id);
        if($response_file->file != null) return response()->download(storage_path(Utility::uploadFiles($response_file->file->path)));
    }
    public function export()
    {
        if($this->ticket->file != null) return response()->download(storage_path(Utility::uploadFiles($this->ticket->file->path)));
    }
    public function render() : view
    {
        $responses = Model::orderBy("id" , "DESC")->where("ticket_id" , $this->ticket_id)->paginate();
        return view("user.livewire.ticket.response" , compact("responses"))
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
