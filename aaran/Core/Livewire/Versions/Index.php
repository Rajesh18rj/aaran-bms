<?php

namespace Aaran\Core\Livewire\Versions;

use Aaran\Assets\Trait\CommonTrait;
use Aaran\Core\Models\SoftVersion;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;


class Index extends Component
{
    use CommonTrait;

    #[Validate]
    public string $soft_version = '';
    public $db_version = '';
    public $title = '';
    public $body = '';

    public bool $active_id = true;

    #region[Validation]
    public function rules(): array
    {
        return [
            'soft_version' => 'required|unique:soft_versions,soft_version',
            'db_version' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'soft_version.required' => ':attribute is missing.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'soft_version' => 'version name',
        ];
    }

    #endregion[Validation]

    #region[getSave]
    public function getSave(): void
    {
        $this->validate();

        if ($this->vid == "") {
            SoftVersion::create([
                'soft_version' => Str::ucfirst($this->soft_version),
                'db_version' => $this->db_version,
                'title' => $this->title,
                'body' => $this->body,
            ]);
            $message = "Saved";

        } else {
            $obj = SoftVersion::find($this->vid);
            $obj->soft_version = Str::ucfirst($this->soft_version);
            $obj->db_version = $this->db_version;
            $obj->title = $this->title;
            $obj->body = $this->body;
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
        $this->soft_version = '';
        $this->db_version = '';
        $this->title = '';
        $this->body = '';
        $this->searches = '';
    }
    #endregion[Clear Fields]

    #region[getObj]
    public function getObj($id): void
    {
        if ($id) {
            $obj = SoftVersion::find($id);
            $this->vid = $obj->id;
            $this->soft_version = $obj->soft_version;
            $this->db_version = $obj->db_version;
            $this->title = $obj->title;
            $this->body = $obj->body;
        }
    }
    #endregion

    #region[getList]
    public function getList()
    {
        return SoftVersion::search($this->searches)
//            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = SoftVersion::find($id);
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
        return view('core::Versions.index')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
