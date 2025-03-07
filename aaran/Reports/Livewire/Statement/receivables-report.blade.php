<div>
    <x-slot name="header">Receivables</x-slot>

    <x-forms.m-panel>
        <div class="flex md:flex-row flex-col md:justify-between w-full gap-3">
            <div class="sm:w-[40rem]">
{{--                <x-input.model-select wire:model.live="byParty" :label="'Party Name'">--}}
{{--                    <option value="">choose</option>--}}
{{--                    @foreach($contacts as $contact)--}}
{{--                        <option value="{{$contact->id}}">{{$contact->vname}}</option>--}}
{{--                    @endforeach--}}
{{--                </x-input.model-select>--}}
                <div class="text-lg font-merri space-x-5">
                    <span class="font-lex">Party Name:</span> <span >{{$partyName}}</span>
                </div>
            </div>
            <x-input.model-date wire:model.live="start_date" :label="'From Date'"/>
            <x-input.model-date wire:model.live="end_date" :label="'To Date'"/>
            <div class="">
                <x-button.print-x wire:click="print" />
            </div>
        </div>
        <x-forms.table>
            <x-slot:table_header name="table_header">
                <x-table.header-serial width="20%"/>
                <x-table.header-text :sort-icon="'none'">Type</x-table.header-text>
                <x-table.header-text :sort-icon="'none'" >Date</x-table.header-text>
                <x-table.header-text :sort-icon="'none'">Invoice Amount</x-table.header-text>
                <x-table.header-text :sort-icon="'none'">Receipt Amount</x-table.header-text>
                <x-table.header-text :sort-icon="'none'">Balance</x-table.header-text>
            </x-slot:table_header>
            <x-slot:table_body name="table_body">
                @php
                    $totalSales = 0+$opening_balance;
                    $totalReceipt = 0;
                @endphp
                <x-table.row>
                    @if($byParty !=null)
                        <x-table.cell-text colspan="3">
                            <div class="text-right font-bold">
                                Opening Balance
                            </div>
                        </x-table.cell-text>

                        <x-table.cell-text colspan="1">
                            <div class="text-right font-bold">
                                {{ $opening_balance}}
                            </div>
                        </x-table.cell-text>
                        <x-table.cell-text colspan="1">
                        </x-table.cell-text>
                        <x-table.cell-text colspan="1">
                            <div class="text-right font-bold">
                            {{$opening_balance}}
                            </div>
                        </x-table.cell-text>
                    @endif
                </x-table.row>
                @forelse ($list as $index =>  $row)
                    @php
                        $totalSales += floatval($row->grand_total);
                        $totalReceipt += floatval($row->transaction_amount);
                    @endphp
                    <x-table.row>
                        <x-table.cell-text center>
                            {{ $index + 1 }}
                        </x-table.cell-text>
                        <x-table.cell-text center>
                            {{ $row->mode }}
                        </x-table.cell-text>
                        <x-table.cell-text left>
                            {{$row->mode=='invoice' ?$row->vno.' / ':''}}{{date('d-m-Y', strtotime($row->vdate))}}
                        </x-table.cell-text>
                        <x-table.cell-text right>
                            {{ $row->grand_total }}
                        </x-table.cell-text>
                        <x-table.cell-text right>
                            {{ $row->transaction_amount }}
                        </x-table.cell-text>
                        <x-table.cell-text right>
                            {{  $balance  = $totalSales-$totalReceipt}}
                        </x-table.cell-text>
                    </x-table.row>
                @empty
                @endforelse
                <x-table.row>
                    <x-table.cell-text colspan="3" class=" text-md text-right text-gray-400">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;
                    </x-table.cell-text>
                    <x-table.cell-text class=" text-right  text-md  text-zinc-500 ">{{$totalSales+$opening_balance}}</x-table.cell-text>
                    <x-table.cell-text class=" text-right  text-md  text-zinc-500 ">{{ $totalReceipt}}</x-table.cell-text>
                    <x-table.cell-text></x-table.cell-text>
                </x-table.row>
                <x-table.row>
                    <x-table.cell-text colspan="3" class=" text-md text-right text-gray-400 ">&nbsp;Balance&nbsp;&nbsp;&nbsp;
                    </x-table.cell-text>
                    <x-table.cell-text class=" text-right  text-md  text-blue-500 ">{{ $totalSales-$totalReceipt}}</x-table.cell-text>
                    <x-table.cell-text class=" text-right  text-md  text-blue-500 "></x-table.cell-text>
                    <x-table.cell-text></x-table.cell-text>
                </x-table.row>
            </x-slot:table_body>
        </x-forms.table>
    </x-forms.m-panel>
</div>
