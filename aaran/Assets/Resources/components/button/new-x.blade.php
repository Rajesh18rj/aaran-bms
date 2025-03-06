<button class="tab-button px-6 py-[7px]   relative rounded group overflow-hidden font-medium bg-green-600 inline-block text-center" {{$attributes}}  wire:navigate>
    <span class="absolute top-0 left-0 flex h-full w-0 mr-0 transition-all
                    duration-500 ease-out transform translate-x-0 group-hover:w-full opacity-90
                    bg-green-500 "></span>
    <span class="relative group-hover:hidden text-white sm:text-lg text-sm">
        New
    </span>
    <span class="relative hidden group-hover:block group-hover:text-white sm:px-[7px] px-[3px] sm:py-[2px] py-[0]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
        </svg>
    </span>
</button>
