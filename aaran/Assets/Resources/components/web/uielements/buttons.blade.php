<x-forms.m-panel :margin="'my-12'">
    <div class="grid sm:grid-cols-2 grid-cols-1 gap-6">
        <div>
            <div class="font-merri w-full mx-auto text-xl py-4 border-b border-gray-300">Alerts</div>
            <div class="grid grid-rows-4 gap-y-6 py-6">
                <x-alerts.info/>
                <x-alerts.success/>
                <x-alerts.warning/>
                <x-alerts.danger/>
            </div>
        </div>
        <div>
            <div>
                <div class="font-merri w-full mx-auto text-xl py-4 border-b border-gray-300">Buttons</div>
                <div class="grid sm:grid-cols-4 sm:gap-6 grid-cols-3 gap-4 py-6">
                    <x-button.new/>
                    <x-button.delete/>
                    <x-button.print/>
                    <x-button.back/>
                    <x-button.cancel/>
                    <x-button.save/>
                    <x-button.register>Register</x-button.register>
                    <x-button.primary>Primary</x-button.primary>
                    <x-button.secondary>Secondary</x-button.secondary>
                    <x-button.loading/>
                </div>
            </div>
            <div>
                <div class="font-merri w-full mx-auto text-xl py-4 border-b border-gray-300">Models</div>
                <div class="grid sm:grid-cols-4 sm:gap-6 grid-cols-2 gap-4 py-6">
                    <x-modal.default/>
                    <x-modal.success/>
                    <x-modal.info/>
                    <x-modal.warning/>
                    <x-modal.danger/>
                </div>
            </div>
        </div>
    </div>
    <div class=" flex-wrap flex items-center gap-5">
        <x-button.new-x/>
        <x-button.danger-x/>
        <x-button.save-x/>
        <x-button.back-x/>
        <x-button.cancel-x/>
        <x-button.print-x/>
        <x-button.e-invoice-x/>
        <x-button.e-way-x/>
        <x-button.e-cancel-x/>
    </div>

</x-forms.m-panel>
