<button
    {{$attributes->merge(['class' => 'max-w-max bg-sky-500 hover:bg-sky-600 hover:to-blue-600 focus:ring-2 focus:ring-offset-2
    focus:ring-sky-600 text-white sm:px-4 sm:py-2 px-2 py-1 text-[12px] inline-flex items-center gap-x-2 rounded-md tracking-widest font-semibold
    transition-all linear duration-400 uppercase'])}}>
    <span>{{$slot}}</span>
</button>
