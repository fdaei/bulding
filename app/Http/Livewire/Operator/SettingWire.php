<?php

namespace App\Http\Livewire\Operator;

use App\Enums\KeySettingsEnum;
use App\Models\Setting;
use App\Models\Setting as Model;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;

class SettingWire extends Component
{
    use AlertTrait;
    public string $instagram = "" , $tel = "" , $email = "";

    protected $rules = [
        "instagram" => "nullable",
        "tel" => "nullable|regex:/(09)[0-9]{9}/",
        "email" => "nullable|email:rfc,dns",
    ];
    public function mount(Model $modelInstance) : void
    {
        $this->model = $modelInstance;
        if (Model::all()->count() <> 0)
        {
            $this->instagram = Model::all()[0]->instagram;
            $this->tel = Model::all()[0]->tel;
            $this->email = Model::all()[0]->email;
        }
    }
    public function createOrUpdate() : void
    {
        $this->validate();
        Model::updateOrCreate([
            "key" => 1,
        ],
        [
            "tel" => $this->tel,
            "email" => $this->email,
            "instagram" => $this->instagram,
        ]);
        $this->successAlert();
    }
    public function render() : view
    {
        return view('operator.livewire.setting.index')->extends('layouts.operator.main')->section('content');
    }
}
