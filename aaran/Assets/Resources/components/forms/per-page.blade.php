<x-aaran-ui::input.group borderless paddingless for="perPage" label="Per Page">
    <select wire:model.live="perPage" id="perPage"
            class="w-20 md:w-20 rounded-md focus:border-0 focus:ring-2 focus:ring-blue-500 mt-2">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</x-aaran-ui::input.group>


