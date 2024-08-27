<?php

namespace App\Http\Livewire\Operator\Notice;

use App\Enums\TypeCommentEnum;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Notice as Model;
use App\Models\Order;
use App\Traits\AlertTrait;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination, AlertTrait;

    public string $status = "", $changecategory = "", $code = "", $name = "", $username = "";
    protected $listeners = ["delete"];
    protected $paginationTheme = 'bootstrap';
    public bool $changetype = false;

    public function delete($id):void
    {
        Model::destroy($id);
        $this->successAlert();
    }

    public function changeStatus(Model $notice, int $status): void
    {
        if(Order::where("notice_id" , $notice->id)->where("status" , 1)->get())
        {
            $this->dangerAlert("شما قادر به انجام این عملیات نمی باشید ");
        }
        else{

            if (Order::where("notice_id" , $notice->id)->where("status" , 1)->get()[0]->tariff->time <> -1)
            {
                if (($status == TypeCommentEnum::CONFIRM) and $notice->remained_days <> null)
                {
                    $notice->expire_time = Carbon::now()->addDays($notice->remained_days);
                    $notice->remained_days = null;
                }
                elseif($status == TypeCommentEnum::CONFIRM)
                {
                    $notice->expire_time = Carbon::now()->addDays(Order::where("notice_id" , $notice->id)
                        ->where("status" , 1)
                        ->get()[0]->tariff->time);
                }
            }
            $notice->update([
                'status' => $status,
            ]);
        }
    }

    public function render():View
    {
        $model = Model::orderBy('id', 'desc');
        if ($this->changetype) $model->where('especial', $this->changetype);
        if ($this->status || $this->status === 0) $model->where('status', $this->status);
        if ($this->changecategory) $model->where('category_id', $this->changecategory);
        if ($this->name) $model->where('title', 'LIKE', "%" . $this->name . "%");
        if ($this->code) $model->where('id', $this->code);
        if ($this->username) {
            $items = Model::join("users", 'users.id', '=', 'notices.user_id')
                ->where("users.phone_number", 'like', '%' . $this->username . '%')->paginate(10);
        } else {
            $items = $model->paginate(10);
        }
        $categorys = Category::orderby('id')->get();
        return view('operator.livewire.notice.index', ['items' => $items, 'categorys' => $categorys])->extends('layouts.operator.main')->section('content');
    }
}
