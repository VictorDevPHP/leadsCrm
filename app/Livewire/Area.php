<?php
namespace App\Livewire;

use Livewire\Component;

class Area extends Component{
    public $component = 'customer';
    public $customer_id;

    public function mount(){
        $this->customer_id = auth()->user()->customer_id;
    }

    public function render(){
        return view('livewire.area-customer');
    }

    /**
     * Selects a component.
     *
     * @param string $componentSelected The componentSelected component.
     * @return void
     */
    public function selectComponent(string $componentSelected, int $id): void{
        $this->component = $componentSelected;     
    }
}