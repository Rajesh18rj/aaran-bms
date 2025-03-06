<div>
    <x-slot name="header">Purchase</x-slot>

    <!-- Top Control -------------------------------------------------------------------------------------------------->
    <x-aaran-ui::forms.m-panel>

        <x-aaran-ui::alerts.notification />

        <x-aaran-ui::forms.top-controls :show-filters="$showFilters"/>

        <x-aaran-ui::table.caption :caption="'Purchase'">
            {{$list->count()}}
        </x-aaran-ui::table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->
        <x-aaran-ui::table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="{{$getListForm->sortAsc}}">
                    Order No
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="{{$getListForm->sortAsc}}">
                    Purchase No
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="none"> Purchase Date
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="none"> Party Name
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Total Qty</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Total Taxable
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Total Gst</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Grand Total
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Print</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-action/>

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-aaran-ui::table.row>

                        <x-aaran-ui::table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->order->vname}}</a>
                        </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->purchase_no}}</a>
                        </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{ date('d-m-Y', strtotime( $row->purchase_date))}}</a>
                        </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text left>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->contact->vname}}</a>
                        </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->total_qty+0}}</a>
                        </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text right>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->total_taxable}}</a>
                        </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text right>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->total_gst}}</a>
                        </x-aaran-ui::table.cell-text>

                        <x-aaran-ui::table.cell-text right>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->grand_total}}</a>
                        </x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text>
                            <x-aaran-ui::button.print-pdf routes="{{route('purchases.print', [$row->id])}}"/>
                        </x-aaran-ui::table.cell-text>

                        <!-- Table Action ----------------------------------------------------------------------------->
                        <td class="max-w-max print:hidden">
                            <div class="flex justify-center items-center">
                                <a href="{{route('purchase.upsert',[$row->id])}}" class="pt-1 px-1.5">
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


        <div class="">{{ $list->links() }}</div>


    </x-aaran-ui::forms.m-panel>

{{--    <div class="max-w-6xl px-10 mx-auto py-16 space-y-4">--}}
{{--        @if(!$purchasesAllLogs->isEmpty())--}}
{{--            <div class="text-xs text-orange-600  font-merri underline underline-offset-4">Activity</div>--}}
{{--        @endif--}}
{{--        @foreach($purchasesAllLogs as $row)--}}
{{--            <div class="px-6">--}}
{{--                <div class="relative ">--}}
{{--                    <div class=" border-l-[3px] border-dotted px-8 text-[10px]  tracking-wider py-3">--}}
{{--                        <div class="flex gap-x-5 ">--}}
{{--                            <div class="inline-flex text-gray-500 items-center font-sans font-semibold">--}}
{{--                                <span>Invoice No:</span> <span>{{$row->vname}}</span></div>--}}
{{--                            <div class="inline-flex  items-center space-x-1 font-merri"><span--}}
{{--                                    class="text-blue-600">@</span><span--}}
{{--                                    class="text-gray-500">{{$row->user->name}}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div--}}
{{--                            class="text-gray-400 text-[8px] font-semibold">{{date('M d, Y', strtotime($row->created_at))}}</div>--}}
{{--                        <div class="pb-2 font-lex leading-5 py-2 text-justify">{!! $row->description !!}</div>--}}
{{--                    </div>--}}
{{--                    <div class="absolute top-0 -left-1 h-2.5 w-2.5  rounded-full bg-teal-600 "></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}

</div>
