<div class="w-full">
    <x-aaran-ui::input.model-select wire:model="acyear" wire:change="changeAcyear" :label="'AcYear'">
        <option class="text-gray-400"> choose ..</option>
        @foreach(\Aaran\Assets\Enums\Acyear::cases() as $year)
            <option value="{{$year->value}}">&nbsp;&nbsp;{{$year->getName()}}&nbsp;&nbsp;&nbsp;&nbsp;</option>
        @endforeach
    </x-aaran-ui::input.model-select>
</div>
