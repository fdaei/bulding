<?php

namespace App\Http\Livewire\Web\Notice;

use App\Helper\Utility;
use App\Models\Category;
use App\Models\Notice as Model;
use App\Models\State;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Redirector;
use Livewire\Component;

class ChooseCategoryWire extends Component
{
    use AlertTrait;


    public ?int $currentStep = 1 ;
    public $category;
    public ?int $category_id = null;
    public bool $showButton = false;
    public array $features;



    public function mount() : void
    {
        $this->category = Category::where("parent_id" , null)->where("name" ,"<>" , "بدون دسته بندی")->get();
        if (session()->get('noticeData.category_id')) $this->initialize();
    }
    public function categoryChild(int $id) : void
    {
        if (Category::find($id)->children->count() <> 0)
        {
            $this->category = Category::find($id)->children;
        }
        else
        {
            $this->category_id = $id;
            $this->submitFirstStep();
        }

    }
    public function submitFirstStep() : Redirector
    {
        if (Session::has("noticeData"))
        {
            Session::put("noticeData.category_id" , $this->category_id);
        }
        else
        {
            $noticeData = [
                "user_id" => Auth::id(),
                "category_id" => $this->category_id,
                "title" => null,
                "lat" => null,
                "lng" => null,
                "context" => null,
                "state_id" => null,
                "city_id" => null,
                "address" => null,
                "image" => null,
                "gallery" => null,
                "special" => null,
                "price" => null,
                "time" => null,
                "tariff_id" =>null,
            ];
            Session::put("noticeData" , $noticeData);
        }
        return redirect()->route("notice-details");
    }
    public function initialize() : void
    {
        $this->category_id = session()->get('noticeData.category_id');
    }
    public function render() : view
    {
        return view('web.livewire.notice-create.choose-category')
            ->extends("layouts.web.main")
            ->section("content");
    }
}
