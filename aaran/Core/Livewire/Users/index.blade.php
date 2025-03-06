<div>
    <x-slot name="header">User</x-slot>
    <x-aaran-ui::forms.m-panel>
        <x-aaran-ui::alerts.notification />

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-aaran-ui::forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-aaran-ui::table.caption :caption="'User'">
            {{$list->count()}}
        </x-aaran-ui::table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-aaran-ui::table.form>
            <x-slot:table_header>
                <x-aaran-ui::table.header-serial/>
                <x-aaran-ui::table.header-text  wire:click.prevent="sortBy('id')"  sortIcon="{{$sortAsc}}">
                    User Name
                </x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Email</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Profile Photo</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Tenant ID</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Role ID</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-serial/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-aaran-ui::table.row>
                        <x-aaran-ui::table.cell-text>{{$index+1}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text >{{$row->name}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text >{{$row->email}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text >{{$row->profile_photo_path}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text >{{ $row->tenant->t_name ?? 'N/A' }}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text >{{ $row->role?->vname ?? 'N/A' }}</x-aaran-ui::table.cell-text>
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
                <x-aaran-ui::input.floating wire:model="name" label="User Name" />
            </div>

            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="email" label="Email" />
            </div>

            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="password" label="Password" />
            </div>

            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="profile_photo_path" label="Profile Photo" />
            </div>

            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="tenant_id" label="Tenant ID" />
            </div>

            <div class="mb-4">
                <x-aaran-ui::input.floating wire:model="role_id" label="Role ID" />
            </div>

            <x-aaran-ui::input.error-text wire:model="name"/>
        </x-aaran-ui::forms.create>

    </x-aaran-ui::forms.m-panel>
</div>


