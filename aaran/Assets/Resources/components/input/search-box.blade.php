<div class="relative w-full">
    <label>
        <input type="search" wire:model.live="searches"    wire:keydown.escape="$set('searches', '')"
               class="search-box"
               placeholder="type for Search...           escape to clear">
    </label>
    <div class="absolute top-0 left-0 inline-flex items-center p-2">
        <x-icons.search-lens/>
    </div>
</div>
