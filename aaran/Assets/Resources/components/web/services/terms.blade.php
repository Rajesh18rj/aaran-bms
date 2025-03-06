<div
    class=" sm:w-9/12 w-auto mx-auto grid sm:grid-cols-2 grid-cols-1 gap-6 font-roboto tracking-wider sm:px-0 px-2">
    <div
        class="bg-[#e7eafd] border border-[#3F5AF3] rounded-md p-5 flex-col flex gap-3 animate__animated wow animate__backInLeft"
        data-wow-duration="3s">
        <div class="w-full">
            <x-icons.icon icon="user-group" class="w-7 h-7 text-[#3F5AF3]"/>
        </div>
        <div class="text-xl font-semibold">Add your Teams to Aaran</div>
        <div class=" text-gray-600 text-sm">
            ₹1,500 per additional user per year
        </div>
        <button x-on:click="open = ! open" class="max-w-max px-6 py-4 bg-[#3F5AF3] text-xs text-white">Talk to us
        </button>
    </div>
    <div
        class="bg-[#e7eafd] border border-[#3F5AF3] rounded-md p-5 flex-col flex gap-3 animate__animated wow animate__backInRight"
        data-wow-duration="3s">
        <div class="w-full">
            <x-icons.icon icon="message-round" class="w-7 h-7 text-[#3F5AF3]"/>
        </div>
        <div class="text-xl font-semibold">Need help finding the right plan for your business?</div>
        <div class=" text-gray-600 text-sm">
            Get a Customised Plan from your Account Manager
        </div>
        <button x-on:click="open = ! open" class="max-w-max px-6 py-4 bg-[#3F5AF3] text-xs text-white">Talk to us
        </button>
    </div>
    <div
        class="bg-[#e7eafd] border border-[#3F5AF3] rounded-md p-5 flex-col flex gap-3 animate__animated wow animate__backInLeft"
        data-wow-duration="3s">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-7 h-7 text-[#3F5AF3]">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        <div class="text-xl font-semibold">100% Refundable</div>
        <div class=" text-gray-600 text-sm">
            If cancelled within 7 days for annual plans and within 30 days for plans longer than 3 years.
        </div>
    </div>
    <div
        class="bg-[#e7eafd] border border-[#3F5AF3] rounded-md p-5 flex-col flex gap-3 animate__animated wow animate__backInRight"
        data-wow-duration="3s">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor"
             class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
        </svg>
        <div class="text-xl font-semibold">Fully Transferable</div>
        <div class=" text-gray-600 text-sm">
            Transfer subscription to any other business if you are on 3 years or longer plans
        </div>
    </div>
</div>
