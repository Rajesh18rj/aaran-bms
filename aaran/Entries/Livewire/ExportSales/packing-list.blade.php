<div>
    <x-slot name="header">Packing List</x-slot>
    <x-aaran-ui::forms.m-panel>
        <div class="flex sm:flex-row flex-col w-full sm:gap-0.5 gap-3">
            <x-aaran-ui::input.floating wire:model.live="nos" :label="'BOX NOS'"/>
            <div class="w-full">
                <x-aaran-ui::input.model-select wire:model.live="exportSalesItem_index" :label="'Item'">
                    <option value="">Choose...</option>
                    @foreach($exportSalesItem as $index=>$SalesItem)
                        <option value="{{$index==0?'0.1':$index}}">{{$SalesItem->product_name}}</option>
                    @endforeach
                </x-aaran-ui::input.model-select>
            </div>
            <x-aaran-ui::input.floating wire:model.live="net_wt" :label="'NET WT'"/>
            <x-aaran-ui::input.floating wire:model.live="grs_wt" :label="'GRS WT'"/>
            <x-aaran-ui::input.floating wire:model.live="dimension" :label="'BOX Dimension'"/>
            <x-aaran-ui::input.floating wire:model.live="cbm" :label="'CBM'"/>
            <div class="pl-2 flex items-end">
                <x-aaran-ui::button.add wire:click="addItems"/>
            </div>

        </div>

        <div class="py-2 mt-5 overflow-x-auto">

            <table class="overflow-x-auto md:w-full ">
                <thead>
                    <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                        <th class="w-12 px-2 text-center border border-gray-300">#</th>
                        <th class="px-2 text-center border border-gray-300">BOX NOS</th>
                        <th class="px-2 text-center border border-gray-300">ITEM IN BOX</th>
                        <th class="px-2 text-center border border-gray-300">SIZE</th>
                        <th class="px-2 text-center border border-gray-300">QTY IN BOX</th>
                        <th class="px-2 text-center border border-gray-300">NO OF BOX</th>
                        <th class="px-2 text-center border border-gray-300">TOTAL QTY</th>
                        <th class="px-2 text-center border border-gray-300">NET WT</th>
                        <th class="px-2 text-center border border-gray-300">GRS WT</th>
                        <th class="px-2 text-center border border-gray-300">TOTAL NWT WT</th>
                        <th class="px-2 text-center border border-gray-300">TOTAL GRS WT</th>
                        <th class="px-2 text-center border border-gray-300">DIMENSION</th>
                        <th class="px-2 text-center border border-gray-300">CBM</th>
                        <th class="px-2 text-center border border-gray-300">Print</th>
                        <th class="w-12 px-1 text-center border border-gray-300">ACTION</th>
                    </tr>
                </thead>

                <tbody>
                @if( $itemList)
                    @foreach( $itemList as $index=>$row)
                    <tr class="border border-gray-400 hover:bg-amber-50">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            <button class="w-full h-full cursor-pointer"
                                    wire:click.prevent="changeItems({{$index}})">
                                {{$index+1}}
                            </button>
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">{{$row['nos']}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">
                            {{$exportSalesItem[$row['exportSalesItem_index']]->product_name}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">
                            {{$exportSalesItem[$row['exportSalesItem_index']]->size_name}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">
                            {{$exportSalesItem[$row['exportSalesItem_index']]->qty/$exportSalesItem[$row['exportSalesItem_index']]->no_of_count}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">
                            {{$exportSalesItem[$row['exportSalesItem_index']]->no_of_count}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">
                            {{$exportSalesItem[$row['exportSalesItem_index']]->qty+0}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">{{$row['net_wt']}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">{{$row['grs_wt']}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">
                            {{$exportSalesItem[$row['exportSalesItem_index']]->no_of_count*$row['net_wt']}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">
                            {{$exportSalesItem[$row['exportSalesItem_index']]->no_of_count*$row['grs_wt']}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">{{$row['dimension']}}
                        </td>

                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                            wire:click.prevent="changeItems({{$index}})">{{$row['cbm']}}
                        </td>
                        <td class="text-center border border-gray-300">
                            <x-aaran-ui::button.print-pdf routes="{{route('exportsales.packingListPrint',[$exportSales_id])}}"/>
                        </td>

                        <td class="text-center border border-gray-300">
                            <x-aaran-ui::button.delete wire:click.prevent="removeItems({{$index}})"/>
                        </td>

                    </tr>
                    @endforeach
                @endif
                </tbody>

            </table>
        </div>
    </x-aaran-ui::forms.m-panel>
    <x-aaran-ui::forms.m-panel-bottom-button save back/>
</div>
