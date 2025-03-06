<?php

namespace Aaran\Docs\Livewire\Docs;

use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;


class Index extends Component
{

    public function getDocs(){

        $md = (__DIR__ . '/../../Markdown/overview.md');

        return Str::markdown(file_get_contents($md));
    }

    #region[render]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('docs::Docs.index')->with([
            'policy' => $this->getDocs()
        ]);
    }
    #endregion
}
