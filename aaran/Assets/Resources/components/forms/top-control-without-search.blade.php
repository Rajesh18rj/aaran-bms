<div class="flex justify-between pb-5 w-full">
    <div class="w-3/4 flex space-x-2 ">

   {{$slot}}

    </div>

    <div class="space-x-2 flex items-center">
        <x-forms.per-page/>
        <x-button.new/>
    </div>
</div>
