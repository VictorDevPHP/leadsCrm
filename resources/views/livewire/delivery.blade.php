<div class="p-6" wire:poll.10s='loadTasks'>
    <div class="p-6">
        <div class="spinner-container" wire:loading>
            <i class="fas fa-spinner fa-spin fa-lg"></i>
        </div>
        <div class="flex space-x-4">
            <div id="recebido" class="flex-1 bg-gray-100 p-4 rounded-lg shadow-md task-container"
                data-status="recebido">
                <h2 class="text-lg font-semibold mb-2 text-gray-700 sticky-header">
                    <i class="fas fa-inbox"></i> Recebido
                </h2>
                <div class="space-y-2" id="recebido-tasks">
                    @foreach ($tasks['recebido'] as $task)
                    <div wire:click="showTaskDetails({{ $task->id }}, '{{ $task->status_kanban }}')"
                        class="task bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        data-id="{{ $task->id }}">
                        <p class="text-gray-600">Nº Pedido {{ $task->id }}</p>
                        <strong class="text-blue-600">{{ $task->name_client }}</strong><br>
                        <p class="text-gray-600">
                            <a href="https://wa.me/{{ $task->whatsapp }}" target="_blank" class="text-green-500 hover:underline flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                <span class="text-black"><b>WhatsApp:</b> </span>
                                <span class="text-green-500"> {{ $task->whatsapp }}</span>
                            </a>
                        </p>
                        <p class="text-gray-600"><b>Metodo Pagamento: </b>{{ $task->metodo_pagamento }}</p>    
                        @php
                            $produtos = json_decode($task->description, true);
                        @endphp
                        @if(isset($produtos['produtos']) && is_array($produtos['produtos']))
                            <ul class="list-disc ml-5 mt-2">
                                @foreach($produtos['produtos'] as $produto)
                                    <li>
                                        {{ $produto['quantidade'] }} <b>{{ $produto['nome'] }}</b>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <br>
                        <br>
                        <p class="text-gray-600"><b>Endereço: </b>{{ $task->endereco }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="em-andamento" class="flex-1 bg-gray-100 p-4 rounded-lg shadow-md task-container"
                data-status="em andamento">
                <h2 class="text-lg font-semibold mb-2 text-gray-700 sticky-header">
                    <i class="fas fa-spinner fa-spin fa-lg"></i> Em Andamento
                </h2>
                <div class="space-y-2" id="em-andamento-tasks">
                    @foreach ($tasks['em andamento'] as $task)
                    <div wire:click="showTaskDetails({{ $task->id }}, '{{ $task->status_kanban }}')"
                        class="task bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        data-id="{{ $task->id }}">
                        <p class="text-gray-600">Nº Pedido {{ $task->id }}</p>
                        <strong class="text-blue-600">{{ $task->name_client }}</strong><br>
                        <p class="text-gray-600">
                            <a href="https://wa.me/{{ $task->whatsapp }}" target="_blank" class="text-green-500 hover:underline flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                <span class="text-black"><b>WhatsApp:</b> </span>
                                <span class="text-green-500"> {{ $task->whatsapp }}</span>
                            </a>
                        </p>
                        <p class="text-gray-600"><b>Metodo Pagamento: </b>{{ $task->metodo_pagamento }}</p>   
                        @php
                            $produtos = json_decode($task->description, true);
                        @endphp
                        @if(isset($produtos['produtos']) && is_array($produtos['produtos']))
                            <ul class="list-disc ml-5 mt-2">
                                @foreach($produtos['produtos'] as $produto)
                                    <li>
                                        {{ $produto['quantidade'] }} - <b>{{ $produto['nome'] }}</b>
                                    </li>
                                @endforeach
                            </ul>
                        @endif             
                        <br>
                        <br>
                        <p class="text-gray-600"><b>Endereço: </b>{{ $task->endereco }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="saiu-para-entrega" class="flex-1 bg-gray-100 p-4 rounded-lg shadow-md task-container"
                data-status="saiu para entrega">
                <h2 class="text-lg font-semibold mb-2 text-gray-700 sticky-header">
                    <i class="fas fa-truck"></i> Saiu para Entrega
                </h2>
                <div class="space-y-2" id="saiu-para-entrega-tasks">
                    @foreach ($tasks['saiu para entrega'] as $task)
                    <div wire:click="showTaskDetails({{ $task->id }}, '{{ $task->status_kanban }}')"
                        class="task bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        data-id="{{ $task->id }}">
                        <p class="text-gray-600">Nº Pedido {{ $task->id }}</p>
                        <strong class="text-blue-600">{{ $task->name_client }}</strong><br>
                        <p class="text-gray-600">
                            <a href="https://wa.me/{{ $task->whatsapp }}" target="_blank" class="text-green-500 hover:underline flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                <span class="text-black"><b>WhatsApp:</b> </span>
                                <span class="text-green-500"> {{ $task->whatsapp }}</span>
                            </a>
                        </p>
                        <p class="text-gray-600"><b>Metodo Pagamento: </b>{{ $task->metodo_pagamento }}</p>
                        @php
                            $produtos = json_decode($task->description, true);
                        @endphp
                        @if(isset($produtos['produtos']) && is_array($produtos['produtos']))
                            <ul class="list-disc ml-5 mt-2">
                                @foreach($produtos['produtos'] as $produto)
                                    <li>
                                        {{ $produto['quantidade'] }} - <b>{{ $produto['nome'] }}</b>
                                    </li>
                                @endforeach
                            </ul>
                        @endif                        
                        <br>
                        <br>
                        <p class="text-gray-600"><b>Endereço: </b>{{ $task->endereco }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="finalizado" class="flex-1 bg-gray-100 p-4 rounded-lg shadow-md task-container"
                data-status="finalizado">
                <h2 class="text-lg font-semibold mb-2 text-gray-700 sticky-header">
                    <i class="fas fa-check-circle"></i> Finalizado
                </h2>
                <div class="space-y-2" id="finalizado-tasks">
                    @foreach ($tasks['finalizado'] as $task)
                    <div wire:click="showTaskDetails({{ $task->id }}, '{{ $task->status_kanban }}')"
                        class="task bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out relative"
                        data-id="{{ $task->id }}">
                    
                        <p class="text-gray-600">Nº Pedido {{ $task->id }}</p>
                        <strong class="text-blue-600">{{ $task->name_client }}</strong><br>
                        <p class="text-gray-600">
                            <a href="https://wa.me/{{ $task->whatsapp }}" target="_blank" class="text-green-500 hover:underline flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                <span class="text-black"><b>WhatsApp:</b> </span>
                                <span class="text-green-500"> {{ $task->whatsapp }}</span>
                            </a>
                        </p>  
                        
                        <p class="text-gray-600"><b>Metodo Pagamento: </b>{{ $task->metodo_pagamento }}</p>
                        @php
                            $produtos = json_decode($task->description, true);
                        @endphp
                        @if(isset($produtos['produtos']) && is_array($produtos['produtos']))
                            <ul class="list-disc ml-5 mt-2">
                                @foreach($produtos['produtos'] as $produto)
                                    <li>
                                        {{ $produto['quantidade'] }} - <b>{{ $produto['nome'] }}</b>
                                    </li>
                                @endforeach
                            </ul>
                        @endif                       
                        <br>
                        <br>
                        <p class="text-gray-600"><b>Endereço: </b>{{ $task->endereco }}</p>
                        <button wire:click.prevent="endDelivery({{ $task->id }})"
                            class="absolute bottom-2 right-2 p-2 bg-blue-500 text-white rounded-full shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    
                    @endforeach
                </div>
            </div>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let isDragging = false;
            let clickTimeout = null;
            let activeDropzone = null;
            interact('.task')
                .draggable({
                    inertia: false,
                    autoScroll: false,
                    onstart: function () {
                        isDragging = true;
                        clearTimeout(clickTimeout);
                        if (activeDropzone) {
                            activeDropzone.style.flex = '2';
                        }
                    },
                    onmove: dragMoveListener,
                    onend: function (event) {
                        var target = event.target;
                        target.style.transform = 'none';
                        target.removeAttribute('data-x');
                        target.removeAttribute('data-y');
                        isDragging = false;
                        document.querySelectorAll('.task-container').forEach(column => {
                            if (column !== activeDropzone) {
                                column.style.flex = '1';
                            }
                        });
                        activeDropzone = null;
                    }
                });
                interact('.task-container').dropzone({
                    accept: '.task',
                    overlap: 0.75,
                    ondropactivate: function (event) {
                        event.target.classList.add('drop-active');
                    },
                    ondragenter: function (event) {
                        var draggableElement = event.relatedTarget,
                        dropzoneElement = event.target;
                        dropzoneElement.classList.add('drop-target');
                        draggableElement.classList.add('can-drop');
                        activeDropzone = dropzoneElement;
                    },
                    ondragleave: function (event) {
                        event.target.classList.remove('drop-target');
                        event.relatedTarget.classList.remove('can-drop');
                    },
                    ondrop: function (event) {
                        var taskId = event.relatedTarget.getAttribute('data-id');
                        var newStatus = event.target.getAttribute('data-status');

                        Livewire.dispatch('taskDropped', [taskId, newStatus]);
                    },
                    ondropdeactivate: function (event) {
                        event.target.classList.remove('drop-active');
                        event.target.classList.remove('drop-target');
                    }
                });
                document.querySelectorAll('.task').forEach(task => {
                    task.addEventListener('mousedown', function () {
                        clickTimeout = setTimeout(() => {
                            clickTimeout = null;
                        });
                    });
                    task.addEventListener('mouseup', function () {
                        if (!isDragging && clickTimeout) {
                            clearTimeout(clickTimeout);
                            const taskId = this.getAttribute('data-id');
                            Livewire.dispatch('taskClicked', taskId);
                        }
                    });
                });
                function dragMoveListener(event) {
                    var target = event.target,
                        x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
                        y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                    target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                }

                window.dragMoveListener = dragMoveListener;
            });
    </script>
    <style>
        .task-container {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 250px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 16px;
            transition: flex 0.3s ease, box-shadow 0.3s ease;
            overflow: visible;
        }
        .task.dragging {
                z-index: 1000;
                position: absolute;
                transform: translate3d(0, 0, 0);
            }
        .task {
            -webkit-user-drag: none;
            user-drag: none;
            border: 1px solid #d1d5db;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.3s;
            cursor: grab;
            padding: 12px;
            user-select: none;
            position: relative;
            overflow: hidden;
        }
        .task button {
            position: absolute;
            bottom: 10px;
            right: 10px; 
            background-color: #3b82f6;
            color: #ffffff;
            border: 2px solid #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .task:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.03);
        }
        .task:active {
            cursor: grabbing;
        }
        .task strong {
            color: #2563eb;
            font-size: 1.2rem;
            display: block;
            margin-bottom: 8px;
        }

        .task p {
            color: #6b7280;
            font-size: 0.95rem;
        }
        h2 {
            display: flex;
            align-items: center;
            font-size: 1.125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
        }
        h2 i {
            margin-right: 8px;
            color: #3b82f6;
            font-size: 1.2rem;
        }
        .spinner-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .task:active,
        .task:active * {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        .sticky-header {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 1;
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
        }
    </style>


</div>