@props([
    'showModel' =>false,
    'width' => 'w-1/3',
    'height'=> 'h-80',
    'label'=> null
])
<div>
    <li class="px-4 py-2 text-gray-500 text-sm tracking-wider">No Results Found ...</li>
    <button wire:click="$set('showModel',true); "
       class="w-full inline-flex items-center gap-x-3 px-4 py-2  text-blue-600 border-t border-b border-gray-300px-2 hover:bg-blue-100">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
        </svg>
        <span>New {{$label}}</span>
    </button>

    @if($showModel)
        <div x-data x-init="$refs.vname.focus()">

            <div wire:click="clearAll"
                 class="fixed inset-0 bg-gray-900  bg-opacity-90 cursor-pointer"></div>

            <div
                    class=" bg-white shadow-md m-auto rounded-md fixed inset-0 inline-block overflow-y-auto {{$width}} {{$height}}">

                <div class="flex flex-col h-full justify-between">

                    <header class="p-2">
                        <h3 class="font-bold text-lg border-b border-gray-400 text-gray-500 py-2">&nbsp;&nbsp;&nbsp;&nbsp;Create&nbsp;new</h3>
                    </header>

                    <main class="px-5 mb-2 space-y-4">
                        {{$slot}}
                    </main>

                    <footer class="flex justify-end px-2 py-4 mt-3 bg-gray-200 rounded-b-md gap-3">

                        <x-aaran-ui::button.back-x wire:click.prevent="clearAll" />

                        <x-aaran-ui::button.save-x wire:click.prevent="save" />
                    </footer>
                </div>
            </div>
        </div>
    @endif
</div>

{{--@props(['id', 'height', 'maxWidth' ])--}}

{{--@php--}}
{{--    $id = $id ?? md5($attributes->wire('model'));--}}

{{--    $maxWidth = [--}}
{{--        'sm' => 'sm:max-w-sm',--}}
{{--        'md' => 'sm:max-w-md',--}}
{{--        'lg' => 'sm:max-w-lg',--}}
{{--        'xl' => 'sm:max-w-xl',--}}
{{--        '2xl' => 'sm:max-w-2xl',--}}
{{--        '4xl' => 'sm:max-w-4xl',--}}
{{--        '6xl' => 'sm:max-w-6xl',--}}
{{--    ][$maxWidth ?? '2xl'];--}}
{{--@endphp--}}

{{--<div--}}
{{--    x-data="{ show: @entangle($attributes->wire('model')) }"--}}
{{--    x-on:close.stop="show = false"--}}
{{--    x-on:keydown.escape.window="show = false"--}}
{{--    x-show="show"--}}
{{--    id="{{ $id }}"--}}
{{--    class="jetstream-modal fixed inset-0 overflow-y-auto px-2  py-6 sm:px-0 z-50"--}}
{{--    style="display: none;"--}}
{{-->--}}
{{--    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"--}}
{{--         x-transition:enter="ease-out duration-300"--}}
{{--         x-transition:enter-start="opacity-0"--}}
{{--         x-transition:enter-end="opacity-100"--}}
{{--         x-transition:leave="ease-in duration-200"--}}
{{--         x-transition:leave-start="opacity-100"--}}
{{--         x-transition:leave-end="opacity-0">--}}
{{--        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>--}}
{{--    </div>--}}

{{--    <div x-show="show"--}}
{{--         class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full w-[305px] {{ $maxWidth }} sm:mx-auto"--}}
{{--         x-trap.inert.noscroll="show"--}}
{{--         x-transition:enter="ease-out duration-300"--}}
{{--         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"--}}
{{--         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"--}}
{{--         x-transition:leave="ease-in duration-200"--}}
{{--         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"--}}
{{--         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">--}}
{{--        {{ $slot }}--}}
{{--    </div>--}}
{{--</div>--}}

