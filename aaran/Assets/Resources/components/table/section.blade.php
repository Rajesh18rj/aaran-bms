@props([
    'margin' => ''
])
<div class="w-full border-t-2 border-pink-500 rounded-md shadow-lg {{$margin}}">
    <div {{$attributes->merge(['class' => 'p-5 bg-white rounded-t-sm space-y-4 border border-gray-400'])}} >
        {{$slot}}
    </div>
</div>
