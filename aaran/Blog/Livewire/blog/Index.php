<?php

namespace Aaran\Blog\Livewire\blog;

use Aaran\Blog\Models\BlogTag;
use Aaran\Blog\Models\BlogPost;
use Aaran\Common\Models\Common;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use CommonTraitNew;
    use WithFileUploads;

    #region[properties]
    public string $body;
    public $users;
    public $image;
    public $old_image;
    public $BlogCategories;
    public $category_id;
    public $tags;
    public $tagfilter = [];
    public $visibility = false;
    #endregion

    public function mount()
    {
        $this->BlogCategories = Common::where('label_id','=','18')->get();
    }
    #region[Get-Save]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $Post = new Post();
                $extraFields = [
                    'body' => $this->body,
                    'blogcategory_id' => $this->blogcategory_id,
                    'blogtag_id' => $this->blogtag_id,
                    'image' => $this->saveImage(),
                    'user_id' => auth()->id(),
                    'visibility' => $this->visibility,

                ];
                $this->common->save($Post, $extraFields);
                $message = "Saved";
            } else {
                $Post = BlogPost::find($this->common->vid);
                $extraFields = [
                    'body' => $this->body,
                    'blogcategory_id' => $this->blogcategory_id,
                    'blogtag_id' => $this->blogtag_id,
                    'image' => $this->saveImage(),
                    'user_id' => auth()->id(),
                    'visibility' => $this->visibility,
                ];
                $this->common->edit($Post, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[Get-Obj]
    public function getObj($id)
    {
        if ($id) {
            $Post = BlogPost::find($id);
            $this->common->vid = $Post->id;
            $this->common->vname = $Post->vname;
            $this->body = $Post->body;
            $this->blogcategory_id = $Post->blogcategory_id;
            $this->blogcategory_name = $Post->blogcategory_id?Common::find($Post->blogcategory_id)->vname:'';
            $this->blogtag_id = $Post->blogtag_id;
            $this->blogtag_name = $Post->blogtag_id?Common::find($Post->blogtag_id)->vname:'';
            $this->common->active_id = $Post->active_id;
            $this->old_image = $Post->image;
            $this->visibility = $Post->visibility;
            return $Post;
        }
        return null;
    }
    #endregion

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->body = '';
        $this->blogcategory_id = '';
        $this->blogcategory_name = '';
        $this->blogtag_id = '';
        $this->blogtag_name = '';
        $this->old_image = '';
        $this->image = '';
        $this->visibility = false;
    }
    #endregion

    #region[Image]
    public function saveImage()
    {
        if ($this->image) {

            $image = $this->image;
            $filename = $this->image->getClientOriginalName();

            if (Storage::disk('public')->exists(Storage::path('public/images/' . $this->old_image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' . $this->old_image));
            }

            $image->storeAs('public/images', $filename);

            return $filename;

        } else {
            if ($this->old_image) {
                return $this->old_image;
            } else {
                return 'no image';
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
        if ($this->highlightBlogcategory === 0) {
            $this->highlightBlogcategory = count($this->blogcategoryCollection) - 1;
            return;
        }
        $this->highlightBlogcategory--;
    }

    public function incrementBlogcategory(): void
    {
        if ($this->highlightBlogcategory === count($this->blogcategoryCollection) - 1) {
            $this->highlightBlogcategory = 0;
            return;
        }
        $this->highlightBlogcategory++;
    }

    public function setBlogcategory($name, $id): void
    {
        $this->blogcategory_name = $name;
        $this->blogcategory_id = $id;
        $this->getBlogcategoryList();
    }

    public function enterBlogcategory(): void
    {
        $obj = $this->blogcategoryCollection[$this->highlightBlogcategory] ?? null;

        $this->blogcategory_name = '';
        $this->blogcategoryCollection = Collection::empty();
        $this->highlightBlogcategory = 0;

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

    #region[blogTag]
    public $blogtag_id = '';
    public $blogtag_name = '';
    public Collection $blogtagCollection;
    public $highlightBlogtag = 0;
    public $blogtagTyped = false;

    public function decrementBlogtag(): void
    {
        if ($this->highlightBlogtag === 0) {
            $this->highlightBlogtag = count($this->blogtagCollection) - 1;
            return;
        }
        $this->highlightBlogtag--;
    }

    public function incrementBlogtag(): void
    {
        if ($this->highlightBlogtag === count($this->blogtagCollection) - 1) {
            $this->highlightBlogtag = 0;
            return;
        }
        $this->highlightBlogtag++;
    }

    public function setBlogTag($name, $id): void
    {
        $this->blogtag_name = $name;
        $this->blogtag_id = $id;
        $this->getBlogtagList();
    }

    public function enterBlogtag(): void
    {
        $obj = $this->blogtagCollection[$this->highlightBlogtag] ?? null;

        $this->blogtag_name = '';
        $this->blogtagCollection = Collection::empty();
        $this->highlightBlogtag = 0;

        $this->blogtag_name = $obj['vname'] ?? '';
        $this->blogtag_id = $obj['id'] ?? '';
    }

    public function refreshBlogtag($v): void
    {
        $this->blogtag_id = $v['id'];
        $this->blogtag_name = $v['name'];
        $this->blogtagTyped = false;
    }

    public function blogtagSave($name)
    {
        $obj = BlogTag::create([
            'blogcategory_id' => $this->blogcategory_id,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshBlogTag($v);
    }

    public function getBlogTagList(): void
    {
        $this->blogtagCollection = $this->blogtag_name ?
            BlogTag::search(trim($this->blogtag_name))->where('blogcategory_id', '=', $this->blogcategory_id)->get() :
            BlogTag::where('blogcategory_id', '=', $this->blogcategory_id)->get();
    }

    #endregion

    public function getCategory_id($id)
    {
        $this->category_id = $id;
        $this->gettags();
    }

    public function gettags()
    {
        $this->tags = BlogTag::where('blogcategory_id', '=', $this->category_id)->get();
    }

    public function getFilter($id)
    {
        if (!in_array($id,$this->tagfilter,true)) {
            return array_push($this->tagfilter, $id);
        }
    }

    public function clearFilter()
    {
        $this->tagfilter=[];
    }

    public function removeFilter($id)
    {
        unset($this->tagfilter[$id]);
    }


    #region[Render]
    public function getRoute()
    {
        return route('posts');
    }
    public function render()
    {
        $this->getBlogcategoryList();
        $this->getBlogtagList();

        return view('livewire.blog.index')->with([
            'list' => $this ->getListForm ->getList(BlogPost::class,function ($query){
                return $query->latest()->when($this->tagfilter,function ($query,$tagfilter){
                    return $query->whereIn('blogtag_id',$tagfilter);
                });
            }),
            'firstPost'=>BlogPost::latest()->take(1)->when($this->tagfilter,function ($query,$tagfilter){
                return $query->whereIn('blogtag_id',$tagfilter);
            })->get(),
        ]);
    }
    #endregion
}
