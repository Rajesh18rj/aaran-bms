<?php

namespace Aaran\Blog\Livewire\blog;

use Aaran\Blog\Models\BlogPost;
use Livewire\Component;

class BlogShow extends Component
{
    public $blog;

    public function mount($id)
    {
          $this->blog = BlogPost::find($id);
    }

    public function render()
    {
        return view('livewire.blog.blogshow')->layout('layouts.web');
    }
}
