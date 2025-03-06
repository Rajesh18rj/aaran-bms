@props([
    'heading'=>null,
])
<div class="w-full divide-y divide-slate-300 text-slate-700 dark:divide-slate-700 dark:text-slate-300">
    <div x-data="{ isExpanded: false }">
        <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center gap-x-2 py-4 text-left underline-offset-2 focus-visible:underline focus-visible:outline-none" aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded" :class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-medium'" :aria-expanded="isExpanded ? 'true' : 'false'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" :class="isExpanded  ?  'rotate-180'  :  ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
            {{$heading}}
        </button>
        <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne" x-collapse>
            <div class="pb-4 text-sm sm:text-base text-pretty ">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
