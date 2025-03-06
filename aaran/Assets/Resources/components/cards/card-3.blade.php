@props([
    'list' => null,
    'data' => null,
])

@foreach($list as $index => $row)

    <!-- card 1 -->

    <div class="relative h-80 flex flex-col  bg-white border  border-gray-300 rounded-lg w-[25rem] p-2 shadow-md">
        <div class="p-3 h-full justify-evenly flex flex-col">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="h-4 w-4 text-slate-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/>
                </svg>
                <div class="w-full flex justify-between text-xs items-center">
                    <h5 class="ml-2 text-slate-800 text-xl font-semibold font-merri">
                        {{$row->vname}}
                    </h5>
                    {{--                <button class="text-gray-500" @click="open = true">--}}
                    {{--                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
                    {{--                         stroke="currentColor" class="size-5">--}}
                    {{--                        <path stroke-linecap="round" stroke-linejoin="round"--}}
                    {{--                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>--}}
                    {{--                        <path stroke-linecap="round" stroke-linejoin="round"--}}
                    {{--                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>--}}
                    {{--                    </svg>--}}
                    {{--                </button>--}}
                </div>
            </div>

                <div class="block leading-normal ">
                    Current Bal :
                    <span class="text-black font-semibold">20555</span>
                </div>

            <div class="flex flex-row justify-between my-2">
                <div class=" leading-normal">
                    This Month :
                    <span class="text-gray-800">20555</span>
                </div>

                <div class="self-start">This Year :
                    <span class="text-blue-600">25000</span>
                </div>
            </div>


            <div class="block text-slate-600 leading-normal font-light mb-2 my-3">

                <div class="h-32  w-full rounded-md  font-roboto overflow-y-auto tracking-wide pr-2">
                    <table class="w-full text-xs text-center border">
                        <tr class="bg-zinc-50  font-merri">
                            <th class="py-2 border-r">Date</th>
                            {{--                                <th class="border-r">A/C name</th>--}}
                            <th class="border-r">Amount</th>
                            <th class="border-r">Type</th>
                            <th>
                                <x-aaran-ui::icons.icon :icon="'chevrons-up'" class="w-4 h-4"/>
                            </th>
                        </tr>

                        @foreach($data as $payment)
                            <tr class="bg-white hover:bg-teal-50 border-b  ">

                                @if($payment->account_book_id === $row->id )

                                    <td class="py-2 border-r">{{ date('d-m-Y', strtotime($payment->vdate)) }}</td>
                                    {{--                                    <td class="border-r">{{ $payment->accountBook->vname }}</td> <!-- Use accountBook relationship -->--}}

                                    <td class="border-r">{{ $payment->vname }}</td>
                                    <td class="border-r">{{ $payment->mode->vname }}</td>
                                    <td>
                                        <x-aaran-ui::icons.icon :icon="'chevrons-down'" class="w-4 h-4"/>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="w-full flex justify-between text-xs">
                <a href="{{route('cashReports', $row->id)}}"
                   class="text-gray-400 hover:text-blue-600 font-semibold  flex items-center ">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>
@endforeach


