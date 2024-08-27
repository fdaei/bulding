<?php
namespace App\Traits;

use App\Models\City;
use App\Models\State;
use Illuminate\Support\Collection;

trait CityTrait
{

    public ?Collection $cities=null;

    public Collection $States;

    public function getCity(): void
    {
        $this->cities = City::where('state_id', $this->model->state_id)->orderBy('id')->get();
    }
}
