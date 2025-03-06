<div class="sm:w-5/12 w-auto hover:shadow-md bg-white p-5 rounded-lg">
    <div class="flex justify-between items-start">
        <div class="font-medium">Statistics</div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <div class="rounded-md border border-dashed border-gray-200 p-4">
            <div class="flex items-center mb-0.5">
                <div class="text-xl font-semibold">240</div>
                <span
                    class="p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-blue-500 leading-none ml-1">₹ 5850</span>
            </div>
            <span class="text-blue-500 text-sm">Sales</span>
        </div>
        <div class="rounded-md border border-dashed border-gray-200 p-4">
            <div class="flex items-center mb-0.5">
                <div class="text-xl font-semibold">450</div>
                <span
                    class="p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">+₹ 46900</span>
            </div>
            <span class="text-emerald-500 text-sm">Profit</span>
        </div>
        <div class="rounded-md border border-dashed border-gray-200 p-4">
            <div class="flex items-center mb-0.5">
                <div class="text-xl font-semibold">235</div>
                <span
                    class="p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">₹ 6930</span>
            </div>
            <span class="text-rose-500 text-sm">Purchase</span>
        </div>
    </div>
    <div>
        <canvas id="order-chart"></canvas>
    </div>
    <x-web.dashboard.style/>
    <x-web.dashboard.script/>
</div>

