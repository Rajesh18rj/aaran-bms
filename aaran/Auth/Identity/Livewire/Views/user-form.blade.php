<div>
    <form wire:submit.prevent="saveUser">
        <input type="text" wire:model="name" placeholder="Name" class="border p-2 w-full mb-3">
        <input type="email" wire:model="email" placeholder="Email" class="border p-2 w-full mb-3">
        <input type="password" wire:model="password" placeholder="Password (optional)" class="border p-2 w-full mb-3">

        <button type="submit" class="bg-green-500 text-white px-4 py-2">Save User</button>
    </form>
</div>
