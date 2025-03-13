<div>
    <div class="relative w-full"
         x-data="{
             isOpen: false,
             selectedItem: @entangle('searchQuery').defer
             highlight: 0,
         }"
         @click.away="isOpen = false"
         @item-selected.window="isOpen = false"
    >
        <!-- Search Input -->
        <div class="relative">
            <input
                type="text"
                autocomplete="off"
                placeholder="Search {{ $label }}"
                @keydown.arrow-down.prevent="highlight = Math.min(highlight + 1, $wire.results.length - 1)"
                @keydown.arrow-up.prevent="highlight = Math.max(highlight - 1, 0)"
                @keydown.enter.prevent="if ($wire.results.length > 0) {
                 selectedItem = $wire.results[highlight]?.vname;
                 searchTerm = selectedItem;
                 isOpen = false;
                 $wire.selectItem($wire.results[highlight]?.id);
                 }"

                class="w-full px-3 py-2 text-sm border rounded-md focus:ring focus:ring-blue-300"
                x-model="searchTerm"
                @focus="isOpen = true"
                wire:model.live="searchQuery"
            />
            {{--            <label class="absolute left-3 top-2 text-gray-500 text-xs">{{ ucfirst($label) }}</label>--}}
        </div>

        <!-- Dropdown -->
        <div x-show="isOpen  && selectedItem.length > 0"
             class="absolute w-full mt-1 bg-white border rounded-md shadow-md z-50" x-cloak>
            <ul class="max-h-40 overflow-y-auto text-sm">
                @forelse ($results as $index => $item)
                    <li class="cursor-pointer px-3 py-2 hover:bg-blue-100"
                        :class="{ 'bg-blue-200': highlight === {{ $index }} }"

                        @click="
                        selectedItem = '{{ $item->vname }}';
                        searchTerm = selectedItem;
                        isOpen = false;
                        $wire.selectItem({{ $item->id }});
                    ">

                        {{ $item->vname }}
                    </li>
                @empty
                    <li class="px-3 py-2 text-gray-500">No results found</li>
                    <li class="cursor-pointer px-3 py-2 text-blue-600 hover:bg-blue-100"
                        @click="$wire.createNewItem(searchTerm)">
                        + Add "<span x-text="searchTerm"></span>"
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
