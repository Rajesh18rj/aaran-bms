<div class=" font-roboto tracking-wider sm:py-0 py-2 sm:px-0 px-2">

    <x-web.home-new.items.heading label="What we do"/>

    <div class="relative">
        <div
            class="text-gray-50 sm:text-9xl text-6xl font-bold drop-shadow-md text-center tracking-widest animate__animated wow animate__backInRight"
            data-wow-duration="3s">CODEXSUN
        </div>
        <div
            class="absolute sm:bottom-0 sm:left-96 -bottom-2 sm:w-6/12 w-auto sm:text-3xl text-xl text-center font-semibold text-gray-600 animate__animated wow animate__backInLeft"
            data-wow-duration="3s">
            We help organizations achieve their most ambitious goals and move with greater agility.
        </div>
    </div>

    <div class="mt-6">&nbsp;</div>

    <div class="sm:w-8/12 w-auto mx-auto gap-6 grid sm:grid-cols-3 grid-cols-1 sm:pt-16 pt-6">
        @for($i=1; $i<=3; $i++)
            <div class="bg-gray-100 h-auto flex-col flex p-5 gap-y-6 animate__animated wow bounceInUp"
                 data-wow-duration="3s">
                <div class="w-full">
                    <div class="max-w-max text-[#5B72F3] border border-[#5B72F3] px-4 py-2 rounded-md">01</div>
                </div>
                <div class="w-full font-bold text-2xl">Client Consultation</div>
                <div class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Dignissimos,
                    dolores in veniam veritatis voluptatem voluptatibus.
                </div>
                <x-button.animate3>Read More</x-button.animate3>
            </div>
        @endfor
    </div>
</div>
