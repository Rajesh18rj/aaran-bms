@props([
    'name'=>'',
    'label'=>''
])

<div class="grid grid-cols-1 gap-2">
    <label for="{{$name}}" class="gray-label">{{$label}}</label>
    <input type="date" id="{{$name}}" {{$attributes}}
    class="purple-textbox w-full purple-textbox"
           autofocus
           placeholder="{{$label}}"/>
</div>
