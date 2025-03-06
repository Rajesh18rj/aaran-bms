<div>
    <x-aaran-ui::controls.lookup.model :show-model="$showModel" label="Style">
            <x-aaran-ui::input.lookup-text  wire:model="vname" x-ref="vname" :label="'Style Name'"
                                 :name="'vname'"/>
            <x-aaran-ui::input.lookup-text  wire:model="desc" :label="'Description'" :name="'desc'"/>
    </x-aaran-ui::controls.lookup.model>
</div>
