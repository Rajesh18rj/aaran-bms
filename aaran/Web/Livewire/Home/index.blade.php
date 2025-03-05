<div class="relative w-full h-screen" x-data="{
    currentSlide: 0,
    slides: {{ json_encode($slides) }},
    startSlider() {
        setInterval(() => {
            this.nextSlide();
        }, 5000);
    },
    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
    },
    prevSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
    }
}" x-init="startSlider()">

    <div class="absolute inset-0 overflow-hidden">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlide === index" class="absolute inset-0 transition-transform duration-700 ease-in-out transform"
                 x-transition:enter="translate-x-full" x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0" x-transition:leave="translate-x-0"
                 x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

                <img :src="slide.image" class="w-full h-full object-cover absolute inset-0" alt="Slide">

                <div class="absolute bottom-5 left-0 w-full bg-black/25 text-white p-6">
                    <div x-data="{ loaded: false, triggerLoad: false }"
                         x-init="triggerLoad = true; interval = setInterval(() => { triggerLoad = true; }, 5000);"
                         x-effect="if (triggerLoad) { loaded = false; setTimeout(() => { loaded = true; triggerLoad = false; }, 100); }"
                         x-on:remove="clearInterval(interval)">
                        <div x-show="loaded" x-transition:enter="transition ease-out duration-2000"
                             x-transition:enter-start="opacity-0 transform translate-y-10"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <div x-text="slide.title" class="text-7xl font-bold"></div>
                        </div>
                    </div>
                    <div x-data="{ loaded: false, triggerLoad: false }"
                         x-init="triggerLoad = true; interval = setInterval(() => { triggerLoad = true; }, 5000);"
                         x-effect="if (triggerLoad) { loaded = false; setTimeout(() => { loaded = true; triggerLoad = false; }, 100); }"
                         x-on:remove="clearInterval(interval)">
                        <div x-show="loaded" x-transition:enter="transition ease-out duration-2000"
                             x-transition:enter-start="opacity-0 transform translate-y-10"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <p x-text="slide.description" class="text-xl"></p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <button @click="prevSlide()"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-3 rounded-full text-xl">❮
    </button>
    <button @click="nextSlide()"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-3 rounded-full text-xl">
        ❯
    </button>

</div>
