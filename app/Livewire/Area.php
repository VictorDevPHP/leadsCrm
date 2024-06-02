<?php

namespace App\Livewire;

use Livewire\Component;

class Area extends Component{
    public $content = 'customer';
    public function render()
    {
        return view('livewire.area-customer');
    }

    /**
     * Selects a component.
     *
     * @param string $selected The selected component.
     * @return void
     */
    public function selectComponent(string $selected): void{
        $this->content = $selected;     
    }
}
