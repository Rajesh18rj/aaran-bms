<div>
    <x-slot name="header">Gst Percent</x-slot>
    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-table.caption :caption="'Gst Percent'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-table.form>
            <x-slot:table_header>
                <x-table.header-serial/>
                <x-table.header-text wire:click.prevent="sortBy('id')" sortIcon="{{$sortAsc}}" :left="true">
                    Gst Percent
                </x-table.header-text>

                <x-table.header-text> Desc</x-table.header-text>

                <x-table.header-status/>
                <x-table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text left>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->desc}}</x-table.cell-text>

                        <x-table.cell-status active="{{$row->active_id}}"/>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->

        <x-forms.create :id="$vid">
            <div class="flex flex-col  gap-3">
                <x-input.floating wire:model="vname" label="Gst Percent"/>
                <x-input.error-text wire:model="vname"/>
                <x-input.floating wire:model="desc" label="Desc"/>
            </div>
        </x-forms.create>


    </x-forms.m-panel>
</div>
