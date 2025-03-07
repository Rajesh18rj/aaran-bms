<div>
    <x-slot name="header">GST Report</x-slot>
    <x-forms.m-panel>
        <div class="flex flex-row justify-evenly space-x-3">
            <div class="w-full">

                <x-input.model-select wire:model.live="month" :label="'Month'">
                    <option value="">Choose...</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </x-input.model-select>
            </div>
            <div class="w-full">
                <x-input.model-select wire:model.live="year" :label="'Year'">
                    <option value="">Choose...</option>
                    @for($year=2000;$year<=\Illuminate\Support\Carbon::now()->format('Y');$year++)
                        <option value="{{$year}}">{{$year}}</option>
                    @endfor

                </x-input.model-select>
            </div>
        </div>
        <?php
        $invoiceTotal = 0;
        $sales_gstTotal = 0;
        $purchase_gstTotal = 0;
        $purchaseTotal = 0
        ?>

        <div class="flex sm:flex-row flex-col gap-5">
            <div class="w-full h-auto">
                <div class="py-2 flex justify-evenly items-center">
                    <div class="text-xl text-center  font-bold tracking-wider">Sales Report</div>
                    <x-button.print-x wire:click="salesReport">Print</x-button.print-x>
                </div>

                <div class="h-screen overflow-y-auto pr-2">
                    <x-table.form>
                        <x-slot:table_header name="table_header" class="bg-green-600">
                            <x-table.header-serial width="20%"/>
                            <x-table.header-text sortIcon="none">Party Name</x-table.header-text>
                            <x-table.header-text sortIcon="none">Bill No</x-table.header-text>
                            <x-table.header-text sortIcon="none">Date</x-table.header-text>
                            <x-table.header-text sortIcon="none">Invoice Amount</x-table.header-text>
                            <x-table.header-text sortIcon="none">GST Amount</x-table.header-text>
                        </x-slot:table_header>

                        <!-- Table Body ------------------------------------------------------------------------------------------->

                        <x-slot:table_body name="table_body">
                            @foreach($sales as $index=>$row)
                                    <?php
                                    $invoiceTotal += $row->grand_total;
                                    $sales_gstTotal += $row->total_gst;
                                    ?>

                                <x-table.row>
                                    <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                                    <x-table.cell-text left>{{$row->contact->vname}}</x-table.cell-text>
                                    <x-table.cell-text>{{$row->invoice_no}}</x-table.cell-text>
                                    <x-table.cell-text> {{ date('d-m-Y', strtotime( $row->invoice_date))}}</x-table.cell-text>
                                    <x-table.cell-text right>{{$row->grand_total}}</x-table.cell-text>
                                    <x-table.cell-text right>
                                        {{$row->total_gst}}
                                    </x-table.cell-text>
                                </x-table.row>

                            @endforeach

                        </x-slot:table_body>
                    </x-table.form>
                </div>

            </div>

            <div class="w-full h-auto">
                <div class="py-2 flex justify-evenly items-center">
                    <div class="text-xl text-center  font-bold tracking-wider">Purchase Report</div>
                    <x-button.print-x wire:click="purchaseReport">Print</x-button.print-x>
                </div>

                <div class="h-screen overflow-y-auto pr-2">
                    <x-table.form>
                        <x-slot:table_header name="table_header" class="bg-green-600">
                            <x-table.header-serial width="20%"/>
                            <x-table.header-text sortIcon="none">Party Name</x-table.header-text>
                            <x-table.header-text sortIcon="none">Bill No</x-table.header-text>
                            <x-table.header-text sortIcon="none">Date</x-table.header-text>
                            <x-table.header-text sortIcon="none">Invoice Amount</x-table.header-text>
                            <x-table.header-text sortIcon="none">GST Amount</x-table.header-text>
                        </x-slot:table_header>

                        <!-- Table Body ------------------------------------------------------------------------------------------->

                        <x-slot:table_body name="table_body">
                            @foreach($purchase as $index=>$row)
                                    <?php
                                    $purchaseTotal += $row->grand_total;
                                    $purchase_gstTotal += $row->total_gst;
                                    ?>

                                <x-table.row>
                                    <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                                    <x-table.cell-text left>{{$row->contact->vname}}</x-table.cell-text>
                                    <x-table.cell-text>{{$row->purchase_no}}</x-table.cell-text>
                                    <x-table.cell-text> {{ date('d-m-Y', strtotime( $row->invoice_date))}}</x-table.cell-text>
                                    <x-table.cell-text right>{{$row->grand_total}}</x-table.cell-text>
                                    <x-table.cell-text right>
                                        {{$row->total_gst}}
                                    </x-table.cell-text>
                                </x-table.row>

                            @endforeach

                        </x-slot:table_body>
                    </x-table.form>
                </div>
            </div>
        </div>

        <div class="hidden sm:block">
            <x-table.form>
                <x-slot:table_body name="table_body">

                    <x-table.row>
                        <x-table.cell-text right>Total Sales</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($invoiceTotal)}}</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($sales_gstTotal)}}</x-table.cell-text>
                        <x-table.cell-text right>Total Purchase</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($purchaseTotal)}}</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($purchase_gstTotal)}}</x-table.cell-text>
                    </x-table.row>

                    <x-table.row>
                        <x-table.cell-text colspan="2" right>
                            <div class="font-bold">Difference (Sales-Purchase)</div>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <div
                                class="font-bold">{{\App\Helper\ConvertTo::rupeesFormat($invoiceTotal-$purchaseTotal)}}</div>
                        </x-table.cell-text>

                        <x-table.cell-text colspan="2" right>
                            <div class="font-bold">GST (Sales-Purchase)</div>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <div
                                class="font-bold">{{\App\Helper\ConvertTo::rupeesFormat($sales_gstTotal-$purchase_gstTotal)}}</div>
                        </x-table.cell-text>
                    </x-table.row>
                </x-slot:table_body>
            </x-table.form>
        </div>


