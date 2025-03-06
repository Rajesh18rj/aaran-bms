<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" id="navBar"
     class="sm:fixed sm:z-40 sm:w-full flex items-center justify-between border-b border-neutral-300 sm:px-32 tracking-wider
     px-6 py-4 dark:border-neutral-700 text-white"
     aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#" class="text-3xl gap-4 inline-flex items-center">
        <span> <x-aaran-ui::logo.cxlogo icon="dark" class="w-auto h-10 block"/></span>
        <span
            class="hover:scale-110 hover:tracking-wide hover:font-bold hover:text-black hover:underline duration-300 transition-all ease-out">
                {{ config('aaran-app.brand') }}
        </span>
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-16 md:flex">
        <li class="hover:tracking-wide hover:font-bold hover:text-black hover:underline duration-300 transition-all ease-out">
            <a href="{{route('home')}}"
               class=" underline-offset-2  focus:outline-none focus:underline dark:text-white dark:hover:text-white "
               aria-current="page" wire:navigate>Home</a></li>
        <li class="hover:tracking-wide hover:font-bold hover:text-black hover:underline duration-300 transition-all ease-out">
            <a href="{{route('abouts')}}"
               class="  underline-offset-2 focus:outline-none focus:underline dark:text-neutral-300 dark:hover:text-white"
               wire:navigate>About</a>
        </li>
        <li class="hover:tracking-wider hover:font-bold hover:text-black hover:underline duration-300 transition-all ease-out">
            <a href="{{route('blogs')}}"
               class=" underline-offset-2  focus:outline-none focus:underline dark:text-neutral-300 dark:hover:text-white"
               wire:navigate>Blog</a>
        </li>
        <li class="hover:tracking-wider hover:font-bold hover:text-black hover:underline duration-300 transition-all ease-out">
            <a href="{{route('services')}}"
               class=" underline-offset-2  focus:outline-none focus:underline dark:text-neutral-300 dark:hover:text-white"
               wire:navigate>Services</a>
        </li>
        <li class="hover:tracking-wider hover:font-bold hover:text-black hover:underline duration-300 transition-all ease-out">
            <a href="{{route('web-contacts')}}"
               class=" underline-offset-2  focus:outline-none focus:underline dark:text-neutral-300 dark:hover:text-white"
               wire:navigate>Contact</a>
        </li>
        @if (Route::has('login'))
            @auth
                <li class="hover:tracking-wider hover:font-bold hover:text-cyan-300 hover:underline duration-300 transition-all ease-out">
                    <a href="{{route('dashboard')}}"
                       class="underline-offset-2  focus:outline-none focus:underline dark:text-neutral-300 dark:hover:text-white"
                       wire:navigate>Dashboard</a>
                </li>
                <li class="hover:tracking-wider hover:font-bold hover:text-red-300 drop-shadow-lg hover:underline duration-300 transition-all ease-out">
                    <a href="{{route('logout')}}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class=" underline-offset-2  focus:outline-none focus:underline dark:text-neutral-300 dark:hover:text-white"
                       wire:navigate>Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            @else
                <li class="hover:tracking-wider hover:font-bold hover:text-cyan-300 hover:underline duration-300 transition-all ease-out">
                    <a href="{{route('login')}}"
                       class="font-semibold underline-offset-2  focus:outline-none focus:underline dark:text-neutral-300 dark:hover:text-white"
                       wire:navigate>Login</a>
                </li>
            @endauth
        @endif
    </ul>
    <!-- Mobile Menu Button -->
    <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen"
            :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-50' : null" type="button"
            class="flex text-neutral-600 dark:text-neutral-300 md:hidden" aria-label="mobile menu"
            aria-controls="mobileMenu">
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
        </svg>
    </button>
    <!-- Mobile Menu -->
    <ul x-cloak x-show="mobileMenuIsOpen"
        x-transition:enter="transition motion-reduce:transition-none ease-out duration-300"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition motion-reduce:transition-none ease-out duration-300"
        x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" id="mobileMenu"
        class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-20 flex flex-col divide-y divide-neutral-300 rounded-b-md border-b border-neutral-300
        bg-neutral-50 px-6 pb-6 pt-20 dark:divide-neutral-700 dark:border-neutral-700 dark:bg-neutral-900 md:hidden">

        <li class="py-2"><a href="{{route('home')}}"
                            class="w-full text-sm font-bold text-neutral-600 focus:underline dark:text-neutral-300 "
                            wire:navigate
            >Home</a></li>
        <li class="py-2"><a href="{{route('abouts')}}"
                            class="w-full text-sm font-medium text-neutral-600 focus:underline dark:text-neutral-300"
                            wire:navigate>About</a>
        </li>
        <li class="py-2"><a href="{{route('blogs')}}"
                            class="w-full text-sm font-medium text-neutral-600 focus:underline dark:text-neutral-300"
                            wire:navigate>Blog</a>
        </li>
        <li class="py-2"><a href="{{route('services')}}"
                            class="w-full text-sm font-medium text-neutral-600 focus:underline dark:text-neutral-300"
                            wire:navigate>Services</a>
        </li>
        <li class="py-2"><a href="{{route('web-contacts')}}"
                            class="w-full text-sm font-medium text-neutral-600 focus:underline dark:text-neutral-300"
                            wire:navigate>Contact</a>
        </li>
        @if (Route::has('login'))
            @auth
                <li class="py-2"><a href="{{route('dashboard')}}"
                                    class="w-full text-sm font-medium text-neutral-600 focus:underline dark:text-neutral-300"
                                    wire:navigate>Dashboard</a>
                </li>
                <li class="py-2"><a href="{{route('logout')}}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="w-full text-sm font-medium text-neutral-600 focus:underline dark:text-neutral-300"
                                    wire:navigate>Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            @else
                <li class="py-2"><a href="{{route('login')}}"
                                    class="w-full text-sm font-medium text-neutral-600 focus:underline dark:text-neutral-300"
                                    wire:navigate>Login</a>
                </li>
            @endauth
        @endif
    </ul>
</nav>

<style>
    .pa-fixed-header {
        background-color: #ffffff !important;
        -webkit-transition: background-color 1s ease-out;
        -moz-transition: background-color 1s ease-out;
        -o-transition: background-color 1s ease-out;
        transition: background-color 1s ease-out;
    }

    .text-black {
        /*color: #157293 !important;*/
        /*color: #3F5AF3 !important;*/
        color: black !important;
    }
</style>

<script>

    // Toggle the .pa-fixed-header class when the user
    // scroll 100px

    window.onscroll = () => {
        scrollNavbar()
    };

    scrollNavbar = () => {
        // Target elements
        const navBar = document.getElementById("navBar");
        const links = document.querySelectorAll("#navBar a");

        if (document.documentElement.scrollTop > 100) {
            navBar.classList.add("pa-fixed-header");

            // Change the color of links on scroll
            for (let i = 0; i < links.length; i++) {
                const element = links[i];
                element.classList.add('text-black');
            }

        } else {
            navBar.classList.remove("pa-fixed-header");

            // Change the color of links back to default
            for (let i = 0; i < links.length; i++) {
                const element = links[i];
                element.classList.remove('text-black');
            }
        }
    }

</script>
