@props(['logo'])

<span class="inline-flex justify-center items-center hover:scale-110 duration-300 transition-all ease-out">

    @switch($logo)

        @case('codexsun')
            <x-assets.logo.cxlogo :icon="'light'" class="h-9 ml-4 mx-auto w-auto block"/>
            @break

        @case('aaran')
            <x-assets.logo.aaran brand="aaran" class="h-9 ml-4 w-auto block"/>
            @break

        @default
            CODEXSUN
    @endswitch
    </span>
