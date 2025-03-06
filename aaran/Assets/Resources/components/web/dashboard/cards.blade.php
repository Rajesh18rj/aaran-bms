@props([
'transactions' => [],
])
<div class="sm:w-5/12 h-auto grid sm:grid-cols-2 grid-col-1 gap-5 font-lex">
    {{-- Purchase --}}
    <div class="bg-white rounded-md border-t-2 border-[#845ADF] flex flex-col justify-evenly hover:shadow-md">
        <div class="flex flex-row justify-between items-center pt-5 px-5">
            <div class="space-y-2">
                <div class="text-md font-semibold">Purchase</div>
                <div class="sm:text-2xl text-md text-[#845ADF] font-semibold">
{{--                    {{$transactions['total_purchase']}}--}}
                    234
                </div>
            </div>
            <div class="w-16 h-16">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 505 505" xml:space="preserve" class="">
                    <circle style="fill:#845ADF;" cx="252.5" cy="252.5" r="252.5" />
                    <path style="fill:#FFD05B;" d="M410.5,114.6h-316c-2.2,0-4,1.8-4,4v74.7c0,2.2,1.8,4,4,4h316c2.2,0,4-1.8,4-4v-74.7
                            C414.5,116.4,412.7,114.6,410.5,114.6z" />
                    <rect x="108.8" y="135" style="fill:#324A5E;" width="287.5" height="42" />
                    <polygon style="fill:#EDF2F2;" points="161.4,389.9 162.5,389.9 174.9,377.5 187.3,389.9 188.4,389.9 200.7,377.5 213.1,389.9
                            214.2,389.9 226.6,377.5 239,389.9 240.1,389.9 252.5,377.5 264.9,389.9 266,389.9 278.4,377.5 290.8,389.9 291.9,389.9
                            304.3,377.5 316.6,389.9 317.7,389.9 330.1,377.5 342.5,389.9 343.6,389.9 356,377.5 365.3,386.7 365.3,156 139.7,156 139.7,386.7
                            149,377.5 " />
                    <g>
                        <rect x="177.1" y="213.4" style="fill:#845ADF;" width="150.9" height="14" />
                        <rect x="177.1" y="257" style="fill:#845ADF;" width="150.9" height="14" />
                        <rect x="177.1" y="300.5" style="fill:#845ADF;" width="90.6" height="14" />
                    </g>
                </svg>
            </div>
        </div>
        <div class="flex flex-row justify-between items-center pb-5 px-5">
            <div class="text-md font-semibold">
                <div class="text-gray-500">this month</div>
                <div class="text-[#845ADF]">
{{--                    {{$transactions['month_purchase']}}--}}
                    1212
                </div>

            </div>
            <div>
                <a href="{{route('purchase')}}" class="text-[#845ADF] text-sm hover:bg-[#efeafb] px-3 py-1 rounded-md font-semibold inline-flex items-center gap-x-2">
                    <span>
                        View All
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- ReceivablesReport --}}

    <div class="bg-white rounded-md border-t-2 border-[#F5B849] flex flex-col justify-evenly hover:shadow-md">


        <div class="flex flex-row justify-between items-center pt-5 px-5">
            <div class="space-y-2">
                <div class="text-md font-semibold">Receivables</div>
                <div class="sm:text-2xl text-md text-[#F5B849] font-semibold">
{{--                    {{$transactions['total_receivable']}}--}}
                    234
                </div>
            </div>
            <div class="w-20 h-20">
                <svg width="" heigh="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.8086 6.25047H20.1686C19.9786 5.98047 19.7786 5.73047 19.5686 5.48047L18.8086 6.25047Z" fill="#F5B849" />
                    <path d="M18.52 4.42031C18.27 4.21031 18.02 4.01031 17.75 3.82031V5.18031L18.52 4.42031Z" fill="#F5B849" />
                    <path d="M19.5795 5.48141L22.5295 2.53141C22.8195 2.24141 22.8195 1.76141 22.5295 1.47141C22.2395 1.18141 21.7595 1.18141 21.4695 1.47141L18.5195 4.42141C18.8995 4.75141 19.2495 5.11141 19.5795 5.48141Z" fill="#F5B849" />
                    <path d="M17.7517 3C17.7517 2.59 17.4117 2.25 17.0017 2.25C16.6017 2.25 16.2817 2.57 16.2617 2.96C16.7817 3.21 17.2817 3.49 17.7517 3.82V3Z" fill="#F5B849" />
                    <path d="M21.7519 7C21.7519 6.59 21.4119 6.25 21.0019 6.25H20.1719C20.5019 6.72 20.7919 7.22 21.0319 7.74C21.4319 7.72 21.7519 7.4 21.7519 7Z" fill="#F5B849" />
                    <path d="M12.75 14.7508H13.05C13.44 14.7508 13.75 14.4008 13.75 13.9708C13.75 13.4308 13.6 13.3508 13.26 13.2308L12.75 13.0508V14.7508Z" fill="#F5B849" />
                    <path d="M21.04 7.74C21.03 7.74 21.02 7.75 21 7.75H17C16.9 7.75 16.81 7.73 16.71 7.69C16.53 7.61 16.38 7.47 16.3 7.28C16.27 7.19 16.25 7.1 16.25 7V3C16.25 2.99 16.26 2.98 16.26 2.96C14.96 2.35 13.52 2 12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 10.48 21.65 9.04 21.04 7.74ZM13.75 11.82C14.39 12.04 15.25 12.51 15.25 13.98C15.25 15.23 14.26 16.26 13.05 16.26H12.75V16.51C12.75 16.92 12.41 17.26 12 17.26C11.59 17.26 11.25 16.92 11.25 16.51V16.26H11.17C9.84 16.26 8.75 15.14 8.75 13.76C8.75 13.34 9.09 13 9.5 13C9.91 13 10.25 13.34 10.25 13.75C10.25 14.3 10.66 14.75 11.17 14.75H11.25V12.53L10.25 12.18C9.61 11.96 8.75 11.49 8.75 10.02C8.75 8.77 9.74 7.74 10.95 7.74H11.25V7.5C11.25 7.09 11.59 6.75 12 6.75C12.41 6.75 12.75 7.09 12.75 7.5V7.75H12.83C14.16 7.75 15.25 8.87 15.25 10.25C15.25 10.66 14.91 11 14.5 11C14.09 11 13.75 10.66 13.75 10.25C13.75 9.7 13.34 9.25 12.83 9.25H12.75V11.47L13.75 11.82Z" fill="#F5B849" />
                    <path d="M10.25 10.03C10.25 10.57 10.4 10.65 10.74 10.77L11.25 10.95V9.25H10.95C10.57 9.25 10.25 9.6 10.25 10.03Z" fill="#F5B849" />
                </svg>
            </div>
        </div>
        <div class="flex flex-row justify-between items-center pb-5 px-5">
            <div class="text-md font-semibold">
                <div class="text-gray-500">this month</div>
                <div class="text-[#F5B849]">
{{--                    {{$transactions['month_receivable']}}--}}
                    234
                </div>
            </div>
            <div>
                <a
{{--                    href="{{route('receivables')}}"--}}
                   class="text-[#F5B849] text-sm hover:bg-[#fef6e7] px-3 py-1 rounded-md font-semibold inline-flex items-center gap-x-2">
                    <span>
                        View All
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- PayablesReport --}}

    <div class="bg-white rounded-md border-t-2 border-[#E6533C] flex flex-col justify-evenly hover:shadow-md">

        <div class="flex flex-row justify-between items-center pt-5 px-5">
            <div class="space-y-2">
                <div class="text-md font-semibold">Payables</div>
                <div class="sm:text-2xl text-md text-[#E6533C] font-semibold">
{{--                    {{$transactions['total_payable']}}--}}
                    2433
                </div>
            </div>
            <div class="w-16 h-16">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 451.296 451.296" xml:space="preserve">
                    <circle style="fill:#E6533C;" cx="225.638" cy="225.648" r="225.638" />
                    <path style="opacity:0.1;enable-background:new    ;" d="M451.296,225.648c0-5.183-0.238-10.307-0.582-15.403l-97.079-97.079
                                    l-0.017,0.023c-0.917-1.027-2.21-1.708-3.676-1.708h-248.6c-2.774,0-4.983,2.257-4.983,4.983v175.683
                                    c0,1.493,0.697,2.786,1.751,3.691l-0.029,0.021l153.869,153.868C364.172,436.688,451.296,341.369,451.296,225.648z" />
                    <g>
                        <path style="fill:#64798A;" d="M96.355,265.292v26.833c0,2.751,2.23,4.982,4.982,4.982h248.601c2.752,0,4.982-2.231,4.982-4.982
                                        v-26.833H96.355z" />
                        <path style="fill:#64798A;" d="M354.921,116.48c0-2.752-2.231-4.982-4.982-4.982H101.338c-2.752,0-4.982,2.23-4.982,4.982v148.812
                                        h258.566V116.48z" />
                    </g>
                    <path style="fill:#EBF0F3;" d="M339.281,131.268c0-2.478-1.961-4.487-4.38-4.487H116.375c-2.419,0-4.38,2.008-4.38,4.487v134.025
                                    h227.285V131.268z" />
                    <g>
                        <circle style="fill:#3A556A;" cx="225.638" cy="281.2" r="7.163" />
                        <rect x="175.309" y="297.108" style="fill:#3A556A;" width="100.69" height="32.835" />
                    </g>
                    <g>
                        <polygon style="fill:#2F4859;" points="175.294,329.943 175.294,297.107 275.983,297.107 	" />
                        <rect x="164.301" y="329.942" style="fill:#2F4859;" width="122.685" height="9.856" />
                    </g>
                    <rect x="111.995" y="261.416" style="fill:#E1E6E9;" width="227.277" height="3.876" />
                    <circle style="fill:#DC8744;" cx="201.83" cy="188.395" r="42.076" />
                    <circle style="fill:#F6C358;" cx="201.83" cy="188.395" r="34.427" />
                    <path style="fill:#DC8744;" d="M200.729,209.545v-3.725c-4.661-0.478-8.844-2.329-12.552-5.564l3.724-4.439
                                    c2.859,2.483,5.801,3.965,8.827,4.439v-9.899c-3.845-0.918-6.658-2.122-8.443-3.621c-1.786-1.495-2.68-3.716-2.68-6.66
                                    c0-2.94,1.03-5.348,3.087-7.216c2.057-1.872,4.737-2.894,8.036-3.064v-2.549h3.266v2.604c3.741,0.27,7.279,1.549,10.613,3.824
                                    l-3.318,4.696c-2.244-1.598-4.677-2.587-7.295-2.96v9.591h0.154c3.911,0.918,6.785,2.163,8.622,3.725
                                    c1.837,1.566,2.755,3.837,2.755,6.814c0,2.977-1.055,5.397-3.164,7.27c-2.109,1.868-4.898,2.89-8.367,3.06v3.675H200.729z
                                     M197.131,176.609c-0.865,0.764-1.299,1.719-1.299,2.857c0,1.142,0.339,2.039,1.019,2.703c0.681,0.664,1.972,1.304,3.878,1.914
                                    v-8.827C199.199,175.393,197.999,175.845,197.131,176.609z M207.873,198.981c0.951-0.78,1.428-1.769,1.428-2.96
                                    c0-1.188-0.376-2.134-1.123-2.832c-0.747-0.693-2.142-1.349-4.183-1.964v9.185C205.626,200.24,206.92,199.767,207.873,198.981z" />
                    <polygon style="fill:#26BF94;" points="273.987,208.471 289.06,200.712 235.179,178.186 257.706,232.067 265.464,216.995
                                    282.978,234.509 291.502,225.985 " />
                </svg>
            </div>
        </div>
        <div class="flex flex-row justify-between items-center pb-5 px-5">
            <div class="text-md font-semibold">
                <div class="text-gray-500">this month</div>
                <div class="text-[#E6533C]">
{{--                    {{$transactions['month_payable']}}--}}
                    678
                </div>
            </div>
            <div>
                <a
{{--                    href="{{route('payables')}}" --}}
                    class="text-[#E6533C] text-sm hover:bg-[#fcebe8] px-3 py-1 rounded-md font-semibold inline-flex items-center gap-x-2">

                    <span>
                        View All
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>

            </div>
        </div>
    </div>


    {{-- Net Prize --}}
    <div class="bg-white rounded-md border-t-2 border-[#26BF94] flex flex-col justify-evenly hover:shadow-md">
        <div class="flex flex-row justify-between items-center pt-5 px-5">
            <div class="space-y-2">
                <div class="text-md font-semibold">Net Profit</div>
                <div class="sm:text-2xl text-md text-[#26BF94] font-semibold">
{{--                    {{$transactions['net_profit']}}--}}
                    234
                </div>
            </div>
            <div class="w-16 h-16">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 508 508" xml:space="preserve">
                    <circle style="fill:#26BF94;" cx="254" cy="254" r="254" />
                    <path style="fill:#26BF94;" d="M95.6,452.4C139.2,487.2,194,508,254,508s114.8-20.8,158.4-55.6H95.6z" />
                    <polygon style="fill:#2B3B4E;" points="264.8,361.2 275.6,392.8 232.8,392.8 243.2,361.2 226,361.2 195.2,451.6 214,451.6
                                228.8,407.2 279.2,407.2 294.4,451.6 314,451.6 283.2,361.2 " />
                    <rect x="80" y="137.6" style="fill:#FFFFFF;" width="348.8" height="210" />
                    <g>
                        <path style="fill:#324A5E;" d="M434.8,137.6H73.2c-2.8,0-5.2-2.4-5.2-5.2v-17.2c0-2.8,2.4-5.2,5.2-5.2h361.6c2.8,0,5.2,2.4,5.2,5.2
                                    v17.2C440,135.6,437.6,137.6,434.8,137.6z" />
                        <path style="fill:#324A5E;" d="M434.8,374.8H73.2c-2.8,0-5.2-2.4-5.2-5.2v-17.2c0-2.8,2.4-5.2,5.2-5.2h361.6c2.8,0,5.2,2.4,5.2,5.2
                                    V370C440,372.8,437.6,374.8,434.8,374.8z" />
                    </g>
                    <polygon style="fill:#FF7058;" points="348,230.4 226,292 202.8,246 144.4,275.6 138,262.8 209.2,227.2 232.4,273.2 341.6,218
                                330,195.2 374,209.6 359.6,253.6 " />
                </svg>
            </div>
        </div>
        <div class="flex flex-row justify-between items-center pb-5 px-5">
            <div class="text-md font-semibold">
                <div class="text-gray-500">this month</div>
                <div class="text-[#26BF94]">
{{--                    {{$transactions['month_profit']}}--}}
                    356
                </div>
            </div>
            <div>
                <a href="{{route('dashboard')}}" class="text-[#26BF94] text-sm hover:bg-[#eafbf6] px-3 py-1 rounded-md font-semibold inline-flex items-center gap-x-2">
                    <span>
                        View All
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

</div>
