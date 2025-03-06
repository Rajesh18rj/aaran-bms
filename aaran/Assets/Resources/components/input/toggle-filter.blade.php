@props([
'showFilters'=>false
])
<button wire:click="toggleShowFilters"
        class="mt-1.5">
    <x-aaran-ui::icons.icon :icon="$showFilters ? 'cog':'adjustments'" class="h-6 w-auto block"/>
</button>
