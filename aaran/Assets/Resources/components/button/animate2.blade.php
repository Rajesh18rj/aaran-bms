<button
    class="tab-button px-6 py-2.5 relative rounded group overflow-hidden font-medium bg-gray-100 inline-block text-center"
    {{$attributes}} onclick="showTab('tab1')">
    <span
        class="absolute top-0 left-0 flex h-full w-0 mr-0 transition-all
        duration-500 ease-out transform translate-x-0 bg-[#3F5AF3] group-hover:w-full opacity-90"></span>
    <span class="relative group-hover:text-white">{{$slot}}</span>
</button>
