<div>
    <h1>{{ $userId ? 'Edit User' : 'Create New User' }}</h1>

    @if(session()->has('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <label for="name">Name:</label>
        <input type="text" id="name" wire:model="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" wire:model="email" required>

        @if(!$userId)
            <label for="password">Password:</label>
            <input type="password" id="password" wire:model="password" required>

            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" required>
        @endif

        <label for="role_id">Role:</label>
        <select id="role_id" wire:model="role_id" required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <button type="submit">{{ $userId ? 'Update' : 'Create' }}</button>
    </form>
</div>
