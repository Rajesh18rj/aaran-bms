@props([
    "plan_name" => null,
    "plan" => null,
    "price" => null,
    "button" => null,
    'active_button' => null,
    'feats_desc' => null,

])
<div class="border border-gray-200 p-5 flex-col flex gap-y-4 rounded-md">
    <div class="text-md font-semibold">{{$plan_name}}</div>
    <div class="text-gray-400 text-lg">{{$plan}}</div>
    <div class="inline-flex items-center gap-x-3">
        <div class="inline-flex items-baseline gap-x-2">
            <span>
                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 32 32"
                     xmlns="http://www.w3.org/2000/svg"><path
                        d="M 8 5 L 8 7 L 12 7 C 13.703125 7 15.941406 8.039063 16.71875 10 L 8 10 L 8 12 L 16.96875 12 C 16.660156 14.609375 13.972656 16 12 16 L 8 16 L 8 18.46875 L 18.25 27 L 21.375 27 L 10.5625 18 L 12 18 C 15.234375 18 18.675781 15.609375 18.96875 12 L 24 12 L 24 10 L 18.8125 10 C 18.507813 8.816406 17.859375 7.804688 17 7 L 24 7 L 24 5 Z"/></svg>
            </span>
            <span class="text-xl font-semibold">{{$price}}</span>
        </div>
        <div class="text-gray-400 text-sm">per year</div>
    </div>
    <button
        class="w-full text-[#3F5AF3] font-semibold text-sm border border-[#3F5AF3]  py-2 rounded-md {{$active_button}}" {{$attributes}}>
        {{$button}}
    </button>

    <div class="flex-col flex gap-y-4">
        <div class="text-sm italic text-gray-600 pt-4">{{$feats_desc}}</div>
        {{$slot}}
    </div>
</div>
