<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export</title>
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
            background-color: #F9FAFB;
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

        .uppercase {
            text-transform: uppercase;
        }

        .lowercase {
            text-transform: lowercase;
        }
    </style>
</head>

<body>
<div class="w-full text-xs right p-1">Original Copy</div>
<table class="border ">
    <tr class="bg-gray center font-bold text-md">
        <td class="center " colspan="3">TAX INVOICE</td>
    </tr>
    <tr>
        <td width="40%" class="lh-0 text-xs border px-5" rowspan="2">
            <p class="font-bold">Exporter</p>
            <p>{{$cmp->get('company_name')}}</p>
            <p>{{$cmp->get('address_1')}}</p>
            <p>{{$cmp->get('address_2')}}, </p>
            <p>{{$cmp->get('city')}}</p>
            <p>{{$cmp->get('contact')}}</p>
        </td>
        <td class="lh-0 text-xs border px-5">
            <p>Invoice No: {{$obj->invoice_no}}</p>
            <p>Date: {{$obj->invoice_date ?date('d-m-Y', strtotime($obj->invoice_date)):''}}</p>
            <p>&nbsp;</p>
        </td>
        <td class="lh-0  text-xs border px-5">
            <p>Exporter' Ref</p>
            <p>IEC NO: AEUFS45TED</p>
            <p>{{$cmp->get('gstin')}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-xs lh-0 v-align-t border px-5" colspan="2">
            <p>Buyer's style:</p>
            <p>{{$obj->style_name}}</p>
        </td>
    </tr>
</table>
<table class="border border-t-none">
    <tr class=" text-xs v-align-t">
        <td width="40%" class="lh-0 text-xs  px-5">
            <p class="font-bold">consignee</p>
            <p>{{$obj->contact_name}}</p>
            <p>{{$consignee_address->get('address_1')}}</p>
            <p>{{$consignee_address->get('address_2')}}</p>
            <p>{{$consignee_address->get('address_3')}}</p>
        </td>
        <td class="lh-0 text-xs  px-5 border-l">
            <p>Buyer (if other than consignee)</p>
            @foreach($consignees as  $index=>$row)
                <p>{{$row['contact_name']}}</p>
                <p>{{$row['address_1']}},{{$row['address_2']}},{{$row['city_name']}},{{$row['state_name']}}
                    ,{{$row['pincode_name']}},{{$row['country_name']}}.</p>
            @endforeach
        </td>
    </tr>
</table>
<table class="border border-t-none lh-2 ">
    <tr class="text-xs ">
        <td width="20%" class="border-r px-5">Pre - Carriage by</td>
        <td width="20%" class="border-r px-5">Place of Receipt by</td>
        <td width="20%" class="border-r px-5">Country of Origin Goods</td>
        <td width="20%" class=" px-5">Country of final destination</td>
    </tr>
    <tr class="text-xs border-l ">
        <td width="20%" class="border-r border-b px-5">{{$obj->pre_carriage}}</td>
        <td width="20%" class="border-r border-b px-5">{{$obj->place_of_Receipt}}</td>
        <td width="20%" class="border-r px-5">INDIA</td>
        <td width="20%" class="border- px-5">{{$consignee_address->get('country')}}</td>
    </tr>
    <tr class="text-xs">
        <td width="20%" class="border-r px-5">Vessel/Flight No</td>
        <td width="20%" class="border-r px-5">Port of Loading</td>
        <td width="20%" class="border-t px-5" colspan="2">Terms of Delivery and Payment</td>
    </tr>
    <tr class="text-xs border-l ">
        <td width="20%" class="border-r border-b px-5">{{$obj->vessel_flight_no}}</td>
        <td width="20%" class="border-r border-b px-5">{{$obj->port_of_discharge}}</td>
        <td width="20%" class=" px-5" colspan="2">&nbsp;</td>
    </tr>
    <tr class="text-xs ">
        <td width="20%" class="border-r px-5">Port of Discharge</td>
        <td width="20%" class="border-r px-5">Final destination</td>
        <td width="20%" class="px-5" colspan="2">C&F BY SEA</td>
    </tr>
    <tr class="text-xs border-l ">
        <td width="20%" class="border-r px-5">{{$obj->port_of_discharge}}</td>
        <td width="20%" class="border-r px-5">{{$obj->final_destination}}</td>
        <td width="20%" class=" px-5" colspan="2">&nbsp;</td>
    </tr>
</table>
<table class="border border-t-none text-xs">
    <tr class=" font-bold lh-1 bg-gray">
        <th width="5%" class="center border-r" rowspan="2">S.No</th>
        <th width="10%" class="center border-r">Marks & Nos.</th>
        <th width="10%" class="center border-r" rowspan="2">No. & Kinds of Pkgs</th>
        <th class="center border-r" rowspan="2">Description of Goods</th>
        <th width="10%" class="center border-r">Qty</th>
        <th width="10%" class="center border-r">C & F Rate</th>
        <th width="10%" class="center border-r">Amount</th>
    </tr>
    <tr class="text-xs font-bold lh-1 border-b bg-gray">
        <th class="cnetr border-r">Container No.</th>
        <th class="center border-r">PCS</th>
        <th class="center border-r">IN USD</th>
        <th class="center">C&F in usd</th>
    </tr>
    @php
        $gstPercent = 0;
        $totalAmount = 0;
    @endphp

    @foreach($list as $index => $row)
        <tr class="text-sm center v-align-t ">
            <td height="38px" class="center border-r p-1">{{$index + 1}}</td>
            <td class="center border-r p-1">{{\Aaran\Assets\Enums\PackageType::tryFrom($row['pkgs_type'])->getName()}}</td>
            <td class="center border-r p-1">{{$row['no_of_count']}} </td>
            <td class="left border-r p-1">
                @if($row['description'])
                    {{$row['product_name'].' - '.$row['description']}}
                @else
                    {{$row['product_name']}}
                @endif</td>
            <td class="center border-r p-1">{{$row['qty']+0}}</td>
            <td class="right border-r p-1">$&nbsp;{{number_format($row['price'],2,'.','')}}</td>
            <td class="right border-r p-1 ">$&nbsp;{{number_format($row['qty']*$row['price'],2,'.','')}}</td>
        </tr>
        @php
            $gstPercent = $row['gst_percent'];

        @endphp
    @endforeach
    {{-- Spacing  --}}
    @for($i = 0; $i < 12-$list->count(); $i++)
        <tr class="">
            <td height="38px" class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
            <td class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
        </tr>
    @endfor
    @php
        $totalNetWt=0;
        $totalGrsWt=0;
    @endphp

    @foreach($packingList as $index => $row)
        @php
            $totalGrsWt+=$row['grs_wt']*$list[$row['exportSalesItem_index']]['no_of_count'];
               $totalNetWt+=$row['net_wt']*$list[$row['exportSalesItem_index']]['no_of_count'];
        @endphp
    @endforeach
    <tr class="border">
        <td colspan="2" class="px-5">Total Net Weight</td>
        <td class="center">{{$totalNetWt}}</td>
        <td class="border-l right px-5 " rowspan="2">Total</td>
        <td rowspan="2" class="border-l right p-1 ">{{$obj->total_qty+0}}</td>
        <td rowspan="2" class="border-l right p-1 "></td>
        <td rowspan="2" class="border-l right p-1 ">$&nbsp;{{number_format($obj->total_taxable,2,'.','')}}</td>
        {{--        <td rowspan="2" class="border-l right p-1 ">{{number_format($obj->grand_total-$obj->additional,2,'.','')}}</td>--}}
    </tr>



    <tr class="border">
        <td colspan="2" class="px-5">Total Net Weight</td>
        <td class="center">{{$totalGrsWt}}</td>
    </tr>
    <tr>
        <td colspan="7" class="font-bold border-b p-5 uppercase">Amount
            Chargeable: {{$currency}} {{\Aaran\Assets\Enums\CurrencyType::tryFrom($obj->currency_type)->getCurrency()}} only
        </td>
    </tr>
    <tr class="center border-b ">
        <th width="5%" class="p-5 border-r">S.NO</th>
        <th class=" border-r">INVOICE USD</th>
        <th class=" border-r">EX RATE</th>
        <th class=" border-r" colspan="2">INVOICE VALUE IN INR</th>
        <th class=" border-r">IGST %</th>
        <th class=" border-r">IGST INR</th>
    </tr>
    <tr class="">
        <td class="p-5 center border-r">1-2</td>
        <td class="center border-r">{{number_format($obj->total_taxable,2,'.','')}}</td>
        <td class="center border-r">{{number_format($obj->ex_rate,2,'.','')}}</td>
        <td class=" border-r" colspan="2" class="center">{{number_format($obj->grand_total,2,'.','')}}</td>
        <td class="center border-r">{{$gstPercent}}</td>
        <td class="center">{{number_format($obj->total_gst,2,'.','')}}</td>
    </tr>
    <tr>
        <td colspan="7" class="font-bold border-b p-5 border-t uppercase">IGST RS: {{$rupees}} only</td>
    </tr>
    <tr>
        <td class="border-b font-bold bg-gray border p-5" colspan="7">SUPPLY MEANT FOR EXPORT ON PAYMENT OF INTEGRATED
            TAX (IGST)
        </td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
        <td colspan="3" class="border-l px-5 ">Signature & Date</td>
    </tr>
    <tr>
        <td colspan="4" class="p-10">&nbsp;</td>
        <td colspan="3" class="border-l ">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4" class="px-5">Declaration:</td>
        <td colspan="3" class="border-l px-5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4" class="px-5">We declare that this invoice shows the actual price of the goods</td>
        <td colspan="3" class="border-l px-5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4" class="px-5">described & that all particulars are true & correct.</td>
        <td colspan="3" class="border-l px-5">&nbsp;</td>
    </tr>
</table>
</body>
</html>
