<?php

namespace App\Http\Livewire\User\Notice;

use App\Models\Category;
use App\Models\Notice;
use App\Models\NoticeFeature;
use App\Traits\AlertTrait;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use phpDocumentor\Reflection\Types\Collection;

class UpdateCategoryWire extends Component
{
    use AlertTrait;
    public ?int $category_id = null , $notice_id = 0 , $currentCategory_id = 0;
    public bool $showButton = false;
    public $categories;
    public Notice $model;
    public function mount($id) : void
    {
        $this->notice_id = $id;
        $this->categories = Category::where("parent_id" , null)->where("name" ,"<>" , "بدون دسته بندی")->get();
        $this->currentCategory_id = Notice::find($id)->category_id;
        $this->currentCategory = Category::find($this->currentCategory_id);
    }
    public function categoryChild(int $id) : void
    {
        if (Category::find($id)->children->count() <> 0)
        {
            $this->categories = Category::find($id)->children;
        }
        else $this->category_id = $id;
    }
    public function submit():Redirector
    {
        $prevFeatures = [];
        foreach (Category::ancestorsAndSelf($this->currentCategory_id) as $item)
        {
            foreach ($item->categoryFeatures as $value)
            {
                $prevFeatures[] = $value->id;
            }
        }
        $this->model = Notice::find($this->notice_id);
        $this->model->category_id = $this->category_id ?? $this->currentCategory_id;
        if ($this->model->expire_time <> null)
        {
            $date = Carbon::parse($this->model->expire_time);
            $now = Carbon::now();
            $this->model->remained_days = $date->diffInDays($now) +1;
            $this->model->expire_time = null;
        }
        $this->model->status = 2;
        $this->model->update();

        if ($this->category_id)
        {
            $newFeatures = [];
            foreach (Category::ancestorsAndSelf($this->category_id) as $item)
            {
                foreach ($item->categoryFeatures as $value)
                {
                    $newFeatures[] = $value->id;
                }
            }
            foreach ($prevFeatures as $item)
            {
                if (!in_array($item , $newFeatures))
                {
                    NoticeFeature::where("notice_id" , $this->model->id)->where("category_feature_id" , $item)->delete();
                }
            }
        }
        $this->ToastSuccessAlertWithRedirect("دسته بندی با موفقیت ویرایش شد.");
        return redirect()->route("user.notice-index");
    }
    public function render():View
    {
        return view('user.livewire.notice.update-notice-category')
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
