<?php

namespace App\Http\Livewire\Operator\Ticket;

use App\Helper\Utility;
use App\Models\Ticket as Model;
use App\Models\TicketFile;
use App\Models\User;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateWire extends Component
{
    use WithFileUploads,AlertTrait;
    public ?Model $model;
    public bool $hidden=false;
    public $users_id;
    public $file;
    protected $paginationTheme = 'bootstrap';
        protected $rules = [
            'model.title'=>'required',
            'model.message'=>'required',
            'model.priority'=>'required',
        ];
    public function mount(Model $i): void
    {
        $this->model = $i;
    }
    public function insert():void
    {

        if($this->validate()) {
            $this->model->to_admin=0;
            $this->model->is_close=0;
            $this->model->is_read=0;
        if($this->users_id)
        {
            foreach ($this->users_id as $id)
            {
                $this->model->user_id=$id;
                $this->model->save();
            }
        }
        else
        {
            $this->model->user_id=0;
            $this->model->save();
        }
            if($this->file)
            {
                $this->model->file()->create([
                    'path'=>$this->file->store('photos'),
                ]);
            }
            $this->model = null;
        }
        $this->successAlert();
        $this->model=new Model();
    }
    public function visible():void
    {
            $this->hidden=!$this->hidden;
    }
    public function render():View
    {
        $users=User::orderby('id')->get();
        return view('operator.livewire.ticket.create',['users'=>$users])->extends('layouts.operator.main')->section('content');
    }
}
