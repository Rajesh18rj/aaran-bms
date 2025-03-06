<?php

namespace Aaran\Core\Livewire\Users;

use Aaran\Assets\Trait\CommonTrait;
use Aaran\Core\Models\User;
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
    public $role_id ='';

    public bool $active_id = true;

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

        if ($this->vid == "") {
            User::create([
                'name' => Str::ucfirst($this->name),
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'profile_photo_path' => $this->profile_photo_path,
                'tenant_id' => $this->tenant_id,
                'role_id' => $this->role_id,
            ]);
            $message = "Saved";

        } else {
            $obj = User::find($this->vid);
            $obj->name = Str::ucfirst($this->name);
            $obj->email = $this->email;
            $obj->password = Hash::make($this->password);
            $obj->profile_photo_path = $this->profile_photo_path;
            $obj->tenant_id = $this->tenant_id;
            $obj->role_id = $this->role_id;
            $obj->save();
            $message = "Updated";
        }

        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->vid = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->profile_photo_path = '';
        $this->tenant_id = '';
        $this->role_id ='';
        $this->searches = '';
    }
    #endregion[Clear Fields]

    #region[getObj]
    public function getObj($id): void
    {
        if ($id) {
            $obj = User::find($id);
            $this->vid = $obj->id;
            $this->name = $obj->name;
            $this->email = $obj->email;
            $this->password = $obj->password;
            $this->profile_photo_path = $obj->profile_photo_path;
            $this->tenant_id = $obj->tenant_id;
            $this->role_id = $obj->role_id;
        }
    }
    #endregion

    #region[getList]
    public function getList()
    {
        return User::search($this->searches)
//            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = User::find($id);
            if ($obj) {
                $obj->delete();
                $message = "Deleted Successfully";
                $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
            }
        }
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('core::Users.index')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
