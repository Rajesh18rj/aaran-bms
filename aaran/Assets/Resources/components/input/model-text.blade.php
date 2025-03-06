@props([
'label'=>''

])

<div class="flex flex-col sm:flex-row gap-1 sm:gap-3">
    <label for="{{$label}}"
           class="w-[10rem] text-zinc-500 tracking-wide py-2">{{ Str::replace('_',' ',Str::ucfirst($label))}}</label>
    <input id="{{$label}}" autocomplete="off" {{ $attributes }}
    value="{{ old('label') }}" class="w-full rounded-lg"
    />
    @error('vname')
    <span class="text-red-500">{{  $message }}</span>
    @enderror
</div>
