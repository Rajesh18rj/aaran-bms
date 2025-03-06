<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction</title>
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

<body class="bg-white-100 p-10">
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

{{--    <tr class="border-t ">--}}
{{--        <td colspan="3" class="text-md lh-0 px-10 ">--}}
{{--            <p class="font-bold text-lg">M/s.{{$contact->vname}}</p>--}}
{{--            <p class="times">{{$billing_address->get('address_1')}}</p>--}}
{{--            <p class="times">{{$billing_address->get('address_2')}}</p>--}}
{{--            <p class="times">{{$billing_address->get('address_3')}}</p>--}}
{{--            <p class="times">GST IN : {{$contact->gstin}}</p>--}}
{{--        </td>--}}
{{--    </tr>--}}
</table>
<table class="border-r border-l border-b">
    <tr class="border-b">
        <th class="text-lg py-2">{{$trans_name }} - Account Statement</th>
    </tr>
    <tr>
        <td class="text-sm p-2 right">
            <p>From: {{$start_date}} To: {{$end_date}}</p>
        </td>
    </tr>
</table>
<table class="border border-t-none">
    <tr class="bg-gray text-sm lh-2 border-b">
        <th width="5%" class="border-r py-5">VCH No</th>
        <th width="12%" class="border-r">Date</th>
        <th width="auto" class="border-r">Contact</th>
        <th width="12%" class="border-r">Type</th>
        <th width="12%" class="border-r">Credit</th>
        <th width="12%" class="border-r">Debit</th>
        <th width="12%" class="border-r">Balance</th>
    </tr>
    <tr class="text-sm center v-align-c border-b">
{{--        @if($byParty !=null)--}}

            <td height="26px" class="center border-r" colspan="4">Opening Balance</td>
            <td class="right border-r ">{{ $opening_balance}}</td>
            <td class="right border-r ">&nbsp;</td>
            <td class="right border-r px-2">{{$opening_balance}}</td>
{{--        @endif--}}
    </tr>
    @php
        $current_balance = $opening_balance; // Initialize current balance with opening balance
        $total_credit = 0 + $opening_balance; // Initialize total credit
        $total_debit = 0; // Initialize total debit
    @endphp
    @foreach($transaction as $index => $row)
        <tr class="text-sm center v-align-c">
            <td height="26px" class="center border-r">{{$index+1}}</td>
            <td class="center border-r ">{{ date('d-m-Y', strtotime($row->vdate)) }}</td>
            <td class="center border-r ">{{ $row->contact->vname }}</td>
            <td class="right border-r ">{{ \Aaran\Transaction\Models\Transaction::common($row->receipttype_id) }}</td>
            <td class="right border-r px-2">
                @if($row->mode_id == 110)
                {{$row->vname + 0 }}
                @php
                    $current_balance += ($row->vname + 0);
                    $total_credit += ($row->vname + 0);
                @endphp
                @else
                    &nbsp; <!-- Empty space for non-credit rows -->
                @endif
            </td>
            <td class="right border-r px-2">
                @if($row->mode_id == 111) <!-- Debit -->
                {{$row->vname + 0}}
                @php
                    $current_balance -= ($row->vname + 0); // Update balance for debit
                    $total_debit += ($row->vname + 0); // Accumulate total debit
                @endphp
                @else
                    &nbsp; <!-- Empty space for non-debit rows -->
                @endif
            </td>
            <td class="right border-r px-2">{{ $current_balance }}</td>
        </tr>
    @endforeach
    <tr class="text-sm border-t center v-align-c">
        <td height="26px" class="center border-r" colspan="4">TOTALS</td>
        <td class="right border-r ">{{ $total_credit }}</td>
        <td class="right border-r ">{{ $total_debit }}</td>
        <td class="right border-r ">{{ $current_balance }}</td>
    </tr>
</table>
</body>
</html>

