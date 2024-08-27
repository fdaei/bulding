<?php

namespace App\Http\Livewire\Operator;

use App\Models\Comment as Model;
use Illuminate\View\View;
use Livewire\Component;

class CommentWire extends Component
{
    public Model $model;
    public bool $show=false;
    public function mount(Model $comment): void
    {
        $this->model = $comment;
    }
    public function show($id): void
    {
        $this->model = Model::find($id);
      $this->show=!$this->show;
    }
    public function changeStatus(Model $comment, int $status): void
    {
        $comment->update([
            'status' => $status
        ]);
    }
    public function render():View
    {
        $items=Model::orderby('id', 'desc')->paginate();
        return view('operator.livewire.comment.index',['items'=>$items])->extends('layouts.operator.main')->section('content');
    }
}
