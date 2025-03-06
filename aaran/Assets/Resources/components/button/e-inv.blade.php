@props([
    'routes' => '/'
])

<a href="{{ $routes }}" target="_blank"
        class="relative group text-gray-500 transition-colors duration-200 dark:hover:text-green-500
        dark:text-gray-300 hover:text-green-600 focus:outline-none animate group">
    <x-aaran-ui::icons.icon-fill iconfill="e-inv" class="w-5 h-5 block fill-gray-600 group-hover:fill-green-500"/>
    <div class="absolute invisible group-hover:visible -top-9 -right-5 h-8">
        <div class="bg-green-600 text-white text-xs px-2 py-1 rounded-md inline-flex items-center">
            <span>E-</span><span>Invoice</span>
        </div>
        <div
            class="absolute left-[30px] w-0 h-0 border-l-[5px] border-l-transparent border-t-[7.5px]
            border-t-green-600 border-r-[5px] border-r-transparent"></div>
    </div>
</a>

