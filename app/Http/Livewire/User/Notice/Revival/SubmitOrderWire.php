<?php

namespace App\Http\Livewire\User\Notice\Revival;

use App\Enums\InputTypeEnum;
use App\Models\CategoryFeature;
use App\Models\Notice;
use App\Models\Notice as Model;
use App\Models\NoticeFeature;
use App\Models\Order;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class SubmitOrderWire extends Component
{
    use AlertTrait;
    public Model $model;
    public $noticeFeatures;
    public function mount():void
    {
        $this->model = Model::find(session()->get("dataSession.notice_id"));
        $this->noticeFeatures = NoticeFeature::join('category_features', 'notice_features.category_feature_id', '=', 'category_features.id')
            ->where("notice_features.notice_id" , session()->get("dataSession.notice_id"))
            ->get(['notice_features.*', 'category_features.name', 'category_features.type']);
    }
    public function submitOrder():Redirector
    {
        $currentFactor = Order::where("notice_id" , session()->get("dataSession.notice_id"))
            ->where("status" , 1)->get("status");
        $currentFactor[0]->status = 0;
        $currentFactor[0]->update();

        $currentNotice = Notice::find(session()->get("dataSession.notice_id"));
        $currentNotice->expire_time = null;
        $currentNotice->expired = 0;
        $currentNotice->status = 2;
        $currentNotice->update();

        Order::create([
            "user_id" => Auth::id(),
            "notice_id" =>session()->get("dataSession.notice_id"),
            "price" => session()->get("dataSession.price"),
            "is_paid" => 0,
            "tariff_id" => session()->get("dataSession.tariff_id"),
        ]);
        $this->ToastSuccessAlertWithRedirect("آگهی با موفقیت تمدید شد.");
        return redirect()->route("user.notice-index");
    }
    public function render():View
    {
        return view('user.livewire.notice.revival.submit-order')
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
