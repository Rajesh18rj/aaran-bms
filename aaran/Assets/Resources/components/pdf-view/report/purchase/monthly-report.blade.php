<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Report</title>
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
<body>
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
    $taxableValueTotal = 0;
    $gstTotal = 0;
    $CGSTTotal = 0;
    ?>
    <table class="border border-t-none">
        <tr class="bg-gray text-sm lh-2 border-b">
            <th width="3%" class="border-r py-5">S.No</th>
            <th width="10%" class="border-r">GSTIN NO</th>
            <th width="auto" class="border-r">Party Name</th>
            <th width="5%" class="border-r">Bill No</th>
            <th width="7%" class="border-r">Date</th>
            <th width="7%" class="border-r">Invoice Amount</th>
            <th width="7%" class="border-r">Taxable Amount</th>
            <th width="5%" class="border-r">CGST %</th>
            <th width="6%" class="border-r">CGST TAX</th>
            <th width="5%" class="border-r">SGST %</th>
            <th width="6%" class="border-r">SGST TAX</th>
            <th width="5%" class="border-r">IGST %</th>
            <th width="6%" class="border-r">IGST TAX</th>
        </tr>
        <!-- Table Body ------------------------------------------------------------------------------------------->
        @foreach($list as $index=>$row)
                <?php
                $invoiceTotal += $row->grand_total;
                $taxableValueTotal += $row->total_taxable;
                $gstTotal += $row->sales_type == '1' ? $row->total_gst : 0;
                $CGSTTotal += $row->sales_type != '1' ? $row->total_gst : 0;
                ?>

            <tr class="text-sm center v-align-c border-b">
                <td height="26px" class="center border-r">{{$index+1}}</td>
                <td class="center border-r">{{$row->contact->gstin}}</td>
                <td class="center border-r">{{$row->contact->vname}}</td>
                <td class="center border-r">{{$row->Entry_no}}</td>
                <td class="center border-r"> {{ date('d-m-Y', strtotime( $row->purchase_date))}}</td>
                <td class="right border-r">{{$row->grand_total}}</td>
                <td class="right border-r">{{$row->total_taxable}}</td>
                <td class="right border-r">{{$row->sales_type=='1'?\App\Http\Controllers\Report\Purchase\MonthlyReportController::getPercent($row->id,$row->sales_type):0}}</td>
                <td class="right border-r">{{$row->sales_type=='1'?$row->total_gst/2:0}}</td>
                <td class="right border-r">{{$row->sales_type=='1'?\App\Http\Controllers\Report\Purchase\MonthlyReportController::getPercent($row->id,$row->sales_type):0}}</td>
                <td class="right border-r">{{$row->sales_type=='1'?$row->total_gst/2:0}}</td>
                <td class="right border-r">{{$row->sales_type!='1'?\App\Http\Controllers\Report\Purchase\MonthlyReportController::getPercent($row->id,$row->sales_type):0}}</td>
                <td class="right border-r">{{$row->sales_type!='1'?$row->total_gst:0}}</td>
            </tr>
        @endforeach
        <tr class="text-sm border-t right v-align-c">
            <td height="26px" class="center border-r" colspan="3">Total</td>
            <td class="right border-r "></td>
            <td class="right border-r "></td>
            <td class="right border-r ">{{number_format($invoiceTotal,2,'.','')}}</td>
            <td class="right border-r ">{{number_format($taxableValueTotal,2,'.','')}}</td>
            <td class="right border-r "></td>
            <td class="right border-r ">{{number_format($gstTotal/2,2,'.','')}}</td>
            <td class="right border-r "></td>
            <td class="right border-r">{{number_format($gstTotal/2,2,'.','')}}</td>
            <td class="right border-r"></td>
            <td class="right border-r">{{number_format($CGSTTotal,2,'.','')}}</td>
        </tr>
    </table>
</body>
</html>
