<div>
    <x-slot name="header">Contacts</x-slot>

    <!-- Top Controls --------------------------------------------------------------------------------------------->

    <x-aaran-ui::forms.m-panel>

        <x-aaran-ui::forms.top-controls :show-filters="$showFilters"/>

        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-aaran-ui::table.caption :caption="'Contacts'">
            {{$list->count()}}
        </x-aaran-ui::table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->

        <x-aaran-ui::table.form>

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-aaran-ui::table.header-serial width="20%"/>

                <x-aaran-ui::table.header-text wire:click="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Name
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text sortIcon="none">Mobile</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text sortIcon="none">Contact Type</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text sortIcon="none">Contact Person</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">GST No</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Outstanding</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-action/>

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)
                    <x-aaran-ui::table.row>
{{--                        <x-aaran-ui::table.cell-text><a href="{{route('invReport',[$row->id])}}"> {{$index+1}}</a>--}}
{{--                        </x-aaran-ui::table.cell-text>--}}

{{--                        <x-aaran-ui::table.cell-text left><a href="{{route('contactReport',[$row->id])}}"> {{$row->vname}}</a>--}}
{{--                        </x-aaran-ui::table.cell-text>--}}

{{--                        <x-aaran-ui::table.cell-text><a href="{{route('contactReport',[$row->id])}}"> {{$row->mobile}}</a>--}}
{{--                        </x-aaran-ui::table.cell-text>--}}

{{--                        <x-aaran-ui::table.cell-text>--}}
{{--                            <a href="{{route('contactReport',[$row->id])}}" class="{{$row->contact_type == 'Debtor'?:'text-orange-400'}}">--}}
{{--                                {{$row->contact_type}}--}}
{{--                            </a>--}}
{{--                        </x-aaran-ui::table.cell-text>--}}

{{--                        <x-aaran-ui::table.cell-text><a--}}
{{--                                href="{{route('contactReport',[$row->id])}}"> {{$row->contact_person}}</a>--}}
{{--                        </x-aaran-ui::table.cell-text>--}}

{{--                        <x-aaran-ui::table.cell-text><a--}}
{{--                                href="{{route('contactReport',[$row->id])}}"> {{$row->gstin}}</a>--}}
{{--                        </x-aaran-ui::table.cell-text>--}}

{{--                        <x-aaran-ui::table.cell-text>--}}
{{--                            <a--}}
{{--                                href="{{route('contactReport',[$row->id])}}"> {{$row->opening_balance+$row->outstanding}}</a>--}}
{{--                        </x-aaran-ui::table.cell-text>--}}


                        <!--We should change this after creating all the routes juz like upper code-->

                        <x-aaran-ui::table.cell-text> {{$index+1}}</x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text left> {{$row->vname}}</x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text> {{$row->mobile}}</x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text> {{$row->contact_type->vname}} </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text>{{$row->contact_person}}</x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text>{{$row->gstin}}</x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text>{{$row->opening_balance+$row->outstanding}}</x-aaran-ui::table.cell-text>


                        <td class="max-w-max print:hidden">
                            <div class="flex justify-center items-center sm:gap-4 gap-2 px-1 self-center">
                                <a href="{{route('contacts.upsert',[$row->id])}}" class="pt-1">
                                    <x-aaran-ui::button.edit/>
                                </a>
                                <x-aaran-ui::button.delete wire:click="getDelete({{$row->id}})"/>
                            </div>
                        </td>
                    </x-aaran-ui::table.row>
                @endforeach

            </x-slot:table_body>

        </x-aaran-ui::table.form>

        <x-aaran-ui::modal.delete/>

        <!-- Actions ------------------------------------------------------------------------------------------->

{{--<div>{{$list->links()}}</div>--}}


    </x-aaran-ui::forms.m-panel>
</div>
