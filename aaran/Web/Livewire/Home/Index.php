<?php

namespace Aaran\Web\Livewire\Home;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{

    public $slides = [
        ["image" => "/images/slide1.jpg", "title" => "Welcome to Aaran-BMS", "description" => "Manage your business efficiently."],
        ["image" => "/images/slide2.jpg", "title" => "Powerful Features", "description" => "Everything you need in one place."],
        ["image" => "/images/slide3.jpg", "title" => "Seamless Integration", "description" => "Works smoothly with your workflow."]
    ];

    #[Layout('components.layouts.web')]
    public function render()
    {
        return view('web::Home.index');
    }
}
