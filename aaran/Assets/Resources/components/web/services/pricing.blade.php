<div class="font-roboto tracking-wider py-16 flex-col flex gap-y-6">
    <div class="text-3xl font-semibold text-center animate__animated wow bounceInDown" data-wow-duration="3s">Plans
        Built for your needs
    </div>
    <div class="text-sm text-gray-600 text-center animate__animated wow animate__backInLeft" data-wow-duration="3s">
        Advanced Acounting Solutions
    </div>
    <div class="max-w-max mx-auto text-center flex gap-x-4 animate__animated wow animate__backInRight"
         data-wow-duration="3s">
        <button class="tab-button active px-4 py-2 bg-gray-200" onclick="showTab('tab1')">3 months</button>
        <button class="tab-button tab-button px-4 py-2 bg-gray-200" onclick="showTab('tab2')">1 year
        </button>
    </div>
    <div id="tab1"
         class="tab-content sm:w-9/12 w-auto mx-auto grid sm:grid-cols-4 grid-cols-1 gap-6 sm:px-0 px-2 animate__animated wow bounceInUp"
         data-wow-duration="3s">
        <x-web.services.items.price-card
            plan_name="Basic"
            plan="Free"
            price="-"
            button="Continue with Basic Plan"
            {{--                    active_button="bg-blue-800 text-white"--}}
            feats_desc="Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
        <x-web.services.items.price-card
            plan_name="Premium"
            plan="Premium pack"
            price="3500"
            button="Continue with Basic Plan"
            {{--                    active_button="bg-blue-800 text-white"--}}
            feats_desc="Including Everything with Basic Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
        <x-web.services.items.price-card
            plan_name="Advanced"
            plan="Recommended Pack"
            price="8000"
            button="Continue with Basic Plan"
            {{--                    active_button="bg-blue-800 text-white"--}}
            feats_desc="Including Everything with Basic, Premium Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
        <x-web.services.items.price-card
            plan_name="Book Pro"
            plan="Complete Package"
            price="11000"
            button="Continue with Pro Plan"
            active_button="bg-blue-800 text-white"
            feats_desc="Unlocks All Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
    </div>

    <div id="tab2" class="tab-content hidden w-9/12 mx-auto grid grid-cols-4 gap-6 ">
        <x-web.services.items.price-card
            plan_name="Basic"
            plan="Free"
            price="-"
            button="Continue with Basic Plan"
            {{--                    active_button="bg-blue-800 text-white"--}}
            feats_desc="Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
        <x-web.services.items.price-card
            plan_name="Premium"
            plan="Premium pack"
            price="18500"
            button="Continue with Basic Plan"
            {{--                    active_button="bg-blue-800 text-white"--}}
            feats_desc="Including Everything with Basic Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
        <x-web.services.items.price-card
            plan_name="Advanced"
            plan="Recommended Pack"
            price="22000"
            button="Continue with Basic Plan"
            {{--                    active_button="bg-blue-800 text-white"--}}
            feats_desc="Including Everything with Basic, Premium Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
        <x-web.services.items.price-card
            plan_name="Book Pro"
            plan="Complete Package"
            price="28000"
            button="Continue with Pro Plan"
            active_button="bg-blue-800 text-white"
            feats_desc="Unlocks All Features"
        >
            @for($i=1; $i<=5; $i++)
                <div class="inline-flex items-center gap-x-2 text-sm">
                    <x-icons.icon-fill iconfill="check" class="w-5 h-auto"/>
                    <span>Customise Invoice Columns with Formulas</span>
                </div>
            @endfor
        </x-web.services.items.price-card>
    </div>
    <div class="text-center text-gray-400 text-sm">*All prices are exclusive of GST</div>
</div>
