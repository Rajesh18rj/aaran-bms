
<!-- Include these scripts somewhere on the page: -->


<div
    x-data="{
        value: null,
        frameworks: [
            {
                id: 1,
                name: 'Laravel',
                disabled: false,
            },
            {
                id: 2,
                name: 'Ruby on Rails',
                disabled: false,
            },
            {
                id: 3,
                name: 'Phoenix',
                disabled: true,
            },
        ],
    }"
>
    <div
        x-listbox
        x-model="value"
        class="relative"
    >
        <label x-listbox:label class="sr-only">Backend framework</label>

        <button
            x-listbox:button
            class="flex items-center justify-between gap-2 w-52 bg-white pl-5 pr-3 py-2.5 rounded-md shadow"
        >
            <span x-text="value ? value.name : 'Select Year'" class="truncate"></span>

            <!-- Heroicons up/down -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" /></svg>
        </button>

        <ul
            x-listbox:options
            x-transition.origin.top.right
            x-cloak
            class="absolute right-0 w-48 mt-2 z-10 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-md outline-none"
        >
            <template x-for="framework in frameworks" :key="framework.id">
                <li
                    x-listbox:option
                    :value="framework"
                    :disabled="framework.disabled"
                    :class="{
                        'bg-cyan-500/10 text-gray-900': $listboxOption.isActive,
                        'text-gray-600': ! $listboxOption.isActive,
                        'opacity-50 cursor-not-allowed': $listboxOption.isDisabled,
                    }"
                    class="flex items-center cursor-default justify-between gap-2 w-full px-4 py-2 text-sm transition-colors"
                >
                    <span x-text="framework.name"></span>

                    <span x-show="$listboxOption.isSelected" class="text-cyan-600 font-bold">&check;</span>
                </li>
            </template>
        </ul>
    </div>
</div>
