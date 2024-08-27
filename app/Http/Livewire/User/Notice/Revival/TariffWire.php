<?php

namespace App\Http\Livewire\User\Notice\Revival;

use App\Models\Order;
use App\Models\Tariff;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class TariffWire extends Component
{
    public ?int $changeBack = 0  , $prevTariff = 0;
    public Tariff $selectedTariff;

    public function mount($id):void
    {
        $this->tariffs = Tariff::where("status" , 1)->get();
        $this->changeBack = Order::where("notice_id" , $id)->get("tariff_id")[0]->tariff_id;
        $this->prevTariff = $this->changeBack;
        if (Tariff::where("status" , 0)->where("id" , $this->prevTariff)->count() <> 0)
        {
            $this->changeBack = 0;
        }
        $this->selectedTariff = Tariff::find($this->prevTariff);
        if (session()->get('dataSession')) $this->initialize();
        else
        {
            $dataSession = [
                "notice_id" => $id,
                "tariff_id" => null,
                "special" => null,
                "price" => null,
                "time" => null,
            ];
            Session::put("dataSession" , $dataSession);
        }
    }



    public function select($id) : void
    {
        $this->selectedTariff = Tariff::find($id);
        $this->changeBack = $id;
    }
    public function next():Redirector
    {
        Session::put("dataSession.tariff_id" ,$this->selectedTariff->id);
        Session::put("dataSession.special" ,$this->selectedTariff->notice_type);
        if ($this->selectedTariff->id == $this->prevTariff) Session::put("dataSession.price" ,$this->selectedTariff->revival);
        else Session::put("dataSession.price" ,$this->selectedTariff->price);
        Session::put("dataSession.time" ,$this->selectedTariff->time);
        return redirect()->route("user.submit-order" , ["id" => session()->get("dataSession.notice_id")]);
    }
    public function initialize() : void
    {
        $this->select(session()->get('dataSession.tariff_id'));
    }
    public function cancel():Redirector
    {
        Session::flush("dataSession");
        return redirect()->route("user.notice-index");
    }
    public function render():View
    {
        return view('user.livewire.notice.revival.tariff')
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
