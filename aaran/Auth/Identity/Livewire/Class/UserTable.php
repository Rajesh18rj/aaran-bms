<?php

namespace Aaran\Auth\Identity\Livewire\Class;

use Aaran\Auth\Identity\Exceptions\ApiException;
use Aaran\Auth\Identity\Models\User;
use Aaran\Auth\Identity\Services\UserService;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    #[Reactive] // Ensures the search property updates the component
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'User deleted successfully.');
        $this->dispatch('userUpdated');
    }

    #[On('userUpdated')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    public bool $showModal = false;

    public function editUser($id)
    {
        $this->showModal = true;

        try {
            $obj = UserService::class->getUserById($id);



        } catch (ApiException $e) {
            throw $e;
        }
    }

    public function render()
    {
        return view('identity::user-table', [
            'users' => User::where('name', 'like', "%{$this->search}%")->paginate(10),
        ]);
    }
}
