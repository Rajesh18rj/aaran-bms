@props([
    'list' => null,
    'data' => null,
    'filter ' => null,

])

@foreach($list as $index=>$row)

    <div class="" x-data="{ open: false }">

        <!-- card 1 -->
        <div class="relative h-80 flex flex-col  bg-white border  border-gray-300 rounded-lg w-[25rem] p-2 shadow-md"
             x-show="!open">


            <div class="p-3 h-full justify-evenly flex flex-col">
                <div class="flex items-center mb-2">

                    <x-aaran-ui::icons.icon icon="globe" class="h-6 w-auto text-slate-600"/>

                    <div class="w-full flex justify-between text-xs items-center">

                        <h5 class="ml-2 text-slate-800 text-xl font-semibold font-merri">
                            {{$row->vname}}
                        </h5>

                        <button class="text-gray-500" @click="open = true">
                            <x-aaran-ui::icons.icon icon="eye" class="h-6 w-auto text-slate-600"/>
                        </button>

                    </div>


                </div>


                <div class="flex items-center justify-between font-lex text-sm">
                    <div class="space-y-2">
                        <div class="block text-slate-600 leading-normal ">
                            Current Bal :
                            <span class="text-teal-400">20555</span>
                        </div>
                        <div class="text-slate-600 leading-normal ">
                            This Month :
                            <span class="text-teal-400 ">20555</span>
                        </div>
                    </div>
                    <div class="self-start text-blue-400">This Year :
                        <span>25000</span>
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
                    <div>
                        <a href="{{route('trans',[$row->id])}}"
                           class="text-gray-400 hover:text-blue-600 font-semibold  flex items-center ">
                            View All
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                    <div class="gap-2 flex flex-row">
                        <div class="flex items-center">{{$row->transType->vname}}</div>
                        <div class="gap-0.5">
                            <button wire:click="edit({{ $row->id }})" class="rounded-md ">

                                <x-aaran-ui::icons.icon :icon="'pencil'"
                                              class="block w-auto h-5 text-cyan-700 hover:scale-110"/>
                            </button>

                            <button wire:click="getDelete({{ $row->id }})" class="rounded-md ">

                                <x-aaran-ui::icons.icon :icon="'trash'"
                                              class="block w-auto h-5 text-cyan-700 hover:scale-110"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card 2 -->

        <div class="relative h-80 flex flex-col bg-white shadow-sm border border-green-400 rounded-lg w-[25rem] p-2"
             x-show="open">
            <div class="p-3 h-full justify-evenly flex flex-col">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-4 w-4 text-slate-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/>
                    </svg>
                    <div class="w-full flex justify-between text-xs items-center">
                        <h5 class="ml-2 text-slate-800 text-xl font-semibold font-merri">
                            {{$row->bank->vname}}
                        </h5>
                        <button class="text-gray-500" @click="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>

                            {{--    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">--}}
                            {{--        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />--}}
                            {{--    </svg>--}}


                        </button>
                    </div>
                </div>
                <!-- button 2 -->


                <div
                    class="block text-slate-600 leading-normal  mb-2 my-2 space-y-3 ml-8 w-80 font-lex text-xs tracking-wider ">
                    <span class="text-slate-800 font-merri font-semibold tracking-wider text-xl">Recent</span>

                    <li class="flex justify-between ">
                        <span class="w-1/2 text-gray-500">A/C No :</span>
                        <span class="w-1/2 text-gray-800 ">{{ $row->account_no }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="w-1/2 text-gray-500">IFSC Code :</span>
                        <span class="w-1/2 text-gray-800 ">{{ $row->ifsc_code }}</span>
                    </li>
                    <li class="capitalize flex justify-between">
                        <span class="w-1/2 text-gray-500">Branch :</span>
                        <span class="w-1/2 text-gray-800 ">{{ $row->branch }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="w-1/2 text-gray-500">A/C Type :</span>
                        <span class="w-1/2 text-blue-500">{{ $row->accountType->vname }}</span>
                    </li>

                </div>

                <!-- Copy All Button -->

                <div class=" self-end flex justify-end border max-w-max p-1 rounded">
                    <button @click="
                    const details = `Bank Name: {{ $row->bank_name }}\nA/C No: {{ $row->account_no }}\nIFSC Code: {{ $row->ifsc_code }}\nBranch:
                    {{ $row->branch }}\nA/C Type: {{ $row->account_type_name }}`;
                    navigator.clipboard.writeText(details);"
                            class="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             class="size-4 fill-gray-500  hover:fill-blue-600">
                            <path fill-rule="evenodd"
                                  d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 0 1-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0 1 13.5 1.5H15a3 3 0 0 1 2.663 1.618ZM12 4.5A1.5 1.5 0 0 1 13.5 3H15a1.5 1.5 0 0 1 1.5 1.5H12Z"
                                  clip-rule="evenodd"/>
                            <path
                                d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 0 1 9 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0 1 16.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625v-12Z"/>
                            <path
                                d="M10.5 10.5a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963 5.23 5.23 0 0 0-3.434-1.279h-1.875a.375.375 0 0 1-.375-.375V10.5Z"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>

@endforeach

