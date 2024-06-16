<div>
    <div style="display: flex;">
        <div style="flex: 0 0 250px; height: 100vh; background-color: #1a202c; padding: 20px; color: #a0aec0; flex-direction: column;">
            <button class="focus:outline-none {{ $component == 'list-users' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}" wire:click="selectComponent('list-users', {{auth()->user()->customer_id}})">
                <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200" style="margin: 30px 0;">
                    <i class="fas fa-user-alt"></i>  Lista de Usuários
                </h1>
            </button>
            <button class="focus:outline-none {{ $component == 'invit-users' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}" wire:click="selectComponent('invit-users', {{auth()->user()->customer_id}})">
                <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200" style="margin: 30px 0;">
                    <i class="fas fa-user-plus"></i> Convidar Usuários
                </h1>
            </button>
        </div>
        <div style="flex: 1; background-color: #111827; color: #a0aec0; padding: 20px;">
            @switch($component)
                @case('list-users')
                    @livewire('Users.list-users')
                    @break

                @case('invit-users')
                    @livewire('Users.invit-users')
                    @break
                @default
                    <!-- Código padrão caso nenhuma das condições anteriores seja atendida -->
            @endswitch
        </div>
    </div>
</div>