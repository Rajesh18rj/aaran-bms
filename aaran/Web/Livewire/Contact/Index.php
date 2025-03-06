<?php

namespace Aaran\Web\Livewire\Contact;

use Aaran\Assets\Trait\CommonTrait;
use Aaran\Web\Models\ContactMessage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;


class Index extends Component
{

    use CommonTrait;

    #[Validate]
    public string $vname = '';
    public string $email = '';

    #[Validate]
    public string $phone = '';
    public string $message = '';
    public bool $active_id = true;

    #region[Validation]
    public function rules(): array
    {
        return [
            'vname' => 'required|unique:contact_messages,vname',
            'phone' => 'required|unique:contact_messages,vname',
        ];
    }

    public function messages(): array
    {
        return [
            'vname.required' => ':attribute is missing.',
            'vname.unique' => 'This :attribute is already created.',

            'phone.required' => ':attribute is missing.',
            'phone.unique' => 'This :attribute is already created.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'vname' => 'Name',
            'phone' => 'Phone No',
        ];
    }

    #endregion[Validation]

    #region[getSave]
    public function getSave(): void
    {
        $this->validate();

        if ($this->vid == "") {
            ContactMessage::create([
                'vname' => Str::ucfirst($this->vname),
                'email' => $this->email,
                'phone' => $this->phone,
                'message' => $this->message,
                'active_id' => $this->active_id,
            ]);
            $message = "Saved";

        } else {
            $obj = ContactMessage::find($this->vid);
            $obj->vname = Str::ucfirst($this->vname);
            $obj->email = $this->email;
            $obj->phone = $this->phone;
            $obj->message = $this->message;
            $obj->active_id = $this->active_id;
            $obj->save();
            $message = "Updated";
        }

        $this->clearFields();

        session()->flash('success', $message);

        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->vid = '';
        $this->vname = '';
        $this->email = '';
        $this->phone = '';
        $this->message = '';
        $this->active_id = '1';
        $this->searches = '';
    }
    #endregion[Clear Fields]

    #region[getObj]
    public function getObj($id): void
    {
        if ($id) {
            $obj = ContactMessage::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->email = $obj->email;
            $this->phone = $obj->phone;
            $this->message = $obj->message;
            $this->active_id = $obj->active_id;
        }
    }
    #endregion

    #region[getList]
    public function getList()
    {
        return ContactMessage::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = ContactMessage::find($id);
            if ($obj) {
                $obj->delete();
                $message = "Deleted Successfully";
                $this->dispatch('notify', ...['type' => 'success', 'content' => $message]);
            }
        }
    }
    #endregion
    #region[render]
    #[Layout('layouts.web')]
    public function render()
    {
        return view('web::Contact.index')->with([
            'list' => $this->getList()
        ]);
    }

    #endregion
}
