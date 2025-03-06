<div>
    <x-slot name="header">Default Company </x-slot>
    <x-aaran-ui::forms.m-panel>
        <x-aaran-ui::alerts.notification />

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-aaran-ui::forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-aaran-ui::table.caption :caption="'Default Company'">
            {{$list->count()}}
        </x-aaran-ui::table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-aaran-ui::table.form>
            <x-slot:table_header>
                <x-aaran-ui::table.header-serial/>
                <x-aaran-ui::table.header-text  wire:click.prevent="sortBy('id')"  sortIcon="{{$sortAsc}}" :left="true">
                    Company ID
                </x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Tenant ID</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Accounting Year</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-serial/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-aaran-ui::table.row>
                        <x-aaran-ui::table.cell-text>{{$index+1}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text left>{{$row->company_id}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text >{{ $row->tenant->t_name ?? 'N/A' }}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text >{{$row->acyear}}</x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-action id="{{$row->id}}"/>
                    </x-aaran-ui::table.row>
                @endforeach
            </x-slot:table_body>
        </x-aaran-ui::table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-aaran-ui::modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->

        <x-aaran-ui::forms.create :id="$vid">
            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="company_id" label="Company ID" />
            </div>
            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="tenant_id" label="Tenant ID" />
            </div>
            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="acyear" label="Accounting Year" />
            </div>
            <div class="mb-4">
                <x-aaran-ui::input.error-text wire:model="company_id"/>
            </div>

        </x-aaran-ui::forms.create>

    </x-aaran-ui::forms.m-panel>
</div>


