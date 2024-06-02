<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Connect extends Component
{
    public $content;
    public function mount($data){
        $this->content = $data;
    }
    public function render()
    {
        return view('livewire.components.connect');
    }
}
