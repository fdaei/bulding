<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;

class MapWire extends Component
{
    public function render()
    {
        return <<<'blade'
                <div id="map-id" style="height: inherit"></div>
        blade;
    }
}
