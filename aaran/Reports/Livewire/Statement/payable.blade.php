<div>
    <x-slot name="header">Payables</x-slot>

    <!-- Top Controls --------------------------------------------------------------------------------------------->

    <x-forms.m-panel>

        {{--        <x-forms.top-controls :show-filters="$showFilters"/>--}}

        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-table.caption :caption="'PayablesReport'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Name
                </x-table.header-text>

                {{--                <x-table.header-text sortIcon="none">Mobile</x-table.header-text>--}}

                <x-table.header-text sortIcon="none">Contact Type</x-table.header-text>

                {{--                <x-table.header-text sortIcon="none">Contact Person</x-table.header-text>--}}
                {{--                <x-table.header-text sortIcon="none">GST No</x-table.header-text>--}}
                <x-table.header-text sortIcon="none">Outstanding</x-table.header-text>

                {{--                <x-table.header-action/>--}}

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)
                        <x-table.row>
                            <x-table.cell-text><a href="{{route('payables-report',[$row->id])}}"> {{$index+1}}</a>
                            </x-table.cell-text>

                            <x-table.cell-text left><a href="{{route('payables-report',[$row->id])}}"> {{$row->vname}}</a>
                            </x-table.cell-text>
                            <x-table.cell-text>
                                <a href="{{route('payables-report',[$row->id])}}"
                                   class="text-orange-600">
                                    {{$row->contact_type->vname}}
                                </a>
                            </x-table.cell-text>
                            <x-table.cell-text>
                                <a
                                        href="{{route('payables-report',[$row->id])}}"> {{$row->opening_balance+$row->outstanding}}</a>
                            </x-table.cell-text>
                        </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <x-modal.delete/>

        <!-- Actions ------------------------------------------------------------------------------------------->

{{--        <div>{{$list->links()}}</div>--}}


    </x-forms.m-panel>
</div>
