<!-- info Modal -->
<div x-data="{ infoModalIsOpen: false }">
    <button @click="infoModalIsOpen = true" type="button"
            class="w-36 cursor-pointer whitespace-nowrap rounded-md bg-sky-500 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500 active:opacity-100 active:outline-offset-0">
        Info Modal
    </button>
    <div x-cloak x-show="infoModalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="infoModalIsOpen"
         @keydown.esc.window="infoModalIsOpen = false" @click.self="infoModalIsOpen = false"
         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
         role="dialog" aria-modal="true" aria-labelledby="infoModalTitle">
        <!-- Modal Dialog -->
        <div x-show="infoModalIsOpen"
             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
             x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
             class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 px-4 py-2 dark:border-neutral-700 dark:bg-neutral-950/20">
                <div class="flex items-center justify-center rounded-full bg-sky-500/20 text-sky-500 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                <button @click="infoModalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                         fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="px-4 text-center">
                {{$slot}}
            </div>
            <!-- Dialog Footer -->
            <div class="flex items-center justify-center border-neutral-300 p-4 dark:border-neutral-700">
                <button @click="infoModalIsOpen = false" type="button"
                        class="w-full cursor-pointer whitespace-nowrap rounded-md bg-sky-500 px-4 py-2 text-center text-sm font-semibold tracking-wide text-white transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500 active:opacity-100 active:outline-offset-0">
                    Install Updates Now
                </button>
            </div>
        </div>
    </div>
</div>


