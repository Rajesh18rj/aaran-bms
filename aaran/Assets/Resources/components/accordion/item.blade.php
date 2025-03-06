<div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne"
     x-collapse>
    <div {{$attributes->merge(['class'=> 'p-4 text-sm sm:text-base text-pretty'])}}>
        {{$slot}}
    </div>
</div>
