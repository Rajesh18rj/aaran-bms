<div class="bg-gray-200">
    <div x-data="{ open: false }" class="flex h-screen">
        <!-- Sidebar -->
        <div
            :class="{'translate-x-0': open, '-translate-x-full': !open}"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-20 flex-shrink-0 w-64 bg-white border-r md:relative md:translate-x-0"
        >
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between flex-shrink-0 px-4 bg-gray-800 text-white">
                    <a href="#" class="text-lg font-semibold tracking-widest uppercase">Dashboard</a>
                    <button @click="open = !open" class="p-1 -mr-1 focus:outline-none focus:shadow-outline md:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <nav class="flex-1 px-4 py-4 space-y-1 bg-white">
                    <a href="#"
                       class="flex items-center px-2 py-2 text-sm font-medium leading-5 rounded-md hover:bg-gray-200">
                        Overview
                    </a>
                    <div x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center w-full px-2 py-2 text-sm font-medium leading-5 rounded-md hover:bg-gray-200 focus:outline-none">
                            <span>Settings</span>
                            <svg :class="{ 'rotate-180': dropdownOpen }"
                                 class="w-5 h-5 ml-auto transition-transform duration-150" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="px-2 py-2 mt-2 space-y-2 rounded-md shadow-md bg-gray-100">
                            <a href="#"
                               class="block px-3 py-1 text-sm font-medium leading-5 rounded-md hover:bg-gray-200">Profile
                                Settings</a>
                            <a href="#"
                               class="block px-3 py-1 text-sm font-medium leading-5 rounded-md hover:bg-gray-200">Account
                                Settings</a>
                        </div>
                    </div>
                    <a href="#"
                       class="flex items-center px-2 py-2 text-sm font-medium leading-5 rounded-md hover:bg-gray-200">Logout</a>
                </nav>
            </div>
        </div>

        <!-- Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between px-4 py-4 bg-white border-b">
                <div class="flex items-center">
                    <button @click="open = !open"
                            class="p-1 -ml-1 mr-3 focus:outline-none focus:shadow-outline md:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <h1 class="text-2xl font-semibold">Dashboard Content</h1>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <!-- Your main content goes here -->
                    <h2 class="text-xl font-semibold">Welcome to the Dashboard!</h2>
                    <p class="mt-4">This is a simple responsive sidebar example using Tailwind CSS and Alpine.js.</p>
                </div>
            </main>
        </div>
    </div>
</div>
