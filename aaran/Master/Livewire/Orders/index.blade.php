<div>
    <x-slot name="header">Orders</x-slot>

    <!-- Top Controls ------------------------------------------------------------------------------------------------->

    <x-aaran-ui::forms.m-panel>
        <x-aaran-ui::alerts.notification />


        <x-aaran-ui::forms.top-controls :show-filters="$showFilters"/>

        <x-aaran-ui::table.caption :caption="'Orders'">
            {{$list->count()}}
        </x-aaran-ui::table.caption>

        <x-aaran-ui::table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-aaran-ui::table.header-serial width="20%"/>

                <x-aaran-ui::table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Name
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text wire:click.prevent="sortBy('order_name')" sortIcon="{{$getListForm->sortAsc}}">
                    Order
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-aaran-ui::table.row>
                        <x-aaran-ui::table.cell-text>{{$index+1}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text left>{{$row->vname}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text>{{$row->order_name}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-action id="{{$row->id}}"/>
                    </x-aaran-ui::table.row>

                @endforeach

            </x-slot:table_body>

        </x-aaran-ui::table.form>

        <x-aaran-ui::modal.delete/>

        <!--Create ---------------------------------------------------------------------------------------------------->
        <x-aaran-ui::forms.create :id="$common->vid">

            <div class="flex flex-col  gap-3">
                <x-aaran-ui::input.floating wire:model="common.vname" label="Name"/>
                <x-aaran-ui::input.floating wire:model="order_name" label="Order"/>
            </div>

        </x-aaran-ui::forms.create>

        <!-- Actions ------------------------------------------------------------------------------------------->

{{--        <div class="pt-5 w-10/12 mx-auto">{{ $list->links() }}</div>--}}

    </x-aaran-ui::forms.m-panel>
    <div class="px-10 py-16 space-y-4">
{{--        @if(!$log->isEmpty())--}}
{{--            <div class="text-xs text-orange-600 font-merri underline underline-offset-4">Activity</div>--}}
{{--        @endif--}}
{{--        @foreach($log as $index => $row)--}}
{{--            <div class="px-6">--}}
{{--                <div class="relative ">--}}
{{--                    <div class=" border-l-[3px] border-dotted px-8 text-[10px]  tracking-wider py-3">--}}
{{--                        <div class="flex gap-x-5 ">--}}
{{--                            <div class="inline-flex text-gray-500 items-center font-sans font-semibold">--}}
{{--                                <span>Order No:</span> <span>{{$row->vname}}</span></div>--}}
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
    </div>
</div>
