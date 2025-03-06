<button id="controlsAccordionItemOne" type="button"
        {{$attributes->merge(['class'=>'flex w-full items-center justify-between gap-4 bg-slate-100 p-4 text-left underline-offset-2
hover:bg-slate-100/75 focus-visible:bg-slate-100/75 focus-visible:underline focus-visible:outline-none dark:bg-slate-800 dark:hover:bg-slate-800/75
dark:focus-visible:bg-slate-800/75'])}}
        aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded"
        :class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-medium'"
        :aria-expanded="isExpanded ? 'true' : 'false'">
    {{$slot}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
         stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
         :class="isExpanded  ?  'rotate-180'  :  ''">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
    </svg>
</button>
