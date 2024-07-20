<div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full mx-auto">  
    <br>
    <h2 class="text-2xl font-bold mb-6 text-white">{{isset($assistant)? 'Atualizar Assistente:' : 'Criar Assistente:'}}</h2>
    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-300">Nome</label>
            <input type="text" id="name" wire:model="name" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="instruct" class="block text-sm font-medium text-gray-300">Instrução</label>
            <textarea id="instruct" wire:model="instruct" rows="4" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            @error('instruct') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="model" class="block text-sm font-medium text-gray-300">Modelo</label>
            <select id="model" wire:model="model" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Selecione um modelo</option>
                <option value="gpt-4o">Bravo (Mais avançado)</option>
                <option value="gpt-4-1106-preview">Charlie (Moderado)</option>
                <option value="gpt-3.5-turbo-1106">Delta (Econômico)</option>
            </select>
            @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="function" class="block text-sm font-medium text-gray-300">Função</label>
            <select id="function" wire:model="selectedFunction" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select2">
                <option value="">Sem Função</option>
                @foreach($functions as $key => $function)
                    <option @if(isset($selectedFunction) && $selectedFunction == $function['name']) @selected(true) @endif value="{{ $function['name'] }}">{{ $key }}</option>
                @endforeach
            </select>
            @error('selectedFunctions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>        
        <div class="mb-4">
            <label for="active" class="block text-sm font-medium text-gray-300">Status</label>
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
</div>
