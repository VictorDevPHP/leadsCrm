<?php

namespace App\Livewire\Components;

use App\Http\Controllers\API\OpenAI\Create;
use Livewire\Component;

class OpenAi extends Component
{
    public $name;
    public $instruct;
    public $model;
    protected $rules = [
        'name' => 'required|string|max:255',
        'instruct' => 'required|string',
        'model' => 'required|string|max:255',
    ];
    public function mount($customer_id){
       
    }
    public function render()
    {
        return view('livewire.components.open-ai');
    }

    public function submit()
    {
        $this->validate();
        $Create = new Create();
        $response = $Create->createAssistant([
            'name' => $this->name,
            'instruct' => $this->instruct,
            'model' => $this->model
        ]);

        session()->flash('message', 'Assistente criado com sucesso.');
    }

}
