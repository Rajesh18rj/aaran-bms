@props([
'showFilters'=>false,
])

<div class="flex sm:flex-row sm:justify-between sm:items-center  flex-col gap-6 py-4 print:hidden">
    <div class="w-2/4 flex items-center space-x-2">

        <x-aaran-ui::input.search-bar wire:model.live="searches"
                            wire:keydown.escape="$set('searches', '')" label="Search"/>
        <x-aaran-ui::input.toggle-filter :show-filters="$showFilters"/>
    </div>

    <div class="flex sm:justify-center justify-between">
        <x-aaran-ui::forms.per-page/>
        <div class="self-end">
            <x-aaran-ui::button.new-x wire:click="create"/>
        </div>
    </div>
</div>
<x-aaran-ui::input.advance-search :show-filters="$showFilters"/>
