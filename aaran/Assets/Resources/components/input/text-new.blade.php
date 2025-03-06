@props([
'name'=>'',
'label'=>'',
'type' => 'text'
])

<div>
    <label for="{{$name}}" class="gray-label">{{$label}}</label>
    <input type="{{$type}}" id="{{$name}}" {{$attributes}}
    class="purple-textbox w-full purple-textbox  mt-2"
           placeholder="{{$label}}"/>
</div>
