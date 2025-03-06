<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eway</title>
    {{--    <link rel="stylesheet" href="/public/invoice.css" type="text/css">--}}
    <link rel="stylesheet" href="https://cdn.curlwind.com">
    <style type="text/css">
        /*common class*/
        * {
            font-family: Verdana, Arial, sans-serif, Helvetica, Times;
        }

        .page-break {
            page-break-after: always;
        }

        .wrap {
            overflow-wrap: anywhere;
        }

        table {
            width: 100%;
        }

        .bg-gray {
            background-color: #f2f2f2;
        }

        .w-full {
            width: 100%;
        }

        .border {
            border: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-none {
            border: none;
        }

        .border-t {
            border-top: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-r {
            border-right: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-b {
            border-bottom: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-l {
            border-left: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-t-none {
            border-top: none;
        }

        .border-r-none {
            border-right: none;
        }

        .border-b-none {
            border-bottom: none;
        }

        .border-l-none {
            border-left: none;
        }

        .font-semibold {
            font-weight: lighter;
        }

        .font-bold {
            font-weight: bold;
        }

        .times {
            font-family: "Times New Roman", serif;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .lh-0 {
            line-height: 0.5;
        }

        .lh-1 {
            line-height: 1;
        }

        .lh-2 {
            line-height: 1.5;
        }

        .lh-3 {
            line-height: 2.5;
        }

        .lh-4 {
            line-height: 3;
        }

        .lh-5 {
            line-height: 3.5;
        }

        .lh-6 {
            line-height: 4;
        }

        .v-align-t {
            vertical-align: top;
        }

        .v-align-c {
            vertical-align: middle;
        }

        .v-align-b {
            vertical-align: bottom;
        }

        .p-0 {
            padding: 0;
        }

        .p-1 {
            padding: 1px;
        }

        .p-5 {
            padding: 5px;
        }

        .p-10 {
            padding: 10px;
        }

        .px-1 {
            padding: 0 1px;
        }

        .px-5 {
            padding: 0 5px;
        }

        .px-10 {
            padding: 0 10px;
        }

        .py-1 {
            padding: 1px 0;
        }

        .py-5 {
            padding: 5px 0;
        }

        .py-10 {
            padding: 10px 0;
        }

        .text-4xl {
            font-size: 36px;
        }

        .text-3xl {
            font-size: 28px;
        }

        .text-2xl {
            font-size: 24px;
        }

        .text-xl {
            font-size: 20px;
        }

        .text-lg {
            font-size: 16px;
        }

        .text-md {
            font-size: 12px;
        }

        .text-sm {
            font-size: 10px;
        }

        .text-xs {
            font-size: 9px;
        }
    </style>
</head>
<body>
<!-- Invoice IRN -->
<div class="w-full text-xs right p-1">Original Copy</div>
<table class="border w-full border-b-none">
    <tr>
        <td style="width: 145px;">
            @if($cmp->get('logo')!='no_image')
                <img src="{{ public_path('/storage/images/'.$cmp->get('logo'))}}" alt="company logo" width="130px"/>
            @else
                <img src="{{ public_path('images/sk-logo.jpeg') }}" alt="" width="130px">
            @endif
        </td>
        <td class="lh-0 center">
            <div class=" lh-1 font-bold times text-4xl">{{$cmp->get('company_name')}}</div>
            <div class="lh-2 text-md v-align-b ">
                <div class="times">{{$cmp->get('address_1')}}</div>
                <div class="times">{{$cmp->get('address_2')}}, {{$cmp->get('city')}}</div>
                <div class="times">{{$cmp->get('contact')}} - {{$cmp->get('email')}}</div>
                <div class="times">{{$cmp->get('gstin')}}</div>
            </div>
        </td>
        <td style="width: 145px;">
            <div style="width: 145px; height: auto;">
                @if(isset($irn))
                    <img style="height: auto;width:145px;"
                         src="{{\App\Helper\qrcoder::generate($irn->signed_qrcode, 22)}}" alt="{{$irn->irn}}">
                @endif
            </div>
        </td>
    </tr>
</table>
<table class="border v-align-c">
    <tr class="bg-gray center font-bold text-md p-1">
        <td width="40%" class="right py-5">TAX INVOICE</td>
        <td width="20%"></td>
        <td width="40%" class=""></td>
    </tr>
    <tr class="text-md v-align-t">
        <td width="70%" class="px-10 lh-0 ">
            <p class="font-bold">M/s.{{$obj->contact_name}}</p>
            <p class="times">{{$billing_address->get('address_1')}}</p>
            <p class="times">{{$billing_address->get('address_2')}}</p>
            <p class="times">{{$billing_address->get('address_3')}}</p>
            <p class="times">{{$billing_address->get('gstcell')}}</p>
        </td>
        <td width="15%" class=" border-l font-bold px-10 lh-1">
            <p>Invoice No:</p>
            <p>Date:</p>
            <p class="">IRN:</p>
        </td>
        <td width="15%" class=" px-10 lh-1">
            <p class="times">{{$obj->invoice_no}}</p>
            <p class="times">{{$obj->invoice_date ?date('d-m-Y', strtotime($obj->invoice_date)):''}}</p>
            @if(isset($irn))
                <p class="wrap times">{{$irn->irn}}</p>
            @endif
        </td>
    </tr>
</table>
<table class="border border-t-none">
    <tr class="bg-gray text-sm lh-2 border-b">
        <th width="4.33%" class="border-r">S.No</th>
        <th width="8.33%" class="border-r">HSN Code</th>
        <th width="auto" class="border-r">Particulars</th>
        <th width="6.33%" class="border-r">Size</th>
        <th width="8.33%" class="border-r">Colours</th>
        <th width="4.33%" class="border-r">Quantity</th>
        <th width="8.33%" class="border-r">Price</th>
        <th width="8.33%" class="border-r">Taxable Amount</th>
        <th width="4.33%" class="border-r">%</th>
        <th width="16.66" class="border-r">GST</th>
        <th width="16.66" class="border-r">Sub Total</th>
    </tr>
    @php
        $gstPercent = 0;
    @endphp
    @foreach($list as $index => $row)
        <tr class="text-sm center v-align-t">
            <td height="26px" class="center border-r p-1">{{$index+1}} </td>
            <td class="left border-r p-1">{{$row['hsncode']}}</td>
            <td class="left border-r p-1" style="">
                @if($row['description'])
                    {{$row['product_name'].' - '.$row['description']}}
                @else
                    {{$row['product_name']}}
                @endif
            </td>
            <td class="center border-r p-1">{{$row['size_name']}}</td>
            <td class="center border-r p-1">{{$row['colour_name']}} </td>
            <td class="right border-r p-1">{{$row['qty']+0}}</td>
            <td class="right border-r p-1">&nbsp;{{number_format($row['price'],2,'.','')}}</td>
            <td class="right border-r p-1">&nbsp;{{number_format($row['qty']*$row['price'],2,'.','')}}</td>
            <td class="center border-r p-1">{{$row['gst_percent']*2}}</td>
            <td class="right border-r p-1">&nbsp;{{number_format($row['gst_amount'],2,'.','')}}</td>
            <td class="right border-r p-1">&nbsp;{{number_format($row['sub_total'],2,'.','')}}</td>
        </tr>
        @php
            $gstPercent = $row['gst_percent'];
        @endphp
    @endforeach

    {{-- Spacing  --}}
    @for($i = 0; $i < 13-$list->count(); $i++)
        <tr class="">
            <td height="26px" class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
        </tr>
    @endfor
    <tr class="text-sm lh-1 right border v-align-c">
        <td colspan="2" height="20px">E&OE</td>
        <td colspan="3" class="border-r">Total&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="border-r">{{$obj->total_qty+0}}</td>
        <td class="border-r"></td>
        <td class="border-r">&nbsp;{{number_format($obj->total_taxable,2,'.','')}}</td>
        <td colspan="2" class="border-r">&nbsp;{{number_format($obj->total_gst,2,'.','')}}</td>
        <td>&nbsp;{{number_format($obj->grand_total-$obj->additional,2,'.','')}}</td>
    </tr>

    {{--    @if($obj->sales_type==0)--}}
    <tr>
        <td rowspan="2" colspan="5" class="text-xs lh-2 ">
                            <span>We hereby certify that our registration under the GST Act 2017 is in force on
                                the date on which sale of the goods specified in this invoice is made by us
                                and the transaction of sale is covered by this invoice has been effected by
                                us in the regular course of our business. All the Disputes are subject to
                                Tirupur Jurisdiction Only.
                            </span>
        </td>
        <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">Taxable Value</td>
        <td class="text-sm right border-b lh-2  v-align-c"
            colspan="2">{{number_format($obj->total_taxable,2,'.','')}}</td>
    </tr>
    <tr>
        @if($obj->sales_type==0)
            <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">CGST&nbsp;@&nbsp;{{$gstPercent}}
                %
            </td>
            <td class="text-sm right border-b lh-2 v-align-c"
                colspan="2">{{number_format($obj->total_gst/2,2,'.','')}}</td>
        @else
            <td class="text-md left border-l border-b p-5 lh-2 v-align-c" colspan="4">&nbsp;
            </td>
            <td class="text-md right border-b lh-2 v-align-c"
                colspan="2">&nbsp;
            </td>
        @endif
    </tr>
    <tr>
        <td colspan="5" class="text-xs font-bold">
            <div>* Goods once sold cannot be return back or exchanged</div>
            <div>* Seller cannot be responsible for any damage/mistakes.</div>
        </td>
        @if($obj->sales_type==0)
            <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">SGST&nbsp;@&nbsp;{{$gstPercent}}
                %
            </td>
            <td class="text-sm right border-b lh-2 v-align-c"
                colspan="2">{{number_format($obj->total_gst/2,2,'.','')}}</td>
        @else
            <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">IGST&nbsp;@&nbsp;{{$gstPercent}}
                %
            </td>
            <td class="text-sm right border-b lh-2 v-align-c"
                colspan="2">{{number_format($obj->total_gst,2,'.','')}}</td>
        @endif
    </tr>
    <tr>
        <td colspan="5">
            <div></div>
        </td>
        <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">Total GST</td>
        <td class="text-sm right border-b lh-2 v-align-c"
            colspan="2">{{number_format($obj->total_gst,2,'.','')}}</td>
    </tr>
    <tr>
        <td class="text-sm font-bold px-5" rowspan="2" colspan="2" width="100px">
            <div>ACCOUNT NO</div>
            <div>IFSC CODE</div>
            <div>BANK NAME</div>
            <div>BRANCH</div>
        </td>
        <td rowspan="2" colspan="3" class="text-sm font-bold px-5">
            <div>:&nbsp;{{$cmp->get('acc_no')}}</div>
            <div>:&nbsp;{{$cmp->get('ifsc_code')}}</div>
            <div>:&nbsp;{{$cmp->get('bank')}}</div>
            <div>:&nbsp;{{$cmp->get('branch')}}</div>
        </td>
        @if($obj->additional!=0)
            <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">
                Add&nbsp;:&nbsp;{{ $obj->ledger_name }}
            </td>
            <td class="text-sm right border-b lh-2 v-align-c"
                colspan="2">{{ number_format($obj->additional,2,'.','') }}</td>
        @else
            <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">&nbsp;</td>
            <td class="text-sm right border-b lh-2 v-align-c" colspan="2">&nbsp;</td>
        @endif
    </tr>
    <tr>
        <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4">Round Off</td>
        <td class="text-sm right border-b lh-2 px-1 v-align-c"
            colspan="2">{{number_format($obj->round_off,2,'.','')}}</td>
    </tr>
    <tr class="border-t border-b lh-2 ">
        <td colspan="5" class="text-md px-5 v-align-c">
            <div>Amount (in words)</div>
            <div ><b class="times">{{$rupees}}Only</b></div>
        </td>
        <td class="text-md left border-l border-b lh-2 p-5 v-align-c" colspan="4"><b>GRAND TOTAL</b></td>
        <td class="text-sm right border-b lh-2  v-align-c" colspan="2">
            <b>{{number_format($obj->grand_total,2,'.','')}}</b></td>
    </tr>
    <tr class="text-md v-align-t ce">
        <td height="60px" colspan="6" class=" px-5">
            Receiver Sign
        </td>
        <td height="60px" colspan="5" width="250px" class="center">
            For&nbsp;<b class="times">{{$cmp->get('company_name')}}</b>
            {{--            <p>Authorised Signatory</p>--}}
        </td>
    </tr>
    <tr class="w-full text-md v-align-b center">
        <td colspan="6"></td>
        <td colspan="5" class="">Authorised Signatory</td>
    </tr>
</table>
<div class="page-break"></div>

<!-- eWay -->
<div class="w-full text-xs right p-1">Original Copy</div>
<table class="border border-b-none v-align-c">
    <tr class="bg-gray center font-bold text-md p-1 v-align-c">
        <td width="40%" colspan="2" class="center py-5">e-Way Bill</td>
    </tr>
    <tr class="text-md v-align-c">
        <td class="left p-5">Invoice No: {{$obj->invoice_no}}</td>
        <td class="right p-5 ">Date: {{$obj->invoice_date ?date('d-m-Y', strtotime($obj->invoice_date)):''}}</td>
    </tr>
</table>
<table class="border-l border-r">
    <tr class="bg-gray center font-bold text-md p-1 v-align-c">
        <td colspan="5" class="left p-5">1. e-way Bill details</td>
    </tr>
    <tr class="text-md v-align-t">
        <td width=15%" class="lh-2 px-5">
            <p>e-Way Bill No</p>
            <p>Generated By</p>
            <p>Supply By</p>
            <p>Mode</p>
        </td>
        <td width="25%" class="lh-2 border-r">

            <p>:@if(isset($eWay))
                    {{ $eWay->ewbno }}
                @endif</p>

            <p class="wrap">: {{$cmp->get('gstin')}}</p>
            <p>: {{$obj->contact_name}}</p>
            <p>: {{$obj->TransMode}}</p>
        </td>
        <td width="15%" class="lh-2 px-5">
            <p>Approx Distance</p>
            <p>Transaction Type</p>
            <p>Generated Date</p>
            <p>Valid Upto</p>
        </td>
        <td width="25%" class="lh-2 border-r">
            <p>: {{$obj->distance}}</p>
            <p>: {{$obj->Vehtype}}</p>
            <p>: @if(isset($eWay))
                    {{ $eWay->ewbdt }}
                @endif</p>
            <p>: @if(isset($eWay))
                    {{ $eWay->ewbvalidtill }}
                @endif</p>
        </td>
        <td style="width: 145px;height: 145px;">
            <div style="width: 145px; height: 145px;">
                @if(isset($eWay))
                    <img style="width: 145px; height: 145px;" class=""
                         src="{{\App\Helper\qrcoder::generate($eWay->ewbno,2)}}"
                         alt="{{$eWay->ewbno}}">
                @endif
            </div>
        </td>
    </tr>
</table>
<table class="border-l border-r">
    <tr class="bg-gray center font-bold text-md p-1 v-align-c">
        <td colspan="2" class="left p-5">2. Address Details</td>
    </tr>
    <tr class="text-md v-align-t lh-0">
        <td width="50%" class=" px-5">
            <p class="font-bold">From</p>
            <p>{{$cmp->get('company_name')}}</p>
            <p>{{$billing_address->get('gstcell')}}</p>
            <p>{{$billing_address->get('address_3')}}</p>
        </td>
        <td width="50%" class="border-l px-5">
            <p class="font-bold">To</p>
            <p>{{$cmp->get('company_name')}}</p>
            <p>{{$shipping_address->get('gstcell')}}</p>
            <p>{{$shipping_address->get('address_3')}}</p>
        </td>
    </tr>
    <tr class="text-md v-align-t lh-0 ">
        <td width="50%" class="px-5">
            <p class="font-bold">Dispatch From</p>
            <p>{{ $billing_address->get('address_1') }}</p>
            <p>{{$billing_address->get('address_2')}}</p>
            <p>{{$billing_address->get('address_3')}}</p>
        </td>
        <td width="50%" class="border-l px-5">
            <p class="font-bold">Ship To</p>
            <p>{{$shipping_address->get('address_1')}}</p>
            <p>{{$shipping_address->get('address_2')}}</p>
            <p>{{$shipping_address->get('address_3')}}</p>
        </td>
    </tr>
</table>
<table class="border-t border-l border-r">
    <tr class="bg-gray center font-bold text-md p-1 v-align-c">
        <td colspan="" class="left p-5">3. Good Details</td>
    </tr>
</table>
<table class="border-l border-r border-b">
    <tr class="bg-gray text-sm border-t border-b v-align-c">
        <th width="12%" class="border-r py-10">HSN Code</th>
        <th width="auto" class="border-r">Product name & Desc</th>
        <th width="8%" class="border-r">Quantity</th>
        <th width="12%" class="border-r">Taxable Amount</th>
        <th width="12%" class="border-r">Sub Total</th>
    </tr>
    @php
        $gstPercent = 0;
    @endphp
    @foreach($list as $index => $row)
        <tr class="text-sm center v-align-t">
            <td height="24px" class="center border-r p-1">{{$row['hsncode']}}</td>
            <td class="left border-r p-1" style="">
                @if($row['description'])
                    {{$row['product_name'].' - '.$row['description']}}
                @else
                    {{$row['product_name']}}
                @endif
            </td>

            <td class="center border-r p-1">{{$row['qty']+0}}</td>
            <td class="right border-r p-1">{{number_format($row['qty']*$row['price'],2,'.','')}}</td>
            <td class="center border-r p-1">{{$row['gst_percent']/2*2}}&nbsp;+&nbsp;{{$row['gst_percent']/2*2}}</td>
        </tr>
        @php
            $gstPercent = $row['gst_percent'];
        @endphp
    @endforeach
    @for($i = 0; $i < 13-$list->count(); $i++)
        <tr class="">
            <td height="26px" class="border-r text-md v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-md v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-md v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-md v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-md v-align-t p-1 center">&nbsp;</td>
        </tr>
    @endfor
</table>
<table class="border-b border-l border-r">
    <tr class="text-md lh-0">
        <td class="">
            <p>Tot. Taxable Amt</p>
            @if($obj->sales_type=='1')
                <p>CGST&nbsp;@&nbsp;{{$gstPercent}}%</p>
            @else
                <p>IGST&nbsp;@&nbsp;{{$gstPercent}}%</p>
            @endif
        </td>
        <td class="font-bold">
            <p>: {{number_format($obj->total_taxable,2,'.','')}}</p>
            @if($obj->sales_type=='1')
                <p>: {{number_format($obj->total_gst/2,2,'.','')}}</p>
            @else
                <p>: {{number_format($obj->total_gst,2,'.','')}}</p>
            @endif
        </td>
        <td>
            <p>Other Amt</p>
            @if($obj->sales_type=='1')
                <p>SGST&nbsp;@&nbsp;{{$gstPercent}}%</p>
            @endif
        </td>
        <td class="font-bold">
            <p>: {{ number_format($obj->additional,2,'.','') }}</p>
            @if($obj->sales_type=='1')
                <p>: {{number_format($obj->grand_total,2,'.','')}}</p>
            @endif
        </td>
        <td>
            <p>Total Inv Amt</p>
            <p>&nbsp;</p>
        </td>
        <td class="font-bold">
            <p>: {{number_format($obj->grand_total,2,'.','')}}</p>
            <p>&nbsp;</p>
        </td>
    </tr>
</table>
<table class="border-l border-r">
    <tr class="bg-gray center font-bold text-md p-1 v-align-c">
        <td colspan="4" class="left p-5">4. Transportation Details</td>
    </tr>
    <tr class="text-md lh-0">
        <td>
            <p>Transporter ID</p>
            <p>Name</p>
        </td>
        <td class="font-bold">
            <p>: {{$obj->transport_id}}</p>
            <p>: {{$obj->transport_name}}</p>
        </td>
        <td>
            <p>Doc No</p>
            <p>Date</p>
        </td>
        <td class="font-bold">
            <p>: {{$obj->transport_no}}</p>
            <p>: {{ $eWay->ewbdt }}</p>
        </td>
    </tr>
</table>
<table class="border-l border-r border-b">
    <tr class="bg-gray center font-bold text-md p-1 v-align-c">
        <td colspan="6" class="left p-5">5. Vehicle Details</td>
    </tr>
    <tr class="text-md ">
        <td height="20px">Vehicle No</td>
        <td>: {{ $obj->Vehno }}</td>
        <td>From</td>
        <td>: {{$cmp->get('city_name')}}</td>
        <td>CEWB No</td>
        <td>: &nbsp;</td>
    </tr>
</table>
</body>
</html>
