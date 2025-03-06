<button class="max-w-max" {{$attributes}}>
    <a href="#_"
       class="relative inline-flex items-center justify-start py-2 pl-4 pr-12 overflow-hidden font-semibold text-indigo-600 transition-all
       duration-150 ease-in-out rounded hover:pl-10 hover:pr-6 bg-gray-50 group">
        <span
            class="absolute bottom-0 left-0 w-full h-1 transition-all duration-150 ease-in-out bg-[#3F5AF3] group-hover:h-full"></span>
        <span class="absolute right-0 pr-5 duration-200 ease-out group-hover:translate-x-12">
        <svg class="w-3 h-3 text-[#3F5AF3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </span>
        <span class="absolute left-0 pl-4 -translate-x-12 group-hover:translate-x-0 ease-out duration-200">
        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </span>
        <span class="relative w-full text-left text-sm transition-colors duration-200 ease-in-out text-[#3F5AF3] group-hover:text-white">{{$slot}}</span>
    </a>
</button>


