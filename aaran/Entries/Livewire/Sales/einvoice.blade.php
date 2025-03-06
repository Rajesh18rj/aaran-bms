<div>
    <x-slot name="header">Sales E-Invoice</x-slot>
    <x-aaran-ui::forms.m-panel>
        <div class="p-5 space-y-5 border-2 border-gray-300">
            <div class="flex justify-between">
                <div class="space-y-2">
                    <div>Seller Details : <span class="font-bold tracking-wider">{{$companyDetails->vname}}</span></div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$companyDetails->address_1}},{{$companyDetails->address_2}},
                    </div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{Aaran\Common\Models\City::find($companyDetails->city_id)->vname}},
                        {{Aaran\Common\Models\State::find($companyDetails->state_id)->vname}}-
                        {{Aaran\Common\Models\State::find($companyDetails->state_id)->desc}},
                    </div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{Aaran\Common\Models\Pincode::find($companyDetails->pincode_id)->vname}}.
                    </div>
                    <div class="">GST NO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$companyDetails->gstin}}.</div>
                </div>
                <div class="space-y-2">
                    <div>Party Details : <span class="font-bold tracking-wider">{{$contactDetails->vname}}</span></div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$addressDetails->address_1}},{{$addressDetails->address_2}},
                    </div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{Aaran\Common\Models\City::find($addressDetails->city_id)->vname}},
                        {{Aaran\Common\Models\State::find($addressDetails->state_id)->vname}}-
                        {{Aaran\Common\Models\State::find($addressDetails->state_id)->desc}},
                    </div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{Aaran\Common\Models\Pincode::find($addressDetails->pincode_id)->vname}}.
                    </div>
                    <div class="">GST NO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$contactDetails->gstin}}.</div>
                </div>
                <div class="space-y-2">
                    <div>Invoice No &nbsp;&nbsp;&nbsp;: {{$salesData->invoice_no}}</div>
                    <div>Invoice Date : {{date('d/m/Y', strtotime($salesData->invoice_date))}}</div>
                </div>
            </div>

            <div class="p-3">
                <section>
                    <div class="py-2 mt-5 overflow-x-auto">

                        <table class="overflow-x-auto md:w-full ">
                            <thead>
                            <tr class="h-8 text-xs bg-gray-100 border border-gray-300">

                                <th class="w-12 px-2 text-center border border-gray-300">#</th>

                                @if(\Aaran\Assets\Features\SaleEntry::hasPo_no())
                                    <th class="px-2 text-center border border-gray-300">Po</th>
                                @endif

                                @if(\Aaran\Assets\Features\SaleEntry::hasDc_no())
                                    <th class="px-2 text-center border border-gray-300">Dc</th>
                                @endif

                                @if(\Aaran\Assets\Features\SaleEntry::hasNo_of_roll())
                                    <th class="px-2 text-center border border-gray-300">No of Roll</th>
                                @endif

                                <th class="px-2 text-center border border-gray-300">PRODUCT</th>

                                @if(\Aaran\Assets\Features\SaleEntry::hasColour())
                                    <th class="px-2 text-center border border-gray-300">COLOUR</th>
                                @endif

                                @if(\Aaran\Assets\Features\SaleEntry::hasSize())
                                    <th class="px-2 text-center border border-gray-300">SIZE</th>
                                @endif

                                <th class="px-2 text-center border border-gray-300">QTY</th>
                                <th class="px-2 text-center border border-gray-300">PRICE</th>
                                <th class="px-2 text-center border border-gray-300">TAXABLE</th>
                                <th class="px-2 text-center border border-gray-300">GST PERCENT</th>
                                <th class="px-2 text-center border border-gray-300">GST</th>
                                <th class="px-2 text-center border border-gray-300">SUBTOTAL</th>
                            </tr>
                            </thead>

                            <!--Display Table Items ------------------------------------------------------------------------------->
                            <tbody>

                            @if ($itemList)

                                @foreach($itemList as $index => $row)

                                    <tr class="border border-gray-400 hover:bg-amber-50">
                                        <td class="text-center border border-gray-300 bg-gray-100">
                                            <button class="w-full h-full cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">
                                                {{$index+1}}
                                            </button>
                                        </td>


                                        @if(\Aaran\Assets\Features\SaleEntry::hasPo_no())
                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['po_no']}}</td>
                                        @endif

                                        @if(\Aaran\Assets\Features\SaleEntry::hasDc_no())
                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['dc_no']}}</td>
                                        @endif

                                        @if(\Aaran\Assets\Features\SaleEntry::hasNo_of_roll())
                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['no_of_roll']}}</td>
                                        @endif

                                        <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                            wire:click.prevent="changeItems({{$index}})">
                                            <div>{{$row['product_name']}}
                                                @if($row['description'])
                                                    &nbsp;-&nbsp;
                                                @endif
                                                @if(\Aaran\Assets\Features\SaleEntry::hasProductDescription())
                                                    {{ $row['description']}}
                                                @endif
                                            </div>

                                        </td>

                                        @if(\Aaran\Assets\Features\SaleEntry::hasColour())
                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['colour_name']}}</td>
                                        @endif

                                        @if(\Aaran\Assets\Features\SaleEntry::hasSize())
                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['size_name']}}</td>
                                        @endif

                                        <td class="px-2 text-center border border-gray-300 cursor-pointer"
                                            wire:click.prevent="changeItems({{$index}})">{{$row['qty']}}</td>
                                        <td class="px-2 text-right border border-gray-300 cursor-pointer"
                                            wire:click.prevent="changeItems({{$index}})">{{$row['price']}}</td>
                                        <td class="px-2 text-right border border-gray-300 cursor-pointer"
                                            wire:click.prevent="changeItems({{$index}})">{{$row['taxable']}}</td>
                                        <td class="px-2 text-center border border-gray-300 cursor-pointer"
                                            wire:click.prevent="changeItems({{$index}})">{{$row['gst_percent']}}</td>
                                        <td class="px-2 text-right border border-gray-300 cursor-pointer"
                                            wire:click.prevent="changeItems({{$index}})">{{$row['gst_amount']}}</td>
                                        <td class="px-2 text-right border border-gray-300 cursor-pointer"
                                            wire:click.prevent="changeItems({{$index}})">{{$row['subtotal']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <!-- Table Bottom ------------------------------------------------------------------------------------->
                            <tfoot class="mt-2">
                            <tr class="h-8 text-sm border border-gray-400 bg-cyan-50">

                                @if(\Aaran\Assets\Features\SaleEntry::hasSize() or \Aaran\Assets\Features\SaleEntry::hasColour())
                                    <td colspan="4" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>
                                @else
                                    <td colspan="2" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>
                                @endif

                                <td class="px-2 text-center border border-gray-300">{{$salesData->total_qty+0}}</td>
                                <td class="px-2 text-center border border-gray-300">&nbsp;</td>
                                <td class="px-2 text-right border border-gray-300">{{$salesData->total_taxable+0}}</td>
                                <td class="px-2 text-center border border-gray-300">&nbsp;</td>
                                <td class="px-2 text-right border border-gray-300">{{$salesData->total_gst+0}}</td>
                                <td class="px-2 text-right border border-gray-300">{{$salesData->total_taxable+$salesData->total_gst}}</td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>

                </section>
            </div>

            <div class="flex justify-evenly">
                <div class="space-y-2 w-full">
                    <div class="flex justify-evenly">
                        <span class="w-full">Transport Mode</span>
                        <span class="w-full">: {{$salesData->TransMode}}</span>
                    </div>
                    <div class="flex justify-evenly">
                        <span class="w-full">Transport Id</span>
                        <span class="w-full">: {{$salesData->Transid}}</span>
                    </div>
                    <div class="flex justify-evenly">
                        <span class="w-full">Transport Name</span>
                        <span class="w-full">: {{$salesData->Transname}}</span>
                    </div>
                    <div class="flex justify-evenly">
                        <span class="w-full">Transport No</span>
                        <span class="w-full">: {{$salesData->Transdocno}}</span>
                    </div>
                    <div class="flex justify-evenly">
                        <span class="w-full">Transport Date</span>
                        <span class="w-full">: {{date('d/m/Y', strtotime($salesData->TransdocDt))}}</span>
                    </div>
                    <div class="flex justify-evenly">
                        <span class="w-full">vehicle No</span>
                        <span class="w-full">: {{$salesData->Vehno}}</span>
                    </div>
                    <div class="flex justify-evenly">
                        <span class="w-full">vehicle Type</span>
                        <span class="w-full">: {{$salesData->Vehtype}}</span>
                    </div>
                </div>
                <div class="w-full">
                    @if(isset($e_invoiceDetails->id))
                        <div class="flex flex-col items-center justify-center ">
                            <img class="w-[145px]"
                                 src="{{\Aaran\Assets\Helper\qrcoder::generate($e_invoiceDetails->signed_qrcode,22)}}"
                                 alt="{{$e_invoiceDetails->signed_qrcode}}">
                            <div>Irn No : {{$e_invoiceDetails->irn}}</div>
                        </div>
                    @endif
                </div>
                <div class="w-full">
                    <div class="grid w-full md:grid-cols-2 pt-6">
                        <label
                            class="md:px-3 md:pb-2 text-left text-gray-600 text-md">Taxable&nbsp;Amount&nbsp;:&nbsp;&nbsp;</label>
                        <label
                            class="ml-8 md:px-3 md:pb-2 text-right text-gray-800 text-md">{{  $salesData->total_taxable }}</label>
                    </div>


                    <div class="grid w-full grid-cols-2 pt-6">
                        <label
                            class="px-3 pb-2 text-left text-gray-600 text-md">Gst&nbsp;:&nbsp;&nbsp;</label>
                        <label class="px-3 pb-2 text-right text-gray-800 text-md">{{  $salesData->total_gst }}</label>
                    </div>


                    <div class="grid w-full grid-cols-2 pt-6">
                        <label
                            class="px-3 pb-2 text-left text-gray-600 text-md">Round off&nbsp;:&nbsp;&nbsp;</label>
                        <label class="px-3 pb-2 text-right text-gray-800 text-md">{{$salesData->round_off}}</label>
                    </div>


                    <div class="grid w-full grid-cols-2 pt-6">
                        <label
                            class="mr-3 md:px-3 md:pb-2 text-xl text-left  text-gray-600">Grand&nbsp;Total&nbsp;:&nbsp;&nbsp;</label>
                        <label
                            class="ml-8  px-3 pb-2  md:px-3 md:pb-2 text-xl font-extrabold text-right text-gray-800">{{$salesData->grand_total}}</label>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <x-aaran-ui::button.back-x wire:click="getRoute"/>
                @if(!isset($e_invoiceDetails))
                    <x-aaran-ui::button.e-invoice-x wire:click="jsonFormate"/>
                    <x-aaran-ui::button.secondary wire:click="IrnDetails">GetIrn</x-aaran-ui::button.secondary>
                @endif
                @if(isset($e_invoiceDetails))
                    @if($e_invoiceDetails->status!='Canceled')
                        <x-aaran-ui::button.e-cancel-x wire:click="cancelIrn"/>
                        <x-aaran-ui::button.secondary wire:click="IrnDetails">GetIrn</x-aaran-ui::button.secondary>
                    @endif
                @endif
            </div>
        </div>

        <x-aaran-ui::jet.modal wire:model.defer="showModel">
            <div class="px-6  pt-4">
                <div class="text-lg">
                    Cancel E-Invoice1
                </div>
                <x-aaran-ui::forms.section-border class="py-2"/>
                <div class="flex flex-col gap-3 mt-5">
                    <x-aaran-ui::input.model-select :label="'Cancel Reason'" wire:model="CnlRsn">
                        <option>Choose..</option>
                        <option value="1">Duplicate</option>
                        <option value="2">Data entry mistake</option>
                        <option value="3">Order Cancelled</option>
                        <option value="4">Others</option>
                    </x-aaran-ui::input.model-select>
                    <x-aaran-ui::input.floating :label="'Cancel Remark'" wire:model="CnlRem"/>
                </div>
                <div class="mb-1">&nbsp;</div>
            </div>
            <div class="px-6 py-3 bg-gray-100 text-right">
                <div class="w-full flex justify-between gap-3">
                    <div class="py-2">&nbsp;</div>
                    <div class="flex gap-3">
                        <x-aaran-ui::button.cancel-x wire:click.prevent="$set('showModel', false)"/>
                        <x-aaran-ui::button.e-cancel-x wire:click="getCancelIrn"/>
                    </div>
                </div>
            </div>
        </x-aaran-ui::jet.modal>
        <x-aaran-ui::jet.modal wire:model="showError">
            <div class="p-5 space-y-5">
                <div class="">Reason for Failed to Generate IRN</div>
                <div class="border-b-2">&nbsp;</div>
                <div>
                    @if(isset($successMessage))
                        <ul class="list-decimal space-y-2 px-5">
                            @foreach($successMessage as $row)
                                <li> {{$row->ErrorMessage}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="border-b-2">&nbsp;</div>
                <div class="flex justify-end items-end space-x-3">
                    <x-aaran-ui::button.secondary wire:click.prevent="$set('showError', false)">Cancel</x-aaran-ui::button.secondary>

                </div>
            </div>
        </x-aaran-ui::jet.modal>
        <x-aaran-ui::jet.modal wire:model="showIrnData" :maxWidth="'6xl'">
            <div class="p-5 space-y-5">
                <div class="">IRN Details</div>
                <div class="border-b-2">&nbsp;</div>
                <div>
                    @if(isset($Irn_Detail))
                        <ul class="list-decimal space-y-2 px-5 max-w-4xl">
                            @foreach($Irn_Detail as $index=>$row)
                                <li>{{$index}} : {{$row}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="border-b-2">&nbsp;</div>
                <div class="flex justify-end items-end space-x-3">
                    <x-aaran-ui::button.secondary wire:click.prevent="$set('showIrnData', false)">Cancel</x-aaran-ui::button.secondary>

                </div>
            </div>
        </x-aaran-ui::jet.modal>
    </x-aaran-ui::forms.m-panel>
</div>
