<?php

namespace App\Http\Livewire\Operator\Ticket;

use App\Helper\Utility;
use App\Models\Ticket as Model;
use App\Models\TicketResponse;
use App\Models\TicketResponse as Response;
use App\Traits\AlertTrait;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowWire extends Component
{
    use WithFileUploads,WithPagination,AlertTrait;
    public ?Model $model;
    public ?Response $response;
    public Collection $items;
    public $file;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
            'response.message'=>'required',
        ];
    public function insert():void
    {
        if($this->validate()) {
            $this->model->is_read=1;
            $this->response->ticket_id=$this->model->id;
            $this->response->to_admin=0;
            $this->response->is_read=0;
            $this->model->update();
            $this->response->save();
            if($this->file)
            {
                $this->response->file()->create([
                    'path'=>$this->file->store('photos'),
                ]);
            }
            $this->successAlert();
            $this->items=TicketResponse::where('ticket_id',$this->model->id)->get();
            $this->response=new Response;
        }
    }
    public function changeitem($id):void
    {
        $this->model=Model::find($id);
    }
    public function responesfile($id)
    {
        $item=Response::find($id);
        return response()->download(storage_path(Utility::uploadFiles($item->file->path)));
    }
    public function export()
    {
        if($this->model->file != null) return response()->download(storage_path(Utility::uploadFiles($this->model->file->path)));
    }
    public function mount($id):void
    {
        $this->response=new Response;
        $this->model=Model::find($id);
        $this->items=TicketResponse::where('ticket_id',$id)->get();
    }
    public function render():View
    {
        return view('operator.livewire.ticket.show',['items'=>$this->items])->extends('layouts.operator.main')->section('content');
    }
}
