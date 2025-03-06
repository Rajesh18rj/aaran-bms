@props([
    'bg_image' => 'no image',
    'title'=>'Check This',
    'slogan' => 'Check This',
    'title_text_colour'=> 'text-white',
    'body_text_colour' => 'text-white',
    'text_length' => 15
])

<li {{ $attributes->class(['flex flex-col items-center justify-center w-full sm:h-screen h-full shrink-0 snap-start relative']) }}>
    <div style="background-image: url({{$bg_image}});"
         class="w-full sm:h-screen h-full bg-cover bg-no-repeat mx-auto flex-col brightness-75 flex justify-center relative">
    </div>
    <div
        class="absolute sm:bottom-8 bottom-2 left-10 w-auto h-10/12 flex-col font-roboto p-5 my-5  px-10">
        <div
            class="sm:text-6xl sm:capitalize sm:drop-shadow-lg {{$title_text_colour}}"
        >
            {{$title}}
        </div>
        <div
            class="sm:text-2xl text-xs mt-3  {{$body_text_colour}}">
            {{\Illuminate\Support\Str::words($slogan,$text_length)}}
        </div>

    </div>
</li>
