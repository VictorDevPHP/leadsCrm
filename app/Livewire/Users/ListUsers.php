<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class ListUsers extends Component
{
    public $users;

    public function mount()
    {
        $this->users = (auth()->user()->can('admin') == 'admin') ? User::all() : User::where('customer_id', auth()->user()->customer_id)->get();
    }
    
    public function render()
    {
        return view('livewire.users.list-users');
    }
}
