<?php

namespace Aaran\Master\Livewire\Style;

use Aaran\Assets\Trait\CommonTraitNew;
use Aaran\Master\Models\Style;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use CommonTraitNew;
    use WithFileUploads;

    #region[properties]
    public $desc;
    public $image;
    public $old_image;
    public $log;
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $style = new Style();
                $extraFields = [
                    'desc' => $this->desc,
                    'company_id' => session()->get('company_id', 1),
                    'image' => $this->save_image(),
                ];
                $this->common->save($style, $extraFields);
//                $this->common->logEntry('Style','Style','create',$this->common->vname.' has been created');
                $message = "Saved";
            } else {
                $style = Style::find($this->common->vid);
                $extraFields = [
                    'desc' => $this->desc,
                    'company_id' => session()->get('company_id', 1),
                    'image' => $this->save_image(),
                ];
                $this->common->edit($style, $extraFields);
//                $this->common->logEntry('Style','Style','update',$this->common->vname.' has been updated');
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message.' Successfully']);
        }
    }
    #endregion

    #region[image]
    public function save_image()
    {
        if ($this->image) {
            $filename = time().'_'.$this->image->getClientOriginalName();

            // Delete old image if exists
            if ($this->old_image && Storage::disk('public')->exists('images/' . $this->old_image)) {
                Storage::disk('public')->delete('images/' . $this->old_image);
            }

            // Store the image in 'storage/app/public/images'
            $this->image->storeAs('images', $filename, 'public');

            return $filename;
        }

        return $this->old_image ?? 'no_image.png'; // Return old image or a default one
    }

    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $style = Style::find($id);
            $this->common->vid = $style->id;
            $this->common->vname = $style->vname;
            $this->common->active_id = $style->active_id;
            $this->desc = $style->desc;
            $this->old_image = $style->image;
            return $style;
        }
        return null;
    }
    #endregion

    #region[clearFields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->desc = '';
        $this->image='';
        $this->old_image='';
    }
    #endregion

    #region[getRoute]
    public function getRoute()
    {
        return route('styles');
    }
    #endregion

    #region[Delete]
    public function deleteFunction($id): void
    {
        if ($id) {
            $obj = Style::find($id);
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
//        $this->log = Logbook::where('model_name','Style')->take(5)->get();
        $list = Style::all();

        return view('master::Style.index')->with([
            'list' => $list
        ]);
    }
    #endregion
}
