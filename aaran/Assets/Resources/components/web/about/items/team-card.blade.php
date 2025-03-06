
@props([
    "images" => null,
    "name" => null,
    "position" => null,
])

<div class="flex-col flex gap-y-2">
    <img src="{{$images}}" alt="" {{$attributes}}>
    <div class="flex-col flex sm:gap-y-2 animate__animated wow bounceInUp" data-wow-duration="3s">
        <div class="sm:text-2xl text-md font-semibold">Mac Rayonds</div>
        <div class=" text-sm font-semibold text-[#3F5AF3]">UI/UX Design</div>
    </div>
</div>
