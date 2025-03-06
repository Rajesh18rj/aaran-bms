<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthly Summary</title>
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
<body class="">
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
$totalSales = 0;
?>

<table class="border border-t-none w-full">
    <tr class="bg-gray text-sm lh-2 border-b">
        <th class="border-r py-5">Month</th>
        <th width="15%" class="border-r py-5">Total sales</th>
    </tr>
    @foreach(\App\Helper\Months::months() as $index=>$row)
        <tr class="text-sm center v-align-c border-b ">
            <td height="26px" class="center border-r ">{{$row}}</td>
            <td class="right border-r px-2">{{\App\Http\Controllers\Report\Sales\SummaryController::monthlySales($index+1,$year)}}</td>
        </tr>
            <?php
            $totalSales += \App\Http\Controllers\Report\Sales\SummaryController::monthlySales($index + 1, $year)
            ?>
    @endforeach
    <tr class="text-sm center v-align-c font-bold">
        <td height="26px" class="center border-r " >TOTAL</td>
        <td class="right px-2 border-r ">{{number_format($totalSales,2,'.','')}}</td>
    </tr>
</table>

</body>
</html>

