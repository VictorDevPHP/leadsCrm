<div>
    @if (auth()->user()->can('admin'))
        <div style="display: flex;">
            <div
                style="flex: 0 0 250px; height: 100vh; background-color: #1a202c; padding: 20px; color: #a0aec0; flex-direction: column;">
                <button class="focus:outline-none {{ $component == 'listCustomers' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}" wire:click="selectComponent('listCustomers', '2')">
                    <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200"
                        style="margin: 30px 0;">
                        <i class="fas fa-user-alt"></i> Lista de Clientes
                    </h1>
                </button>
                <button class="focus:outline-none {{ $component == 'NewCustomer' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}" wire:click="selectComponent('NewCustomer', '2')">
                    <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200"
                        style="margin: 30px 0;">
                        <i class="fas fa-user-alt"></i> Novo Cliente
                    </h1>
                </button>
            </div>
            <div style="flex: 1; background-color: #111827; color: #a0aec0; padding: 20px;">
                @switch($component)
                    @case('listCustomers')
                        @livewire('Components.ListCustomers', ['customer_id' => auth()->user()->customer_id])
                    @break

                    @case('NewCustomer')
                        @livewire('Components.NewCustomer')
                    @break

                @default
                <!-- Código padrão caso nenhuma das condições anteriores seja atendida -->
                @endswitch
            </div>
        </div>
    @else
        <div style="display: flex;">
            <div style="flex: 0 0 250px; height: 100vh; background-color: #1a202c; padding: 20px; color: #a0aec0; flex-direction: column;">
                <button
                    class="focus:outline-none {{ $component == 'customer' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}"
                    wire:click="selectComponent('customer', {{auth()->user()->customer_id}})">
                    <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200"
                        style="margin: 30px 0;">
                        <i class="fas fa-user-alt"></i> Visão Geral
                    </h1>
                </button>
                <br>
                <button
                    class="focus:outline-none {{ $component == 'config' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}"
                    wire:click="selectComponent('config', {{auth()->user()->customer_id}})">
                    <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200"
                        style="margin: 30px 0;">
                        <i class="fas fa-cogs"></i> Configurações Gemini
                    </h1>
                </button>
                <br>
                <button
                    class="focus:outline-none {{ $component == 'connect' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}"
                    wire:click="selectComponent('connect', {{auth()->user()->customer_id}})">
                    <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200"
                        style="margin: 30px 0;">
                        <i class="fas fa-plug"></i> Conectar WhatsApp
                    </h1>
                </button>
            </div>
            <div style="flex: 1; background-color: #111827; color: #a0aec0; padding: 20px;">
                @switch($component)
                    @case('customer')
                        @livewire('Components.Customer', ['customer_id' => auth()->user()->customer_id])
                    @break

                    @case('config')
                        @livewire('Components.Config', ['customer_id' => auth()->user()->customer_id])
                    @break

                    @case('connect')
                        @livewire('Components.Connect', ['customer_id' => auth()->user()->customer_id])
                    @break

                    @default
                    <!-- Código padrão caso nenhuma das condições anteriores seja atendida -->
                @endswitch
            </div>
        </div>
    @endif
</div>