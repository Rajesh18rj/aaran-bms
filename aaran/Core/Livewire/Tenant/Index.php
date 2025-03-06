<?php

namespace Aaran\Core\Livewire\Tenant;

use Aaran\Assets\Trait\CommonTrait;
use Aaran\Core\Models\Tenant;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;


class Index extends Component
{
    use CommonTrait;

    #[Validate]
    public string $t_name = '';
    public bool $active_id = true;

    #region[Validation]
    public function rules(): array
    {
        return [
            't_name' => 'required|unique:tenants,t_name',
        ];
    }

    public function messages(): array
    {
        return [
            't_name.required' => ':attribute is missing.',
            't_name.unique' => 'This :attribute is already created.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            't_name' => 'tenant name',
        ];
    }

    #endregion[Validation]

    #region[getSave]
    public function getSave(): void
    {
        $this->validate();

        if ($this->vid == "") {
            Tenant::create([
                't_name' => Str::ucfirst($this->t_name),
                'active_id' => $this->active_id,
            ]);
            $message = "Saved";

        } else {
            $obj = Tenant::find($this->vid);
            $obj->t_name = Str::ucfirst($this->t_name);
            $obj->active_id = $this->active_id;
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
        $this->t_name = '';
        $this->active_id = '1';
        $this->searches = '';
    }
    #endregion[Clear Fields]

    #region[getObj]
    public function getObj($id): void
    {
        if ($id) {
            $obj = Tenant::find($id);
            $this->vid = $obj->id;
            $this->t_name = $obj->t_name;
            $this->active_id = $obj->active_id;
        }
    }
    #endregion

    #region[getList]
    public function getList()
    {
        return Tenant::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = Tenant::find($id);
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
        return view('core::tenant.index')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
