@props([
    'row'
])
<div {{$attributes}}>
    <div  class="flex justify-center">
        <div
            x-data="{
                                        open: false,
                                        toggle() {
                                            if (this.open) {
                                                return this.close()
                                            }

                                            this.$refs.button.focus()

                                            this.open = true
                                        },
                                        close(focusAfter) {
                                            if (! this.open) return

                                            this.open = false

                                            focusAfter && focusAfter.focus()
                                        }
                                    }"
            x-on:keydown.escape.prevent.stop="close($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
            x-id="['dropdown-button']"
            class="relative"
        >
            <!-- Button -->
            <button
                x-ref="button"
                x-on:click="toggle()"
                :aria-expanded="open"
                :aria-controls="$id('dropdown-button')"
                type="button"
                class=""
            >

                <!-- Heroicon: chevron-down --------------------------------------->
                <div
                    class="w-5 h-4 hover:bg-white flex justify-evenly rounded-md mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor" class="size-4 ">
                        <path
                            d="M3 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM8.5 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM15.5 8.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z"/>
                    </svg>
                </div>
            </button>

            <!-- Panel ------------------------------------------------------------->
            <div
                x-ref="panel"
                x-show="open"
                x-transition.origin.top.left
                x-on:click.outside="close($refs.button)"
                :id="$id('dropdown-button')"
                style="display: none;"
                class="absolute left-6 w-30 rounded-md bg-white shadow-md"
            >
{{--                <a wire:click="edit({{ $row->id }})"--}}
                <a wire:click="edit({{ '' }})"
                   class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <x-icons.icon :icon="'pencil'"
                                  class="h-4 w-auto block text-blue-600"/>
                    edit
                </a>
{{--                <a wire:click="getDelete({{ $row->id }})"--}}
                <a wire:click="getDelete({{ '' }})"
                   class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <x-icons.icon :icon="'trash'"
                                  class="h-4 w-auto block text-red-600"/>
                    delete
                </a>

{{--                <x-modal.delete/>--}}
            </div>
        </div>
    </div>
</div>
