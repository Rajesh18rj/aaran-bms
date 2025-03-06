<!-- Delete Record -->
<x-aaran-ui::modal.confirmation wire:model.defer="showDeleteModal">
    <x-slot name="title">Delete Entry</x-slot>
    <x-slot name="content">
        <div class="py-8 text-cool-gray-700 ">Are you sure you? This action is irreversible.</div>
    </x-slot>
    <x-slot name="footer">
        <div class=" flex gap-5 justify-end">

{{--            <button wire:click.prevent="$set('showDeleteModal', false)"--}}
{{--               class='max-w-max bg-gradient-to-r from-slate-600 to-slate-500 hover:from-slate-500 hover:to-slate-600 focus:ring-2 focus:ring-offset-2--}}
{{--                focus:ring-slate-600 text-white sm:px-4 sm:py-2 px-2 py-1 text-[12px] inline-flex items-center gap-x-2 rounded-md tracking-widest font-semibold--}}
{{--                transition-all linear duration-400 '>--}}
{{--                <x-icons.icon :icon="'chevrons-left'" class="sm:h-5 h-3 w-auto"/>--}}
{{--                <span>CANCEL</span>--}}
{{--            </button>--}}

{{--            <x-button.danger wire:click.prevent="trashData">Delete</x-button.danger>--}}

            <x-aaran-ui::button.cancel-x wire:click.prevent="$set('showDeleteModal', false)" />
            <x-aaran-ui::button.danger-x wire:click.prevent="trashData($id)" />
        </div>
    </x-slot>
</x-aaran-ui::modal.confirmation>
