<?php

namespace App\Http\Livewire\Web\Notice;

use App\Models\Tariff;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class TariffWire extends Component
{
    use AlertTrait;
    public ?int $currentStep = 3,$changeBack = 0 ;
    public  $selectedTariff = null;
    public function mount(Tariff $instance) : void
    {
        $this->tariffs = Tariff::where("status" , "1")->get();
        if (session()->get('noticeData.tariff_id')) $this->initialize();
    }
    public function initialize() : void
    {
        $this->select(session()->get('noticeData.tariff_id'));
    }
    public function select($id) : void
    {
        $this->selectedTariff = Tariff::find($id);
        $this->changeBack = $id;
    }
    public function next() : Redirector
    {
        $validator = Validator::make(
            [
                'selectedTariff'  => $this->selectedTariff,
            ],
            [
                "selectedTariff" => "required",
            ]
        );
        if ($validator->fails())
        {
            $this->warningAlert("تعرفه را انتخاب کنید");
        }
        else
        {
            Session::put("noticeData.special" ,$this->selectedTariff->notice_type);
            Session::put("noticeData.price" ,$this->selectedTariff->price);
            Session::put("noticeData.time" ,$this->selectedTariff->time);
            Session::put("noticeData.tariff_id" ,$this->selectedTariff->id);
            return redirect()->route("submit-order");
        }
    }
    public function render() : view
    {
        return view('web.livewire.notice-create.notice-tariff')
            ->extends("layouts.web.main")
            ->section("content");
    }
}
