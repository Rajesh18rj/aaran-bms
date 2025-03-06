<div class="font-roboto tracking-wider my-16 flex-col flex gap-y-6">
    <div class=" text-center sm:text-6xl text-2xl font-semibold animate__animated wow bounceInDown"
         data-wow-duration="3s">Frequently Asked Questions (FAQ)
    </div>
    <div class="sm:w-9/12 w-auto mx-auto sm:px-0 px-2">
        <x-accordion.accordion :heading="'Is the subscription fee refundable?'">
            <div class="bg-gray-50 p-4 rounded-md text-xs">Yes, we offer a 100% refund on annual plans if requested
                for cancellation within the first 7 days.
                For longer plans, 100% refunds are available if canceled within 30 days.
            </div>
        </x-accordion.accordion>
        <x-accordion.accordion :heading="'Can I transfer my subscription to another business?'">
            <div class="bg-gray-50 p-4 rounded-md text-xs">You can transfer your Premium subscription to any other
                business you own or start. Only valid for 3-years or longer plans.
            </div>
        </x-accordion.accordion>
        <x-accordion.accordion :heading="'How many users can I add as managers to my business? '">
            <div class="bg-gray-50 p-4 rounded-md text-xs">Different plans have different limits on the number of
                users you can add. However, if you want to add more users than your plan permits, please reach out
                to your account manager OR drop a message on chat support.
            </div>
        </x-accordion.accordion>
        <x-accordion.accordion :heading="'Will the prices be increased in the future?'">
            <div class="bg-gray-50 p-4 rounded-md text-xs">Yes. Incase prices increase, your current plan will be
                carried forward for you.
            </div>
        </x-accordion.accordion>
        <x-accordion.accordion :heading="'What happens to my data when I want to leave?'">
            <div class="bg-gray-50 p-4 rounded-md text-xs">When you decide to leave Refrens, you have the option to
                download all your customer data, invoices, quotations, and other documents at any time. This ensures
                that you have access to your important business information even after discontinuing your use of the
                platform. Refrens prioritizes data security and allows users to retain their data for their records
                or for transitioning to another platform if needed.
            </div>
        </x-accordion.accordion>
        <x-accordion.accordion :heading="'What happens if I want to downgrade to the free plan later?'">
            <div class="bg-gray-50 p-4 rounded-md text-xs">No. You are upgrading only 1 business. If you need a bulk
                plan for multiple businesses please reach out to us at premium@refrens.com.
            </div>
        </x-accordion.accordion>
        <x-accordion.accordion :heading="'I need more help.'">
            <div class="bg-gray-50 p-4 rounded-md text-xs">Please ping us on chat support with your email and phone
                number details, we will get back to you. Or email us at premium@refrens.com
            </div>
        </x-accordion.accordion>
    </div>
    <button
        class="max-w-max mx-auto font-semibold text-sm border border-gray-300 px-4 py-2 rounded-md bg-[#3F5AF3] text-white">
        Upgrade to Premium
    </button>
</div>