{{--        <div class="w-full flex justify-end items-end">--}}
{{--            <x-button.print-x wire:click="GstPrint">Print</x-button.print-x>--}}
{{--        </div>--}}

        <div class="block sm:hidden">
            <x-table.form>
                <x-slot:table_body name="table_body">

                    <x-table.row>
                        <x-table.cell-text right>Total Sales Amount</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($invoiceTotal)}}</x-table.cell-text>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell-text right>Total Sales GST Amount</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($sales_gstTotal)}}</x-table.cell-text>
                    </x-table.row>

                    <x-table.row>
                        <x-table.cell-text right>Total Purchase Amount</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($purchaseTotal)}}</x-table.cell-text>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell-text right>Total Purchase GST Amount</x-table.cell-text>
                        <x-table.cell-text>{{\App\Helper\ConvertTo::rupeesFormat($purchase_gstTotal)}}</x-table.cell-text>
                    </x-table.row>

                    <x-table.row>
                        <x-table.cell-text  right>
                            <div class="font-bold">Difference (Sales-Purchase)</div>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <div
                                class="font-bold">{{\App\Helper\ConvertTo::rupeesFormat($invoiceTotal-$purchaseTotal)}}</div>
                        </x-table.cell-text>
                    </x-table.row>
                    <x-table.row>
                    <x-table.cell-text  right>
                        <div class="font-bold">GST (Sales-Purchase)</div>
                    </x-table.cell-text>
                    <x-table.cell-text>
                        <div
                            class="font-bold">{{\App\Helper\ConvertTo::rupeesFormat($sales_gstTotal-$purchase_gstTotal)}}</div>
                    </x-table.cell-text>
                    </x-table.row>

                </x-slot:table_body>
            </x-table.form>
        </div>

{{--        <div class="w-full flex justify-end items-end">--}}
{{--            <x-button.print-x wire:click="GstPrint">Print</x-button.print-x>--}}
{{--        </div>--}}


    </x-forms.m-panel>
</div>
