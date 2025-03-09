<?php

namespace Aaran\Auth\User\Livewire\Users;

use Aaran\Assets\Trait\CommonTrait;
use Aaran\Auth\User\Models\User;
use Aaran\Auth\User\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;


class Index extends Component
{
    use CommonTrait;

    #[Validate]
    public string $name = '';
    public string $email = '';
    public $password = '';
    public $profile_photo_path = '';
    public $tenant_id = '';
    public bool $active_id = true;


    protected $service;

    public function boot(UserService $service): void
    {
        $this->service = $service;
    }


    #region[Validation]
    public function rules(): array
    {
        return [
            'name' => 'required|unique:users,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute is missing.',
            'name.unique' => 'This :attribute is already created.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'user name',
        ];
    }

    #endregion[Validation]

    #region[getSave]
    public function getSave(): void
    {
        $this->validate();

        $this->service->save([
            'name' => Str::ucfirst($this->name),
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'profile_photo_path' => $this->profile_photo_path,
            'tenant_id' => $this->tenant_id,
            'active_id' => $this->active_id,
        ]);

        $this->resetForm();

//        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }

    public function edit($id): void
    {
        $obj = $this->service->getById($id)->where('id', $id)->first();
        $this->vid = $id;
        $this->name = $obj->name;
        $this->email = $obj->email;
        $this->password = $obj->password;
        $this->profile_photo_path = $obj->profile_photo_path;
        $this->tenant_id = $obj->tenant_id;
        $this->active_id = $obj->active_id;
    }

    public function getUpdate(): void
    {
       $this->validate();

        $this->service->update($this->vid, [
            'name' => Str::ucfirst($this->name),
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'profile_photo_path' => $this->profile_photo_path,
            'tenant_id' => $this->tenant_id,
            'active_id' => $this->active_id,
        ]);

        $this->resetForm();
    }

    public function getDelete($id): void
    {
        $this->service->getById($id)->where('id', $id)->delete();
    }

    #endregion

    #region[reset]

    private function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'profile_photo_path', 'tenant_id', 'role_id']);
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('core::Users.index')->with([
            'list' => $this->service->getList(),
        ]);
    }
    #endregion

}
