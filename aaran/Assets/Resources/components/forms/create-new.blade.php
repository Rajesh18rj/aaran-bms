@props([
    'id'
])

<form wire:submit.prevent="save" >
    <div class="w-full">
        <x-jet.modal :maxWidth="'6xl'" wire:model.defer="showEditModal">
            <div class="px-6  pt-4">
                <div class="text-lg">
                    {{$id === "" ? 'New Entry' : 'Edit Entry'}}
                </div>
                <x-forms.section-border class="py-2"/>
                {{$slot}}
                <div class="mb-1">&nbsp;</div>
            </div>
            <div class="px-6 py-3 bg-gray-100 text-right">
                <div class="w-full flex justify-between gap-3">
                    <div class="py-2">
                        <label for="active_id" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="active_id" class="sr-only peer"
                                   wire:model="active_id">
                            <div
                                class="w-10 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2
                                        peer-focus:ring-blue-300
                                         peer-checked:after:translate-x-full peer-checked:after:border-white
                                         after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300
                                         after:border after:rounded-full after:h-4 after:w-4 after:transition-all
                                         peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Active</span>
                        </label>
                    </div>
                    <div class="flex gap-3">
                        <x-button.cancel/>
                        <x-button.save/>
                    </div>
                </div>
            </div>
        </x-jet.modal>
    </div>
</form>
