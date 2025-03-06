@props([
'showFilters'=>false,
])

<div class="md:flex md:justify-between md:items-center">
    <div class="w-full h-20 md:w-2/4 md:items-center flex md:space-x-2">

        <x-input.search-box/>
        <x-input.toggle-filter :show-filters="$showFilters"/>

    </div>

    <div class="flex justify-between items-center  md:space-x-2 md:flex md:items-center">
        <x-forms.per-page/>
        <x-button.new/>
    </div>
</div>

