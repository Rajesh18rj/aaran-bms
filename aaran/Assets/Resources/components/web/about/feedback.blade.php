<div class="mt-8 h-20">&nbsp;</div>
<div class="flex-col flex gap-6 sm:py-0 py-8">
     <x-web.home-new.items.heading label="Customer Stories" />
    <div class="sm:text-2xl text-lg text-center font-semibold animate__animated wow bounceInUp"
         data-wow-duration="3s">See how customers are growing their businesses and getting incredible results.
    </div>
    <div class="sm:w-9/12 w-auto mx-auto grid sm:grid-cols-3 grid-cols-1 sm:gap-4 gap-20 gap my-16 sm:px-0 px-2">
        @for($i=1; $i<=3; $i++)
            <div class="relative animate__animated wow bounceInUp" data-wow-duration="3s">
                <div class="z-10 bg-[#F2F3F4] flex-col flex justify-center items-center gap-y-3 pt-28 p-5">
                    <div>
                        <div class="text-xl font-semibold">Daniel Joseph</div>
                    </div>
                    <div class="text-[#5069F4] font-semibold text-sm">WRITER</div>
                    <div class="text-center text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur
                        adipisicing elit. Consectetur dolores, eos
                        excepturi
                        ipsum
                        laboriosam nemo quisquam suscipit temporibus voluptates. Hic!
                    </div>
                </div>
                <div class="absolute -top-16 sm:left-28 left-20 z-20">
                    <div class="w-40 h-40 p-2 bg-white rounded-full">
                        <img src="../../../../images/a1.png" alt="" class="w-full h-full bg-[#F2F3F4] rounded-full">
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
