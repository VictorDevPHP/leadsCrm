<?php

namespace App\Livewire\Components;

use App\Http\Controllers\API\OpenAI\Resource\{Create, Retrieve};
use App\Http\Controllers\API\OpenAI\Resource\Modify;
use App\Http\Controllers\API\OpenAI\Services\GetKeyFunction;
use App\Models\Customer;
use App\Models\CustomerAssistant;
use Livewire\Component;

class OpenAi extends Component
{
    public $customer_id;
    public $id_assistant;
    public $active;
    public $name;
    public $instruct;
    public $model;
    public $assistant;
    public $functions;
    public $selectedFunction = [];
    protected $rules = [
        'customer_id' => 'required|exists:customers,id',
        'active' => 'required|boolean',
        'name' => 'required|string|max:255',
        'instruct' => 'required|string',
        'model' => 'required|string',
    ];
    public function mount($customer_id){
       $this->assistant = CustomerAssistant::where('customer_id', $customer_id)->first() ?? null;
       $this->functions = config('functions');
       if(isset($this->assistant)){
            $response = (new Retrieve())->retrieveAssistant($this->assistant->id_assistant);
            $this->selectedFunction = array_map(function($tool) {
                return $tool['function']['name'];
            }, $response->tools);
            $this->name = $response->name;
            $this->instruct = $response->instructions;
            $this->model = $response->model;
            $this->active = $this->assistant->active;
            $this->id_assistant = $this->assistant->id_assistant;
        }

    }
    public function render()
    {
        return view('livewire.components.open-ai');
    }

    public function submit()
    {
        $this->validate();
        $functions = GetKeyFunction::getKeyByFunctionName($this->selectedFunction);
        if (isset($this->id_assistant)) {
            $response = (new Modify())->modifyAssistant([
                'name' => $this->name,
                'instruct' => $this->instruct,
                'model' => $this->model,
                'tools' => $functions
            ], $this->id_assistant, $functions);
        } else {
            $response = (new Create())->createAssistant([
                'name' => $this->name,
                'instruct' => $this->instruct,
                'model' => $this->model,
                'tools' => $functions
            ]);
        }

        CustomerAssistant::updateOrCreate(
            ['customer_id' => $this->customer_id],
            [
                'id_assistant' => $response->id,
                'active' => $this->active,
                'session_name' => 'session-'.Customer::where('id', $this->customer_id)->value('whatsapp'),
            ]
        );

        $this->dispatch('swal:modal', [
            'title'             => 'Assistente Atualizado',
            'icon'              => 'success',
            'customClass'       => '',
            'showCloseButton'   =>  false,
            'showCancelButton'  =>  false,
            'showConfirmButton' =>  true,
            'confirmButtonText' =>  'Ok',
            'cancelButtonText'  =>  'Cancelar',
            'module'            =>  'QRCode',
        ]);
    }

}
