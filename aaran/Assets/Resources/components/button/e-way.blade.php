@props([
    'routes' => '/'
])

<a href="{{$routes}}" target="_blank"
        class="relative group text-gray-500 transition-colors duration-200 dark:hover:text-orange-500
        dark:text-gray-300 hover:text-orange-600 focus:outline-none animate group">
    <x-aaran-ui::icons.icon-fill iconfill="e-way" class="w-5 h-5 fill-gray-600 group-hover:fill-orange-500"/>
    <div class="absolute invisible group-hover:visible -top-9 -right-2">
        <div class="bg-orange-600 text-white text-xs px-2 py-1 rounded-md items-center inline-flex">
            <span>E-</span><span>Way</span>
        </div>
        <div
            class="absolute left-[24px] w-0 h-0 border-l-[5px] border-l-transparent border-t-[7.5px]
            border-t-orange-600 border-r-[5px] border-r-transparent"></div>
    </div>
</a>

