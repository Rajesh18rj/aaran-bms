<?php

namespace Aaran\Web\Livewire\Service;

use Livewire\Attributes\Layout;
use Livewire\Component;


class Index extends Component
{

    #region[getList]
    private function getList()
    {
        return 'web';
    }
    #endregion

    #region[render]
    #[Layout('layouts.web')]
    public function render()
    {
        return view('web::Home.index')->with([
            'list' => $this->getList()
        ]);
    }

    #endregion
}
