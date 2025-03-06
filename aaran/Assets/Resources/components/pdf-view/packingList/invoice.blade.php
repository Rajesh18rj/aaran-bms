<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Packing List</title>
        <link rel="stylesheet" href="/public/invoice.css" type="text/css">
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
<div class="w-full text-xs right py-5">Original Copy</div>
<table class="border ">
    <tr class="bg-gray center font-bold text-md">
        <td class="center py-5" colspan="3">PACKING LIST</td>
    </tr>
    <tr class="v-align-t border-t">
        <td class="lh-0 text-md  px-5 border-r">
            <p class="font-bold">Exporter</p>
            <p>{{$cmp->get('company_name')}}</p>
            <p>{{$cmp->get('address_1')}}</p>
            <p>{{$cmp->get('address_2')}}, </p>
            <p>{{$cmp->get('city')}}</p>
            <p>{{$cmp->get('contact')}}</p>
        </td>
        <td class="lh-0 text-md  px-5 border-r">
            <p class="font-bold">consignee</p>
            <p>{{$obj->contact_name}}</p>
            <p>{{$consignee_address->get('address_1')}}</p>
            <p>{{$consignee_address->get('address_2')}}</p>
            <p>{{$consignee_address->get('address_3')}}</p>
        </td>
        <td class="lh-1 text-md  px-5 border-r font-bold">
            <p>Invoice No: {{$obj->invoice_no}}</p>
            <p>Invoice Date: {{$obj->invoice_date ?date('d-m-Y', strtotime($obj->invoice_date)):''}}</p>
            <p>Buyers Order No: </p>
            <p>Date:</p>
        </td>
    </tr>
    <tr class="border">
        <td class="py-10" colspan="3"></td>
    </tr>
</table>
<?php
    $totalQty=0;
    $totalCtns=0;
    $totalNetWt=0;
    $totalGrsWt=0;
    ?>
<table class="border border-t-none">

    <tr class="text-sm font-bold lh-1 v-align-c">
        <th width="5%" class=" border-r">CTN BOX</th>
        <th width="" class="py-5 border-r" rowspan="2">ITEM IN CTN</th>
        <th width="5%" class="py-5 border-r" rowspan="2">SIZE</th>
        <th width="7%" class="border-r">QTY/CTN</th>
        <th width="7%" class="border-r">NO.OF</th>
        <th width="7%" class="border-r">TOTAL QTY</th>
        <th width="5%" class="border-r">NET WT/</th>
        <th width="5%" class="border-r">GRS WT/</th>
        <th width="8%" class="border-r">TOTAL </th>
        <th width="8%" class="border-r">TOTAL</th>
        <th width="10%" class="border-r">CTN DIMENSION</th>
        <th width="5%" class="py-5 border-r" rowspan="2">CBM</th>
    </tr>
    <tr class="text-sm font-bold lh-1 ">
        <th class=" border-r">NOS</th>
        <th class="py-5 border-r">IN PCS</th>
        <th class="border-r">CRTNS</th>
        <th class="border-r">IN PCS</th>
        <th class="border-r">CARTON</th>
        <th class="border-r">CARTON</th>
        <th class="border-r">NET WT</th>
        <th class="border-r">GRS WT</th>
        <th class="border-r">IN INCHES</th>
    </tr>
    @foreach($packingList as $index => $row)
        <tr class="text-md border-b border-t">
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$row['nos']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$list[$row['exportSalesItem_index']]['product_name']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$list[$row['exportSalesItem_index']]['size_name']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$list[$row['exportSalesItem_index']]['qty']/$list[$row['exportSalesItem_index']]['no_of_count']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$list[$row['exportSalesItem_index']]['no_of_count']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$list[$row['exportSalesItem_index']]['qty']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$row['net_wt']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$row['grs_wt']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$row['net_wt']*$list[$row['exportSalesItem_index']]['no_of_count']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$row['grs_wt']*$list[$row['exportSalesItem_index']]['no_of_count']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$row['dimension']}}</td>
            <td height="38px" class="border-r text-sm v-align-t p-1 center">{{$row['cbm']}}</td>
        </tr>
        <?php
            $totalQty+=$list[$row['exportSalesItem_index']]['qty'];
            $totalCtns+=$list[$row['exportSalesItem_index']]['no_of_count'];
            $totalGrsWt+=$row['grs_wt']*$list[$row['exportSalesItem_index']]['no_of_count'];
            $totalNetWt+=$row['net_wt']*$list[$row['exportSalesItem_index']]['no_of_count'];
            ?>
    @endforeach
    @for($i = 0; $i < 9-$list->count(); $i++)
        <tr class="border-b">
            <td height="38px" class="border-r text-sm v-align-t p-1 center">&nbsp;</td>
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
            <td class="border-r text-sm p-1 center">&nbsp;</td>
        </tr>
    @endfor
    <tr class="border text-md">
        <td height="20px" class="py-1">&nbsp;</td>
        <td class="py-1">&nbsp;</td>
        <td class="py-1">&nbsp;</td>
        <td class="right px-5">Total</td>
        <td class="center border py-1">{{$totalCtns}}</td>
        <td class="center border py-1">{{$totalQty}}</td>
        <td class="py-1">&nbsp;</td>
        <td class="py-1">&nbsp;</td>
        <td class="center border py-1">{{$totalNetWt}}</td>
        <td class="center border py-1">{{$totalGrsWt}}</td>
        <td class="py-1">&nbsp;</td>
        <td class="py-1">&nbsp;</td>
    </tr>
    <tr class="border lh-0">
        <td height="80px" colspan="8" class=""></td>
        <td colspan="4" class="border-l v-align-b center text-md p-5">
            signature
        </td>
    </tr>
</table>
</body>
</html>
