<html lang="en">

<head>
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white-100 p-10">
<div class="bg-white border-2 h-full border-gray-400">
    <!------Top Company Area------------------------------------------------------------------------------------------>
        <div class="flex flex-row  justify-evenly p-2">
            <div class="flex justify-center items-center">
                <img src="{{ public_path('/storage/images/'.$cmp->get('logo'))}}" alt="company logo" class="w-[180px]"/>
            </div>
            <div class="w-full flex flex-col items-center justify-center">
                <h1 class="text-2xl font-bold tracking-wider  uppercase">{{$cmp->get('company_name')}}</h1>
                <p class="text-xs">{{$cmp->get('address_1')}},{{$cmp->get('address_2')}}, {{$cmp->get('city')}}</p>
                <p class="text-xs">{{$cmp->get('contact')}} - {{$cmp->get('email')}}</p>
                <p class="text-xs">{{$cmp->get('gstin')}}</p>
            </div>
            @if($irn)
            <div>
                <img class="w-[200px]" src="{{\App\Helper\qrcoder::generate($irn->signed_qrcode,22)}}" alt="{{$irn->signed_qrcode}}">
            </div>
            @endif
        </div>

    <!------Invoice Header Area--------------------------------------------------------------------------------------->
    <div class="w-full bg-slate-500 flex">
        <div class="w-10/12 text-white text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TAX INVOICE</div>
        <div class="w-2/12 text-white text-right ">Original Copy</div>
    </div>

    <!------Contact and invoice details--------------------------------------------------------------------------------------->
        <div class="flex mt-2">
            <div>
                <span>M/s.{{$obj->contact_name}}</span>
                <p>{{$billing_address->get('address_1')}}</p>
                <p>{{$billing_address->get('address_2')}}</p>
                <p>{{$billing_address->get('address_3')}}</p>
                <p>{{$billing_address->get('gstcell')}}</p>
            </div>
            <div>
                <p>Invoice No:&nbsp;&nbsp;{{$obj->invoice_no}}</p>
                <p>Date:&nbsp;&nbsp;{{$obj->invoice_date ?date('d-m-Y', strtotime($obj->invoice_date)):''}}</p>
                <p>PO No:&nbsp;&nbsp;{{ $obj->despatch_name }}</p>
                <p>PO Date:&nbsp;&nbsp;{{ $obj->despatch_date }}</p>
            </div>
        </div>

        <div class="mt-6">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Item</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                    <th class="border border-gray-300 px-4 py-2 text-right">Unit Price</th>
                    <th class="border border-gray-300 px-4 py-2 text-right">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2 text-right">Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Product 1</td>
                    <td class="border border-gray-300 px-4 py-2">Description of Product 1</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">$10.00</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">2</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">$20.00</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Product 2</td>
                    <td class="border border-gray-300 px-4 py-2">Description of Product 2</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">$15.00</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">1</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">$15.00</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-bold">Subtotal</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">$35.00</td>
                </tr>
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-bold">Tax (10%)</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">$3.50</td>
                </tr>
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-bold">Total</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">$38.50</td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-6">
            <p class="text-gray-600">Thank you for your business!</p>
        </div>
</div>

</body>
</html>
