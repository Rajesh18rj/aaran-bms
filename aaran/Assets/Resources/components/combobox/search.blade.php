<div x-data="{
        allOptions: [
            {
                label: 'Acura',
                value: 'Acura'
            },
            {
                label: 'Alfa Romeo',
                value: '1'
            },
            {
                label: 'Aston Martin',
                value: 'Aston Martin'
            },
            {
                label: 'Audi',
                value: 'Audi'
            },
            {
                label: 'Bentley',
                value: 'Bentley'
            },
        ],
        options: [],
        isOpen: false,
        openedWithKeyboard: false,
        selectedOption: null,
        setSelectedOption(option) {
            this.selectedOption = option
            this.isOpen = false
            this.openedWithKeyboard = false
            this.$refs.hiddenTextField.value = option.value
        },
        getFilteredOptions(query) {
            this.options = this.allOptions.filter((option) =>
                option.label.toLowerCase().includes(query.toLowerCase()),
            )
            if (this.options.length === 0) {
                this.$refs.noResultsMessage.classList.remove('hidden')
            } else {
                this.$refs.noResultsMessage.classList.add('hidden')
            }
        },
        handleKeydownOnOptions(event) {
            // if the user presses backspace or the alpha-numeric keys, focus on the search field
            if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8) {
                this.$refs.searchField.focus()
            }
        },
    }" class="flex w-full max-w-xs flex-col gap-1" x-on:keydown="handleKeydownOnOptions($event)"
     x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false" x-init="options = allOptions">
    {{--    <label for="make" class="w-fit pl-0.5 text-sm text-slate-700 dark:text-slate-300">Make</label>--}}
    <div class="relative">

        <!-- trigger button  -->
        <button type="button"
                class="inline-flex w-full items-center justify-between gap-2 border border-slate-300 rounded-xl bg-slate-100 px-4 py-2 text-sm font-medium
                tracking-wide"
                role="combobox" aria-controls="makesList" aria-haspopup="listbox" x-on:click="isOpen = ! isOpen"
                x-on:keydown.down.prevent="openedWithKeyboard = true"
                x-on:keydown.enter.prevent="openedWithKeyboard = true"
                x-on:keydown.space.prevent="openedWithKeyboard = true"
                x-bind:aria-expanded="isOpen || openedWithKeyboard"
                x-bind:aria-label="selectedOption ? selectedOption.value : 'Please Select'">
            <span class="text-sm font-normal text-blue-600" x-text="selectedOption ? selectedOption.value : 'Please Select'"></span>
            <!-- Chevron  -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"
                 aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                      clip-rule="evenodd"/>
            </svg>
        </button>

        <!-- Hidden Input To Grab The Selected Value  -->
        <input id="make" name="make" x-ref="hiddenTextField" hidden=""/>
        <div x-show="isOpen || openedWithKeyboard" id="makesList"
             class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-xl border border-slate-300 bg-slate-100 dark:border-slate-700 dark:bg-slate-800"
             role="listbox" aria-label="industries list" x-on:click.outside="isOpen = false, openedWithKeyboard = false"
             x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()"
             x-transition x-trap="openedWithKeyboard">

            <!-- Search  -->
            <div class="relative m-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                     stroke-width="1.5"
                     class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-slate-700/50 dark:text-slate-300/50"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                </svg>
                <input type="text"
                       class="w-full border-b borderslate-300 bg-slate-100 py-2.5 pl-11 pr-4 text-sm text-slate-700 focus:outline-none focus-visible:border-blue-700
                       disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:focus-visible:border-blue-600 rounded-t-md"
                       name="searchField" aria-label="Search" x-on:input="getFilteredOptions($el.value)"
                       x-ref="searchField" placeholder="Search"/>
            </div>

            <!-- Options  -->
            <ul class="flex max-h-44 flex-col overflow-y-auto">
                <li class="hidden px-4 py-2 text-sm text-slate-700 dark:text-slate-300" x-ref="noResultsMessage">
                    <span>No matches found</span>
                </li>
                <template x-for="(item, index) in options" x-bind:key="item.value">
                    <li class="combobox-option inline-flex cursor-pointer justify-between gap-6 bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-800/5 hover:text-black focus-visible:bg-slate-800/5 focus-visible:text-black focus-visible:outline-none dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-100/5 dark:hover:text-white dark:focus-visible:bg-slate-100/10 dark:focus-visible:text-white"
                        role="option" x-on:click="setSelectedOption(item)" x-on:keydown.enter="setSelectedOption(item)"
                        x-bind:id="'option-' + index" tabindex="0">
                        <!-- Label  -->
                        <span x-bind:class="selectedOption == item ? 'font-bold' : null" x-text="item.label"></span>
                        <!-- Screen reader 'selected' indicator  -->
                        <span class="sr-only" x-text="selectedOption == item ? 'selected' : null"></span>
                        <!-- Checkmark  -->
                        <svg x-cloak x-show="selectedOption == item" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="size-4"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>
