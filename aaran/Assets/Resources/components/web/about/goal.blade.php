<div
    class=" grid sm:grid-cols-2 grid-cols-1 gap-12 sm:h-[40rem] h-auto font-roboto tracking-wider sm:pl-40 sm:px-0 px-2">
    <div class=" flex-col flex sm:gap-y-8 gap-y-4 py-8">

        <x-web.home-new.items.heading label="ABOUT COMPANY" />

        <div class="sm:text-5xl text-2xl font-semibold sm:leading-[50px] animate__animated wow animate__backInLeft"
             data-wow-duration="3s">Our Main Goal to Satisfied Local & Global Clients.
        </div>
        <div class="text-sm text-gray-600 animate__animated wow animate__backInLeft" data-wow-duration="3s">Lorem
            ipsum dolor sit amet, consectetur adipisicing elit. Animi earum
            eius, est eveniet maiores minima
            molestiae neque nostrum nulla obcaecati quidem recusandae reprehenderit tempore temporibus voluptate.
            Asperiores magni minima nihil!
        </div>
        <div class="sm:w-4/6 w-auto grid grid-cols-3 gap-6 animate__animated wow bounceInUp" data-wow-duration="3s">
            <x-button.animate2 class="tab-button" onclick="showTab('tab1')">Button 1</x-button.animate2>
            <x-button.animate2 class="tab-button" onclick="showTab('tab2')">Button 2</x-button.animate2>
            <x-button.animate2 class="tab-button" onclick="showTab('tab3')">Button 3</x-button.animate2>
        </div>
        <div id="tab1" class="tab-content">
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam autem distinctio dolor dolorum
                iusto nostrum optio quaerat? Maiores sit, voluptas! Ab autem et iusto molestias.
            </div>
        </div>
        <div id="tab2" class="tab-content">
            <div>Aliquam autem distinctio dolor dolorum
                iusto nostrum optio quaerat? Maiores sit, voluptas! Ab autem et iusto molestias.
            </div>
        </div>
        <div id="tab3" class="tab-content">
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            </div>
        </div>
    </div>
    <div class="sm:flex sm:justify-center hidden">
        <div class="relative w-[40rem] h-[33rem] flex justify-start group">
            <img src="../../../../images/about-img-2.jpg" alt=""
                 class="w-auto z-10 h-[400px] animate__animated wow animate__backInRight" data-wow-duration="3s">
            <div class="sm:w-72 sm:h-72 w-36 h-36 rounded-full border-2 border-dashed border-blue-600 absolute z-0 top-7 sm:right-44 -right-8
                sm:group-hover:-translate-x-28 group-hover:-translate-x-8 sm:group-hover:translate-y-10 group-hover:translate-y-2
                transition-all duration-300 ease-linear"></div>
            <img src="../../../../images/about-img-3.jpg" alt=""
                 class="absolute z-20 bottom-0 right-40 w-64  h-auto border-t-8 border-l-8 border-black animate__animated wow animate__backInRight"
                 data-wow-duration="3s">
        </div>
    </div>
</div>
