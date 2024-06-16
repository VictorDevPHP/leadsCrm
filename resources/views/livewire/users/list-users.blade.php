<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-x-auto">
            <div class="w-full lg:w-full mx-auto">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden my-6">
                    <table class="w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Nome</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @foreach ($users as $user)
                                <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                    <td class="py-4 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ $user->email }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center space-x-4">
                                            <button class="text-blue-500 hover:text-blue-700 focus:outline-none transform hover:scale-105 transition duration-300 ease-in-out">Editar</button>
                                            <button class="text-red-500 hover:text-red-700 focus:outline-none transform hover:scale-105 transition duration-300 ease-in-out">Excluir</button>
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
