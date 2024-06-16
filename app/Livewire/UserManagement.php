<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public $users;
    public $component = 'list-users';

    public function mount(){
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.user-management');
    }

    /**
     * Selects a component.
     *
     * @param string $componentSelected The component to be selected.
     * @return void
     */
    public function selectComponent(string $componentSelected): void{
        $this->component = $componentSelected;     
    }
}
