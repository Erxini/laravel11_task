<section>
    <div class="overflow-x-auto">
        <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 my-6"
            wire:click="openCreateModal">Nuevo</button>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-purple-600 text-white">
                    <th class="border border-gray-300 px-4 py-2">Título</th>
                    <th class="border border-gray-300 px-4 py-2">Descripción</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr class="bg-purple-50 hover:bg-purple-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $task->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $task->description }}</td>
                    <td class="border border-gray-300 px-4 py-2 flex gap-2 justify-center">
                        <button class="bg-yellow-400 text-black px-4 py-1 rounded hover:bg-yellow-500"
                            wire:click="openCreateModal({{ $task->id }})">Editar</button>
                        <button class=" bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600"
                            wire:click="deleteTask({{ $task->id }})">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- start modal Sergio Rueda-->
    @if($modal)
    <div>
        <div class="fixed inset-0 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-2xl p-6 shadow-lg w-96 text-center">
                <h2 class="text-xl font-semibold mb-2">Crear nueva tarea</h2>
                <form>
                    <div class="mb-4">
                        <label for="title" class="block mb-2 text-gray-600">Título
                            <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="title" type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí el título de la tarea">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block mb-2 text-gray-600">Descripción
                            <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="description" type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí la descripción de la tarea">
                    </div>
                </form>
                <div class="space-y-3">
                    <button class="w-full bg-black text-white py-2 rounded-full font-medium hover:bg-gray-800"
                        wire:click.prevent="createorUpdateTask">
                        {{ $isUpdating ? 'Modificar Tarea' : 'Crear Tarea' }}
                    </button>
                    <button class="w-full border border-gray-300 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-300"
                        wire:click="closeCreateModal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- end modal Sergio Rueda-->
</section>