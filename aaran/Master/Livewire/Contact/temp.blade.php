<div class="w-full font-lex text-xs" x-data="{ isTyped: false }">
    <div @click.away="isTyped = false" class="relative w-full">
        <!-- Input Field -->
        <div class="relative">
            <input
                wire:model.debounce.300ms="itemList.{{ 0 }}.city_name"
                wire:keydown.arrow-up="decrementCity"
                wire:keydown.arrow-down="incrementCity"
                wire:keydown.enter="enterCity({{ 0 }})"
                type="search"
                autocomplete="off"
                class="block w-full px-2.5 pb-2.5 pt-4 text-xs bg-transparent border border-gray-300 rounded-lg peer focus:ring-2 focus:ring-blue-50 focus:border-blue-600"
                placeholder=" "
                @focus="isTyped = true"
                @keydown.escape.window="isTyped = false"
                @keydown.tab.window="isTyped = false"
                @keydown.enter.prevent="isTyped = false"
                x-init="$nextTick(() => $el.focus())"
            />
            <!-- Floating Label -->
            <label class="absolute text-xs text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">
                City
            </label>
        </div>

        <!-- Dropdown -->
        <div x-show="isTyped" x-transition.opacity x-cloak class="absolute z-20 w-full mt-2 bg-white border border-gray-300 rounded-lg shadow-md">
            <div class="py-2">
                <ul class="overflow-auto h-44 text-xs">
                    @if ($cityCollection)
                        @forelse ($cityCollection as $i => $city)
                            <li class="px-3 py-1 text-blue-900 cursor-pointer hover:font-bold hover:bg-gray-100 rounded-md {{$highlightCity === $i ? 'bg-blue-100' : ''}}"
                                wire:click.prevent="setCity('{{ $city->vname }}', '{{ $city->id }}', '{{ 0 }}')"
                                @click="isTyped = false">
                                {{ $city->vname }}
                            </li>
                        @empty
                            <li class="px-4 py-2 text-gray-500">No Results Found...</li>
                            <!-- Create New City Button -->
                            <button wire:click.prevent="citySave('{{ $itemList[0]['city_name'] }}', '{{ 0 }}')"
                                    class="flex items-center w-full gap-x-2 px-4 py-2 text-blue-600 border-t hover:bg-blue-100 focus:ring focus:ring-blue-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd"/>
                                </svg>
                                <span>New City</span>
                            </button>
                        @endforelse
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Error Message -->
    @error('itemList.0.city_name')
    <span class="text-red-400">{{ $message }}</span>
    @enderror
</div>
