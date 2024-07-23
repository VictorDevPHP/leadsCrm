<div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full mx-auto relative">  
    <br>
    <h2 class="text-2xl font-bold mb-6 text-white">
        <i class="fas fa-robot mr-2"></i>{{isset($assistant)? 'Atualizar Assistente:' : 'Criar Assistente:'}}
    </h2>
    <div class="absolute top-0 right-0 mt-2 mr-2">
        <span class="status-indicator {{ $active ? 'bg-green-500' : 'bg-red-500' }}"></span>
    </div>
    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-300">
                <i class="fas fa-user mr-2"></i>Nome:
            </label>
            <input type="text" id="name" wire:model="name" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="instruct" class="block text-sm font-medium text-gray-300">
                <i class="fas fa-clipboard mr-2"></i>Instrução:
            </label>
            <textarea id="instruct" wire:model="instruct" rows="4" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            @error('instruct') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="model" class="block text-sm font-medium text-gray-300">
                <i class="fas fa-cogs mr-2"></i>Modelo:
            </label>
            <select id="model" wire:model="model" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Selecione um modelo</option>
                <option value="gpt-4o">Alpha (Mais avançado)</option>
                <option value="gpt-4o-mini">Bravo (Intermediario)</option>  
                <option value="gpt-4-1106-preview">Charlie (Moderado)</option>
                <option value="gpt-3.5-turbo-1106">Delta (Econômico)</option>
            </select>
            @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-300">
                <i class="fas fa-tasks mr-2"></i>Funções:
            </label>
            @foreach($functions as $key => $function)
                <div class="flex items-center">
                    <input type="checkbox" id="function_{{ $function['name'] }}" wire:model="selectedFunction" value="{{ $function['name'] }}" class="bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <label for="function_{{ $function['name'] }}" class="ml-2 text-sm text-gray-300">{{ $key }}:</label>
                </div>
            @endforeach
            @error('selectedFunction') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>                    
        <div class="mb-4">
            <label for="active" class="block text-sm font-medium text-gray-300">
                <i class="fas fa-toggle-on mr-2"></i>Status:
            </label>
            <select id="active" wire:model="active" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="1">Ativo</option>
                <option value="0">Desativado</option>
            </select>
            @error('active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{isset($assistant)? 'Atualizar Assistente' : 'Criar Assistente'}}
            </button>
        </div>
    </form>
    <style>
        .status-indicator {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
        }
    
        .bg-green-500 {
            background-color: #10B981;
        }
    
        .bg-red-500 {
            background-color: #EF4444;
        }
    
        .relative {
            position: relative;
        }
    
        .absolute {
            position: absolute;
        }
    
        .top-0 {
            top: 0;
        }
    
        .right-0 {
            right: 0;
        }
    
        .mt-2 {
            margin-top: 0.5rem;
        }
    
        .mr-2 {
            margin-right: 0.5rem;
        }
    </style>    
</div>
