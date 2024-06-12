<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Nome</th>
                                    <th class="py-3 px-6 text-left">Email</th>
                                    <th class="py-3 px-6 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($users as $user)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <span>{{ $user->email }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <button class="focus:outline-none">Editar</button>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <button class="focus:outline-none">Excluir</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
