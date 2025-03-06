<x-aaran-ui::forms.m-panel :margin="'my-12'">
    <div class="border-gray-300">
        <div class="font-merri w-full mx-auto text-xl py-4 border-b border-gray-300">Color Palette</div>

        <div class="font-merri w-full mx-auto text-md pt-6 px-12">Theme Color</div>
        <div class="grid sm:grid-cols-6 grid-cols-2 sm:gap-6 gap-2 py-6">
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#007BFF] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Primary
                </div>
                <div class="w-40 bg-[#007BFF] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #007BFF
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#6c757d] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Secondary
                </div>
                <div class="w-40 bg-[#6c757d] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #6c757d
                    </x-aaran-ui::interactions.clip>
                </div>

            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#17A2B8] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Info
                </div>
                <div class="w-40 bg-[#17A2B8] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #17A2B8
                    </x-aaran-ui::interactions.clip>
                </div>

            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#28a745] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Success
                </div>
                <div class="w-40 bg-[#28a745] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #28a745
                    </x-aaran-ui::interactions.clip>
                </div>

            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#ffc107] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Warning
                </div>
                <div class="w-40 bg-[#ffc107] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #ffc107
                    </x-aaran-ui::interactions.clip>
                </div>

            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#dc3545] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Danger
                </div>
                <div class="w-40 bg-[#dc3545] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #dc3545
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
        </div>
        <div class="font-merri w-full mx-auto text-md pt-6 px-12">Black/White Nuances</div>
        <div class="grid sm:grid-cols-6 sm:gap-6 grid-cols-2 gap-2 py-6">
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#000000] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Black
                </div>
                <div class="w-40 bg-[#000000] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #000000
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#343a40] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Gray Dark
                </div>
                <div class="w-40 bg-[#343a40] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #343a40
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#adb5bd] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Gray
                </div>
                <div class="w-40 bg-[#adb5bd] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #adb5bd
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#1f2d3d] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Light
                </div>
                <div class="w-40 bg-[#1f2d3d] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #1f2d3d
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
        </div>
        <div class="font-merri w-full mx-auto text-md pt-6 px-12">Colors</div>
        <div class="grid sm:grid-cols-6 sm:gap-6 grid-cols-2 gap-2 py-6">
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#6610f2] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Indigo
                </div>
                <div class="w-40 bg-[#6610f2] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #6610f2
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#3c8dbc] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Lightblue
                </div>
                <div class="w-40 bg-[#3c8dbc] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #3c8dbc
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#001f3f] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Navy
                </div>
                <div class="w-40 bg-[#001f3f] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #001f3f
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#605ca8] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Purple
                </div>
                <div class="w-40 bg-[#605ca8] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #605ca8
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#f012be] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Fuchsia
                </div>
                <div class="w-40 bg-[#f012be] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #f012be
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#e83e8c] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Pink
                </div>
                <div class="w-40 bg-[#e83e8c] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #e83e8c
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#d81b60] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Maroon
                </div>
                <div class="w-40 bg-[#d81b60] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #d81b60
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#ff851b] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Orange
                </div>
                <div class="w-40 bg-[#ff851b] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #ff851b
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#01ff70] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Lime
                </div>
                <div class="w-40 bg-[#01ff70] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #01ff70
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#39cccc] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Teal
                </div>
                <div class="w-40 bg-[#39cccc] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #39cccc
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
            <div class="flex-col flex justify-center items-center font-roboto tracking-wider">
                <div class="w-40 bg-[#3d9970] text-white text-xs text-left border-b border-white px-2 py-2 rounded-t-md">
                    Olive
                </div>
                <div class="w-40 bg-[#3d9970] px-2 py-2 rounded-b-md">
                    <x-aaran-ui::interactions.clip class="text-white" :color="'text-white'" :size="'text-xs'">
                        #3d9970
                    </x-aaran-ui::interactions.clip>
                </div>
            </div>
        </div>

    </div>
</x-aaran-ui::forms.m-panel>

