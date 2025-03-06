<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gst Report</title>
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

        .p-2 {
            padding: 2px;
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

        .px-2 {
            padding: 0 2px;
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

        .py-2 {
            padding: 2px 0;
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
<body class="bg-white-100 p-5">
<!------Top Company Area------------------------------------------------------------------------------------------>
<table class="border w-full">
    <tr>
        <td width="35%" class="right">
            @if($cmp->get('logo')!='no_image')
                <img src="{{ public_path('/storage/images/'.$cmp->get('logo'))}}" alt="company logo" width="130px"/>
            @else
                <img src="{{ public_path('images/sk-logo.jpeg') }}" alt="" width="130px">
            @endif
        </td>
        <td width="65%" class="lh-0 left">
            <div class=" lh-1 font-bold times text-4xl">{{$cmp->get('company_name')}}</div>
            <div class="lh-2 text-md v-align-b">
                <div class="times">{{$cmp->get('address_1')}}</div>
                <div class="times">{{$cmp->get('address_2')}}, {{$cmp->get('city')}}</div>
                <div class="times">{{$cmp->get('contact')}} - {{$cmp->get('email')}}</div>
                <div class="times">{{$cmp->get('gstin')}}</div>
            </div>
        </td>
    </tr>
</table>

<?php
$invoiceTotal = 0;
$sales_gstTotal = 0;
$purchase_gstTotal = 0;
$purchaseTotal = 0
?>
<table class="border border-t-none">
    <tr class="bg-gray text-sm lh-2 border-b">
        <th  class="center py-5 border-r" colspan="6">Sales</th>
        <th  class="center py-5" colspan="6">Purchase</th>
    </tr>
    <tr class="bg-gray text-sm lh-2 border-b">
        <th width="5%" class="border-r py-5">S.No</th>
        <th width="12%" class="border-r">Party Name</th>
        <th width="12%" class="border-r">Bill No</th>
        <th width="12%" class="border-r">Date</th>
        <th width="12%" class="border-r">Invoice Amount</th>
        <th width="12%" class="border-r">Receipt Amount</th>
        <th width="5%" class="border-r py-5">S.No</th>
        <th width="12%" class="border-r">Party Name</th>
        <th width="12%" class="border-r">Bill No</th>
        <th width="12%" class="border-r">Date</th>
        <th width="12%" class="border-r">Invoice Amount</th>
        <th width="12%" class="border-r">Receipt Amount</th>
    </tr>
    @foreach($sales as $index=>$row)
            <?php
            $invoiceTotal += $row->grand_total;
            $sales_gstTotal += $row->total_gst;
            ?>
        <tr class="text-sm center v-align-c border">
            <td height="26px" class="center border-r">{{$index+1}}</td>
            <td class="center border-r ">{{$row->contact->vname}}</td>
            <td class="center border-r ">{{$row->invoice_no}}</td>
            <td class="right border-r px-2">{{ date('d-m-Y', strtotime( $row->invoice_date))}}</td>
            <td class="right border-r px-2">{{$row->grand_total}}</td>
            <td class="right border-r px-2">{{$row->total_gst}}</td>

        </tr>

    @endforeach

</table>

<div class="grid grid-cols-2 gap-3">
    <table class="w-full border-b  border-gray-300">
        @foreach($sales as $index=>$row)
                <?php
                $invoiceTotal += $row->grand_total;
                $sales_gstTotal += $row->total_gst;
                ?>

            <tr class="text-[9px] border-b border-r border-gray-300 self-start ">
                <td class="py-2 text-center border-l border-r border-gray-300">{{$index+1}}</td>
                <td class="py-2 text-start px-0.5 border-r border-gray-300">{{$row->contact->vname}}</td>
                <td class="py-2 text-center px-0.5 border-r border-gray-300">{{$row->invoice_no}}</td>
                <td class="py-2 text-end px-0.5 border-r border-gray-300"> {{ date('d-m-Y', strtotime( $row->invoice_date))}}</td>
                <td class="py-2 text-end px-1 border-r border-gray-300">{{$row->grand_total}}</td>
                <td class="py-2 text-center px-1 border-r border-gray-300">{{$row->total_gst}}</td>
            </tr>
        @endforeach
        <tr class="text-[10px] border-b border-r border-gray-300 self-start font-semibold">
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="2">Total Sales</td>
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="2">{{\App\Helper\ConvertTo::rupeesFormat($invoiceTotal)}}</td>
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="2">{{\App\Helper\ConvertTo::rupeesFormat($sales_gstTotal)}}</td>
        </tr>
        <tr class="text-[10px] border-b border-r border-gray-300 self-start font-semibold">
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="3">Difference (Sales-Purchase)</td>
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="3">{{\App\Helper\ConvertTo::rupeesFormat($invoiceTotal-$purchaseTotal)}}</td>

        </tr>
        </tbody>
        <tbody>

        </tbody>
    </table>
    <table class="w-full border-b border-gray-300">
        <thead class="font-semibold text-[10px] bg-gray-50">
        <tr class="py-2 border-b border-l border-r border-gray-300 tracking-wider">
            <th class="py-2 text-center  " colspan="6">Purchase Report</th>
        </tr>
        <tr class="py-2 border-b border-r border-gray-300 tracking-wider">
            <th class="py-2 w-[3%] px-1 border-r border-l border-gray-300 text-center">S.No</th>
            <th class="py-2 border-r border-gray-300">Party Name</th>
            <th class="py-2  w-[10%] border-r border-gray-300">Bill No</th>
            <th class="py-2 w-[15%] border-r px-1 border-gray-300">Date</th>
            <th class="py-2 w-[15%] border-r border-gray-300">Invoice Amount</th>
            <th class="py-2 w-[12%] border-r border-gray-300">Receipt Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach($purchase as $index=>$row)
                <?php
                $purchaseTotal += $row->grand_total;
                $purchase_gstTotal += $row->total_gst;
                ?>

            <tr class="text-[9px] border-b border-r border-gray-300 self-start ">
                <td class="py-2 text-center border-l border-r border-gray-300">{{$index+1}}</td>
                <td class="py-2 text-start px-0.5 border-r border-gray-300">{{$row->contact->vname}}</td>
                <td class="py-2 text-center px-0.5 border-r border-gray-300">{{$row->purchase_no}}</td>
                <td class="py-2 text-end px-0.5 border-r border-gray-300"> {{ date('d-m-Y', strtotime( $row->invoice_date))}}</td>
                <td class="py-2 text-end px-0.5 border-r border-gray-300">{{$row->grand_total}}</td>
                <td class="py-2 text-end px-0.5 border-r border-gray-300">{{$row->total_gst}}</td>
            </tr>
        @endforeach
        <tr class="text-[10px] border-b border-r border-gray-300 self-start font-semibold">
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="2">Total Purchase</td>
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="2">{{\App\Helper\ConvertTo::rupeesFormat($purchaseTotal)}}</td>
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="2">{{\App\Helper\ConvertTo::rupeesFormat($purchase_gstTotal)}}</td>
        </tr>
        <tr class="text-[10px] border-b border-r border-gray-300 self-start font-semibold">
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="3">GST (Sales-Purchase)</td>
            <td class="py-2 text-center border-l border-r border-gray-300" colspan="3">{{\App\Helper\ConvertTo::rupeesFormat($sales_gstTotal-$purchase_gstTotal)}}</td>
        </tr>
        </tbody>
    </table>
</div>

@pageBreak
</body>
</html>
