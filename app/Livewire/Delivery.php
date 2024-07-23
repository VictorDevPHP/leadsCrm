<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use App\Models\KanbanTask;

class Delivery extends Component
{
    public $tasks = [];
    protected $listeners = ['taskDropped'];
    public $customer;
    public function mount()
    {
        $customer_id = auth()->user()->customer_id;
        $this->customer = Customer::where('id', $customer_id)->first();
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = [
            'recebido' => KanbanTask::where('status_kanban', 'recebido')
                ->where('session_name', 'session-'.$this->customer->whatsapp)
                ->orderBy('id', 'desc')
                ->get(),
    
            'em andamento' => KanbanTask::where('status_kanban', 'em andamento')
                ->where('session_name', 'session-'.$this->customer->whatsapp)
                ->orderBy('id', 'desc')
                ->get(),
    
            'finalizado' => KanbanTask::where('status_kanban', 'finalizado')
                ->where('session_name', 'session-'.$this->customer->whatsapp)
                ->orderBy('id', 'desc')
                ->get(),
    
            'saiu para entrega' => KanbanTask::where('status_kanban', 'saiu para entrega')
                ->where('session_name', 'session-'.$this->customer->whatsapp)
                ->orderBy('id', 'desc')
                ->get(),
        ];
    }
    

    public function taskDropped($taskId, $newStatus)
    {
        $task = KanbanTask::find($taskId);
        if ($task) {
            $task->status_kanban = $newStatus;
            $task->save();
            $this->loadTasks();
        }
    }
    public function showTaskDetails($taskId, $taskStatus)
    {
        $task = KanbanTask::find($taskId);
        if ($task) {
            $this->dispatch('showTaskDetails', [
                'name_client' => $task->name_client,
                'description' => $task->description,
            ]);
        }
    }

    public function endDelivery($taskId)
    {
        $task = KanbanTask::find($taskId);
        if ($task) {
            dd('fazer tratamento');
        }
    }

    public function render()
    {
        return view('livewire.delivery');
    }
}
