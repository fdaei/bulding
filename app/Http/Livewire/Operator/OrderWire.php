<?php

namespace App\Http\Livewire\Operator;

use App\Helper\Utility;
use App\Models\Category;
use App\Models\Order;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class OrderWire extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';
    public string $date = "";
    public ?string $filter_base_category = null;
    public function is_paid($id,$value) : void
    {
        $model = Order::find($id);
        $model->is_paid = $value;
        $model->update();
    }
    public function render() : view
    {
        $dateFilter = Utility::convertToAd($this->date);
        $categories = Category::orderby("id" , "DESC")->get();
        $orders = Order::orderby("orders.id" , "DESC");
        if($this->filter_base_category <> null and $this->date == null){
            $orders->selectRaw("orders.* , categories.name, notices.title")->join('notices', function ($join) {
                $join->on('notices.id', '=', 'orders.notice_id')->join('categories',function($notice_join){
                    $notice_join->on('categories.id','=','notices.category_id')->where('categories.id',$this->filter_base_category);
                });
            });

        }
        if($this->date <> null and $this->filter_base_category == null){
            $orders->where("orders.created_at" ,"like" , "%" . $dateFilter."%");
        }
        if($this->filter_base_category <> null and $this->date <> null)
        {
            $orders->orWhere("orders.created_at" ,"like" , "%" . $dateFilter."%")->selectRaw("orders.* , categories.name, notices.title")->join('notices', function ($join) {
                $join->on('notices.id', '=', 'orders.notice_id')->join('categories',function($notice_join){
                    $notice_join->on('categories.id','=','notices.category_id')->where('categories.id',$this->filter_base_category);
                });
            });
        }
        $items = $orders->paginate();
        return view("operator.livewire.oreder.index" , compact( "categories" , "items"))->extends("layouts.operator.main")->section("content");
    }
}
