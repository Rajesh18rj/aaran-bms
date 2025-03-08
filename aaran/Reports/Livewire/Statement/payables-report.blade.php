<div>
    <x-slot name="header">Payables</x-slot>

    <!------Top Controls ---------------------------------------------------------------------------------------------->
    <x-forms.m-panel>
        <div class="space-y-16 text-xs">
            <div class="flex md:flex-row flex-col md:justify-between w-full gap-3 my-10">

                <!------Create Record ------------------------------------------------------------------------------------->

                <div class="sm:w-[40rem]">
                    <x-input.model-select wire:model.live="byParty" :label="'Party Name'">
                        <option value="">choose</option>
                        @foreach($contacts as $contact)
                            <option value="{{$contact->id}}">{{$contact->vname}}</option>
                        @endforeach
                    </x-input.model-select>
                </div>

                <x-input.model-date wire:model.live="start_date" :label="'From Date'"/>

                <x-input.model-date wire:model.live="end_date" :label="'To Date'"/>

                <div class="">
                    <x-button.print-x wire:click="print"/>
                </div>

            </div>
            <!------Table Header ------------------------------------------------------------------------------------------>
            <x-table.form>
                <x-slot:table_header name="table_header">
                    <x-table.header-serial width="20%"/>
                    <x-table.header-text :sort-icon="'none'">Type</x-table.header-text>
                    <x-table.header-text :sort-icon="'none'">Date</x-table.header-text>
                    <x-table.header-text :sort-icon="'none'">Invoice Amount</x-table.header-text>
                    <x-table.header-text :sort-icon="'none'">Payment Amount</x-table.header-text>
                    <x-table.header-text :sort-icon="'none'">Balance</x-table.header-text>
                </x-slot:table_header>

                <!------Table Body ---------------------------------------------------------------------------------------->

                <x-slot:table_body name="table_body">

                    @php
                        $totalpurchase = 0+$opening_balance;
                        $totalpayment = 0;
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

                    <!------Table Data ------------------------------------------------------------------------------------>

                    @forelse ($list as $index =>  $row)
                        @php
                            $totalpurchase += floatval($row->grand_total);
                            $totalpayment += floatval($row->transaction_amount);
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
                                {{  $balance  = $totalpurchase-$totalpayment}}
                            </x-table.cell-text>

                        </x-table.row>

                    @empty
                    @endforelse

                    <!----- Totals ---------------------------------------------------------------------------------------->

                    <x-table.row>
                        <x-table.cell-text colspan="3" class="text-md text-right text-gray-400 ">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;
                        </x-table.cell-text>
                        <x-table.cell-text
                            class="text-right  text-md ">{{$totalpurchase+$opening_balance}}</x-table.cell-text>
                        <x-table.cell-text class="text-right  text-md ">{{ $totalpayment}}</x-table.cell-text>
                        <x-table.cell-text></x-table.cell-text>
                    </x-table.row>

                    <!------ Balance -------------------------------------------------------------------------------------->

                    <x-table.row>
                        <x-table.cell-text colspan="3" class="text-md text-right text-gray-400 ">&nbsp;Balance&nbsp;&nbsp;&nbsp;
                        </x-table.cell-text>
                        <x-table.cell-text
                            class="text-right  text-md text-blue-500">{{ $totalpurchase-$totalpayment}}</x-table.cell-text>
                        <x-table.cell-text></x-table.cell-text>
                        <x-table.cell-text></x-table.cell-text>
                    </x-table.row>
                </x-slot:table_body>
            </x-table.form>
        </div>
    </x-forms.m-panel>
</div>
