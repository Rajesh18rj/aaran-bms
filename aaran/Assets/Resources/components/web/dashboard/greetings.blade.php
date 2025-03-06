<div class=" sm:w-3/12 w-auto h-auto rounded-lg bg-gray-50 hover:shadow-md">
    @if (Aaran\Assets\Helper\Core::greetings() == 'Good morning')
        <div class="relative h-full">
            <img src="../../../../images/home/wall1.webp" alt=""
                 class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute sm:top-40 top-8 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-lex  font-semibold sm:text-lg text-2xl text-white">


                <span class="w-full">{{ Aaran\Assets\Helper\Core::greetings() }},
                </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! Aaran\Assets\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @elseif (Aaran\Assets\Helper\Core::greetings() == 'Good afternoon')
        <div class="relative h-full">
            <img src="../../../../images/home/wall2.webp" alt=""
                 class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute sm:top-40 top-8 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-semibold sm:text-2xl text-lg text-white">
                <span class="w-full">{{ Aaran\Assets\Helper\Core::greetings() }},
                </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! Aaran\Assets\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @elseif (Aaran\Assets\Helper\Core::greetings() == 'Good evening')
        <div class="relative h-full">
            <img src="../../../../images/home/wall3.webp" alt=""
                 class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute sm:top-40 top-8 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-semibold sm:text-2xl text-lg text-white">
                <span class="w-full">{{ Aaran\Assets\Helper\Core::greetings() }},
                </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! Aaran\Assets\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @else
        <div class="relative h-full">
            <img src="../../../../images/home/wall4.webp" alt=""
                 class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute sm:top-40 top-8 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-semibold sm:text-2xl text-lg text-white">
                <span class="w-full">{{ Aaran\Assets\Helper\Core::greetings() }},
                </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! Aaran\Assets\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @endif
</div>
