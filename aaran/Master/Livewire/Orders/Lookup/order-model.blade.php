<div>
    <x-aaran-ui::controls.lookup.model :show-model="$showModel" label="Order No">
        <x-aaran-ui::input.lookup-text  wire:model.live="vname"  x-ref="vname" :label="'Order'" :name="'vname'"/>
        <x-aaran-ui::input.lookup-text  wire:model.live="order_name"  x-ref="state_code" :label="'Order Name'" :name="'order_name'"/>
    </x-aaran-ui::controls.lookup.model>
</div>
