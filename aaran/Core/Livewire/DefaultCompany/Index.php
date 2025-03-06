<?php

namespace Aaran\Core\Livewire\DefaultCompany;

use Aaran\Assets\Trait\CommonTrait;
use Aaran\Core\Models\DefaultCompany;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;


class Index extends Component
{
    use CommonTrait;

    #[Validate]
    public string $company_id = '';
    public $tenant_id;
    public $acyear;

    #region[Validation]
    public function rules(): array
    {
        return [
            'company_id' => 'required|',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => ':attribute is missing.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'company_id' => 'company id',
        ];
    }

    #endregion[Validation]

    #region[getSave]
    public function getSave(): void
    {
        $this->validate();

        if ($this->vid == "") {
            DefaultCompany::create([
                'company_id' => Str::ucfirst($this->company_id),
                'tenant_id' => $this->tenant_id,
                'acyear' => $this->acyear,
            ]);
            $message = "Saved";

        } else {
            $obj = DefaultCompany::find($this->vid);
            $obj->compan_id = Str::ucfirst($this->company_id);
            $obj->tenant_id = $this->tenant_id;
            $obj->acyear = $this->acyear;
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
        $this->company_id = '';
        $this->tenant_id = '1';
        $this->acyear = '';
        $this->searches = '';
    }
    #endregion[Clear Fields]

    #region[getObj]
    public function getObj($id): void
    {
        if ($id) {
            $obj = DefaultCompany::find($id);
            $this->vid = $obj->id;
            $this->company_id = $obj->company_id;
            $this->tenant_id = $obj->tenant_id;
            $this->acyear = $obj->acyear;
        }
    }
    #endregion

    #region[getList]
    public function getList()
    {
        return DefaultCompany::search($this->searches)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = DefaultCompany::find($id);
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
        return view('core::DefaultCompany.index')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
