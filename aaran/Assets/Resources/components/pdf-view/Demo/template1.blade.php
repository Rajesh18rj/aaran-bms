<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-5 ">
<div class="">
    <!-- Company Logo , Address, QR Code -->
    <div class="flex items-center justify-between border-b-2 border-black pb-4 px-4">
        <div class="flex items-center space-x-6">
            <img src="{{ public_path('/storage/images/'.$cmp->get('logo'))}}" alt="company logo" class="h-24"/>
            <div class="flex-col flex gap-1 ">
                <div class="text-3xl uppercase font-bold">{{$cmp->get('company_name')}}</div>
                <div class="flex-col flex text-xs space-y-0.5 text-gray-600">
                    <div class="text-xs inline-flex items-center space-x-2">
                        <x-icons.icon-fill iconfill="phone1" class="w-4 h-4 fill-gray-600"/>
                        <span>{{$cmp->get('address_1')}},{{$cmp->get('address_2')}},</span></div>
                    <div class="text-xs pl-6">{{$cmp->get('city')}}</div>
                    <div class="text-xs inline-flex items-center space-x-2">
                        <x-icons.icon-fill iconfill="location" class="w-3 h-3 fill-gray-600"/>
                        <span>{{$cmp->get('contact')}}</span> -
                        <x-icons.icon-fill iconfill="envelope" class="w-3 h-3 fill-gray-600"/>
                        <span>{{$cmp->get('email')}}</span></div>
                    <div class="text-xs inline-flex items-center space-x-2">
                        <x-icons.icon-fill iconfill="e-inv" class="w-3 h-3 fill-gray-600"/>
                        <span>{{$cmp->get('gstin')}}</span></div>
                </div>
            </div>
        </div>
        @if($irn)
            <img class="w-[145px] h-auto rounded-sm" src="{{\App\Helper\qrcoder::generate($irn->signed_qrcode,22)}}"
                 alt="{{$irn->signed_qrcode}}">
        @endif
    </div>

    {{--    <div class="w-full inline-flex items-center justify-center pt-3">--}}
    {{--        <div class="max-w-max mx-auto flex items-center space-x-1">--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-0.5 h-auto auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-1  h-auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-1.5 h-auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-2 h-auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-2.5 h-auto fill-gray-600"/>--}}
    {{--        <span class="w-full">----------</span>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-2.5 h-auto fill-gray-600"/>--}}
    {{--        <span class="w-full">----------</span>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-2.5 h-auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-2 h-auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-1.5 h-auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-1 h-auto fill-gray-600"/>--}}
    {{--        <x-icons.icon-fill iconfill="bulletin" class="w-0.5 h-auto fill-gray-600"/>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- Invoice Details -->
    <div class="  ">
        <div class=" flex justify-between font-bold py-2">
            <div class="text-sm flex items-end">TO:</div>
            <div class="text-4xl">TAX INVOICE</div>
        </div>
        <div class=" flex justify-between pb-2">
            <div class="w-4/6 text-xs text-gray-600 space-y-1">
                <div class="font-semibold inline-flex items-end space-x-2 text-black text-sm">
                    <span>M/S</span><span>{{$obj->contact_name}}</span></div>
                <div class="">{{$billing_address->get('address_1')}}, {{$billing_address->get('address_2')}}</div>
                <div class="">{{$billing_address->get('address_3')}}</div>
                <div class="">{{$billing_address->get('gstcell')}}</div>
            </div>
            <div class="w-2/6 text-xs flex-col flex space-y-1 text-gray-600">
                <div class="inline-flex justify-between"><span
                        class="font-bold text-black">Invoice No:</span><span>{{$obj->invoice_no}}</span></div>
                <div class="inline-flex justify-between"><span
                        class="font-bold text-black">Date:</span><span>{{$obj->invoice_date ?date('d-m-Y', strtotime($obj->invoice_date)):''}}</span>
                </div>
                <div class="inline-flex justify-between"><span class="w-1/2 font-bold text-black">IRN No:</span><span
                        class="1/2 break-all text-end">12345678901234567980012345678901234567890</span></div>
            </div>
        </div>
    </div>

    <!-- Item Table -->
    <div>
        <table class="w-full border-t-2 border-b-2 border-black">
            <thead class="font-semibold text-xs bg-gray-50">
            <tr class="py-2 border-b border-r border-gray-300">
                <th class="py-2 w-[3%] px-1 border-r border-l border-gray-300">S.No</th>
                <th class="py-2 w-[8%] border-r border-gray-300">HSN Code</th>
                <th class="py-2 border-r border-gray-300">Particulars</th>
                <th class="py-2 w-[5%] border-r border-gray-300">Size</th>
                <th class="py-2 w-[6%] border-r px-1 border-gray-300">colours</th>
                <th class="py-2 w-[6%] border-r border-gray-300">Qty</th>
                <th class="py-2 w-[6%] border-r border-gray-300">Price</th>
                <th class="py-2 w-[8%] border-r border-gray-300">Taxable Amount</th>
                <th class="py-2 w-[3%] border-r border-gray-300">%</th>
                <th class="py-2 w-[8%] border-r border-gray-300">GST</th>
                <th class="py-2 w-[10%] border-r border-gray-300">Sub Total</th>
            </tr>
            </thead>
            <tbody>
            @php
                $gstPercent = 0;
            @endphp
            @foreach($list as $index => $row)
                <tr class="text-xs border-b border-r border-gray-300">
                    <td class="py-2 text-center border-l border-r border-gray-300">{{$index+1}}</td>
                    <td class="py-2 text-center border-r border-gray-300">{{$row['hsncode']}}</td>
                    <td class="py-2 text-center border-r border-gray-300">
                        @if($row['description'])
                            {{$row['product_name'].' - '.$row['description']}}
                        @else
                            {{$row['product_name']}}
                        @endif
                    </td>
                    <td class="py-2 text-center border-r border-gray-300">{{$row['size_name']}}</td>
                    <td class="py-2 text-center border-r border-gray-300">{{$row['colour_name']}}</td>
                    <td class="py-2 text-center border-r border-gray-300">{{$row['qty']+0}}</td>
                    <td class="py-2 text-center border-r border-gray-300">{{number_format($row['price'],2,'.','')}}</td>
                    <td class="py-2 text-center border-r border-gray-300">{{number_format($row['qty']*$row['price'],2,'.','')}}</td>
                    <td class="py-2 text-center border-r border-gray-300">{{$row['gst_percent']*2}}</td>
                    <td class="py-2 text-center border-r border-gray-300">{{number_format($row['gst_amount'],2,'.','')}}</td>
                    <td class="py-2 text-end px-4 border-r border-gray-300">{{number_format($row['sub_total'],2,'.','')}}</td>
                </tr>
            @endforeach
            @for($i = 0; $i < 9 - $list->count(); $i++)
                <tr class="text-xs border-b border-r border-gray-300">
                    <td class="py-2 text-center border-l border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                    <td class="py-2 text-center border-r border-gray-300">&nbsp;</td>
                </tr>
            @endfor

            <tr class="text-xs py-2 font-semibold border-r border-l border-gray-300">
                <td colspan="3" class="py-2 px-4">E&OE</td>
                <td colspan="2" class="py-2 border-r border-gray-300 text-end px-4">Total</td>
                <td class="text-center py-2 border-r border-l border-gray-300">{{$obj->total_qty+0}}</td>
                <td class="py-2"></td>
                <td class="text-center py-2 border-r border-l border-gray-300">{{number_format($obj->total_taxable,2,'.','')}}</td>
                <td class="py-2"></td>
                <td class="text-center py-2 border-r border-l border-gray-300">{{number_format($obj->total_gst,2,'.','')}}</td>
                <td class="text-center py-2 border-r border-l border-gray-300">{{number_format($obj->grand_total-$obj->additional,2,'.','')}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="w-full flex justify-between py-3 border-b-2 border-black">
        <div class="w-2/3 text-xs pr-4 space-y-1">
            <div class="leading-1 text-gray-600">
                We hereby certify that our registration under the GST Act 2017 is in force on
                the date on which sale of the goods specified in this invoice is made by us
                and the transaction of sale is covered by this invoice has been effected by
                us in the regular course of our business. All the Disputes are subject to
                Tirupur Jurisdiction Only.
            </div>
            <div class="font-semibold">* Goods once sold cannot be return back or exchanged</div>
            <div class="font-semibold">* Seller cannot be responsible for any damage/mistakes.</div>
            <div class="space-y-1 bg-gray-100 p-1">
                <div class="">Amount (in words)</div>
                <div class="font-bold">{{$rupees}}Only</div>
            </div>
        </div>
        <div class="w-1/3 flex justify-between text-xs">
            <div class="space-y-1.5 font-semibold">
                <div>Taxable Value</div>
                <div>CGST&nbsp;@&nbsp;{{$gstPercent}}%</div>
                <div>SGST&nbsp;@&nbsp;{{$gstPercent}}%</div>
                <div>Total GST</div>
                @if($obj->additional!=0)
                    <div>Add&nbsp;:&nbsp;{{ $obj->ledger_name }}</div>
                @else
                    <div>Add&nbsp;:&nbsp;</div>
                @endif
                <div>Round Off</div>
                <div class="font-bold">GRAND TOTAL</div>
            </div>
            <div class="space-y-1.5">
                <div>:</div>
                <div>:</div>
                <div>:</div>
                <div>:</div>
                <div>:</div>
                <div>:</div>
                <div>:</div>
            </div>
            <div class="space-y-1.5 px-4 text-end">
                <div>{{number_format($obj->total_taxable,2,'.','')}}</div>
                <div>{{number_format($obj->total_gst/2,2,'.','')}}</div>
                <div>{{number_format($obj->total_gst/2,2,'.','')}}</div>
                <div>{{number_format($obj->total_gst,2,'.','')}}</div>
                @if($obj->additional!=0)
                    <div>{{ number_format($obj->additional,2,'.','') }}</div>
                @else
                    <div>&nbsp;-&nbsp;</div>
                @endif
                <div>{{number_format($obj->round_off,2,'.','')}}</div>
                <div>{{number_format($obj->grand_total,2,'.','')}}</div>
            </div>
        </div>
    </div>
</div>

<div class="flex py-3">
    <div class="w-2/6 flex items-center text-xs space-x-4 font-semibold">
        <div class="space-y-1.5">
            <div class="font-bold">PAYMENT</div>
            <div>ACCOUNT NO</div>
            <div>IFSC CODE</div>
            <div>BANK NAME</div>
            <div>BRANCH</div>
        </div>
        <div class="space-y-1.5">
            <div>&nbsp;</div>
            <div>:</div>
            <div>:</div>
            <div>:</div>
            <div>:</div>
        </div>
        <div class="space-y-1.5">
            <div>&nbsp;</div>
            <div>{{$cmp->get('acc_no')}}</div>
            <div>{{$cmp->get('ifsc_code')}}</div>
            <div>{{$cmp->get('bank')}}</div>
            <div>{{$cmp->get('branch')}}</div>
        </div>
    </div>
    <div class="w-4/6 border border-gray-300 p-2 text-xs flex justify-between">
        <div class="inline-flex items-end">
            Receiver Sign
        </div>
        <div class="flex-col flex h-full items-center justify-between">
            <div class="inline-flex items-center">
                <span>For&nbsp;</span><b>{{$cmp->get('company_name')}}</b>
            </div>
            <div>
                Authorised Signatory
            </div>
        </div>
    </div>
</div>
</body>
</html>
