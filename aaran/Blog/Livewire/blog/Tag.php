<?php

namespace Aaran\Blog\Livewire\blog;

use Aaran\Blog\Models\BlogTag;
use Aaran\Common\Models\Common;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Livewire\Component;

class Tag extends Component
{
    use CommonTraitNew;

    #region[Get-Save]

    public function getSave()
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $blogTag = new BlogTag();
                $extraFields = [
                    'blogcategory_id' => $this->blogcategory_id,
                ];
                $this->common->save($blogTag, $extraFields);
                $message = "Saved";
            } else {
                $blogTag = BlogTag::find($this->common->vid);
                $extraFields = [
                    'blogcategory_id' => $this->blogcategory_id,
                ];
                $this->common->edit($blogTag, $extraFields);
                $message = "Updated";
            }
        }
    }
    #endregion

    #region[blogCategory]
    public $blogcategory_id = '';
    public $blogcategory_name = '';
    public Collection $blogcategoryCollection;
    public $highlightBlogCategory = 0;
    public $blogcategoryTyped = false;

    public function decrementBlogcategory(): void
    {
        if ($this->highlightBlogCategory === 0) {
            $this->highlightBlogCategory = count($this->blogcategoryCollection) - 1;
            return;
        }
        $this->highlightBlogCategory--;
    }

    public function incrementBlogcategory(): void
    {
        if ($this->highlightBlogCategory === count($this->blogcategoryCollection) - 1) {
            $this->highlightBlogCategory = 0;
            return;
        }
        $this->highlightBlogCategory++;
    }

    public function setBlogcategory($name, $id): void
    {
        $this->blogcategory_name = $name;
        $this->blogcategory_id = $id;
        $this->getBlogcategoryList();
    }

    public function enterBlogcategory(): void
    {
        $obj = $this->blogcategoryCollection[$this->highlightBlogCategory] ?? null;

        $this->blogcategory_name = '';
        $this->blogcategoryCollection = Collection::empty();
        $this->highlightBlogCategory = 0;

        $this->blogcategory_name = $obj['vname'] ?? '';
        $this->blogcategory_id = $obj['id'] ?? '';
    }

    public function refreshBlogcategory($v): void
    {
        $this->blogcategory_id = $v['id'];
        $this->blogcategory_name = $v['name'];
        $this->blogcategoryTyped = false;
    }

    public function blogcategorySave($name)
    {
        $obj = Common::create([
            'label_id' => 18,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshBlogcategory($v);
    }

    public function getBlogcategoryList(): void
    {
        $this->blogcategoryCollection = $this->blogcategory_name ?
            Common::search(trim($this->blogcategory_name))->where('label_id', '=', '18')->get() :
            Common::where('label_id', '=', '18')->get();
    }

    #endregion

    public function getObj($id)
    {
        if ($id) {
            $BlogTag = Tag::find($id);
            $this->common->vid = $BlogTag->id;
            $this->common->vname = $BlogTag->vname;
            $this->common->active_id = $BlogTag->active_id;
            $this->blogcategory_id = $BlogTag->blogcategory_id;
            $this->blogcategory_name = $BlogTag->blogcategory_id ? Common::find($BlogTag->blogcategory_id)->vname : '';
            return $BlogTag;
        }
        return null;
    }

    public function clearFields()
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->blogcategory_id = '';
        $this->blogcategory_name = '';
    }

    #region[Render]
    public function render()
    {
        $this->getBlogcategoryList();

        return view('livewire.blog.blog-tag.index')->with([
            'list' => $this->getListForm->getList(BlogTag::class, function ($query) {
                return $query->where('id', '>', '');
            })
        ]);
    }
    #endregion
}
