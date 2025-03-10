<div x-data="{ showModal: false, userId: null }"
     @openEditModal.window="showModal = true; userId = $event.detail.id">

    <input type="text" wire:model.debounce.300ms="search" placeholder="Search users..." class="border p-2">

    <table class="table-auto w-full border">
        <thead>
        <tr>
            <th class="border p-2">Name</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="border p-2">{{ $user->name }}</td>
                <td class="border p-2">{{ $user->email }}</td>
                <td class="border p-2">
                    <!-- Fix @dispatch with correct syntax -->
                    <button wire:click="editUser({{ $user->id }})"
                            class="bg-blue-500 text-white px-2 py-1">Edit</button>

                    <button wire:click="deleteUser({{ $user->id }})"
                            class="bg-red-500 text-white px-2 py-1">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center"
         x-cloak>
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-lg font-bold">Edit User</h2>
            <p>User ID: <span x-text="userId"></span></p>
            <button @click="showModal = false" class="mt-4 px-4 py-2 bg-gray-600 text-white">Close</button>
        </div>
    </div>
</div>
