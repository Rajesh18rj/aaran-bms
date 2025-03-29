<div>
    <x-slot name="header">Contact Entry</x-slot>

    <!-- Top Controls ------------------------------------------------------------------------------------------------>

    <x-aaran-ui::forms.m-panel-auto>

        <x-aaran-ui::alerts.notification />

        <x-aaran-ui::tabs.tab-panel>

            <x-slot name="tabs">
                <x-aaran-ui::tabs.tab>Mandatory</x-aaran-ui::tabs.tab>
                <x-aaran-ui::tabs.tab>Detailing</x-aaran-ui::tabs.tab>
            </x-slot>

            <x-slot name="content">

                <x-aaran-ui::tabs.content>

                    <div class="lg:flex-row flex flex-col sm:gap-8 gap-4">

                        <!-- Left area -------------------------------------------------------------------------------->

                        <div class="sm:w-1/2 w-full flex flex-col gap-3 ">

                            <x-aaran-ui::input.floating wire:model.live="vname" label="Contact Name"/>
                            @error('vname')
                            <span class="text-red-400">{{$message}}</span>
                            @enderror
                            <x-aaran-ui::input.floating wire:model="mobile" label="Mobile"/>
                            <x-aaran-ui::input.floating wire:model="whatsapp" label="Whatsapp"/>
                            <x-aaran-ui::input.floating wire:model="contact_person" label="Contact Person"/>
                            <x-aaran-ui::input.floating wire:model.live="gstin" label="GST No"/>
                            @error('gstin')
                            <span class="text-red-400">{{$message}}</span>
                            @enderror
                            <x-aaran-ui::input.floating wire:model="email" label="Email"/>

                        </div>

                        <!-- Right area ------------------------------------------------------------------------------->

                        <div class="lg:w-1/2 flex flex-col gap-3">

                            <div x-data="{
                                    openTab: 0,
                                    activeClasses: 'border-l border-t border-r rounded-t text-blue-700',
                                    inactiveClasses: 'text-blue-500 hover:text-blue-700'
                                }" class="space-y-1">
                                <ul class="flex items-center border-b overflow-x-scroll space-x-2">
                                    <li x-on:click="$wire.sortSearch('{{0}}')" @click="openTab = 0"
                                        :class="{ '-mb-px': openTab === 0 }" class="-mb-px">
                                        <a href="#" :class="openTab === 0 ? activeClasses : inactiveClasses"
                                           class="bg-white inline-block py-3 px-4 font-semibold ">
                                            Primary
                                        </a>
                                    </li>
                                    @foreach($secondaryAddress as $index => $row)
                                        <li @click="openTab = {{$row}}" :class="{ '-mb-px': openTab === {{$row}} }"
                                            class="mr-1 ">
                                            <!-- Set active class by using :class provided by Alpine -->
                                            <div class="inline-flex gap-2 py-2 px-4"
                                                 :class="openTab === {{$row}} ? activeClasses : inactiveClasses">
                                                <a href="#" x-on:click="$wire.sortSearch('{{$row}}')"
                                                   class="bg-white inline-block   font-semibold">
                                                    <span>Secondary</span>
                                                </a>
                                                <button class="hover:text-red-400 pt-1" @click="openTab = {{$row-1}}"
                                                        wire:click="removeAddress('{{$index}}','{{$row}}')">
                                                    <x-aaran-ui::icons.icon :icon="'x-mark'" class="block h-4 w-4"/>
                                                </button>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="mr-1">
                                        <button :class="inactiveClasses"
                                                class="bg-white inline-block py-2 px-4 font-semibold"
                                                wire:click="addAddress('{{$addressIncrement}}')">
                                            + Add
                                        </button>
                                    </li>
                                </ul>

                                <div class="w-full">
                                    <div x-show="openTab === 0" class="py-2">
                                        <div class="flex flex-col gap-3">

                                            <x-aaran-ui::input.floating wire:model.live="itemList.{{0}}.address_1"
                                                              label="Address"/>
                                            @error('itemList.0.address_1')
                                            <span class="text-red-400"> {{$message}}</span>
                                            @enderror
                                            <x-aaran-ui::input.floating wire:model.live="itemList.{{0}}.address_2"
                                                              label="Area-Road"/>
                                            @error('itemList.0.address_2')
                                            <span class="text-red-400">{{$message}}</span>
                                            @enderror

                                            <x-aaran-ui::dropdown.wrapper label="City" type="cityTyped">
                                                <div class="relative ">
                                                    <x-aaran-ui::dropdown.input label="City" id="city_name"
                                                                      wire:model.live="itemList.{{0}}.city_name"
                                                                      wire:keydown.arrow-up="decrementCity"
                                                                      wire:keydown.arrow-down="incrementCity"
                                                                      wire:keydown.enter="enterCity({{0}})"/>
                                                    <x-aaran-ui::dropdown.select>
                                                        @if($cityCollection)
                                                            @forelse ($cityCollection as $i => $city)
                                                                <x-aaran-ui::dropdown.option
                                                                    highlight="{{$highlightCity === $i  }}"
                                                                    wire:click.prevent="setCity('{{$city->vname}}','{{$city->id}}','{{0}}')">
                                                                    {{ $city->vname }}
                                                                </x-aaran-ui::dropdown.option>
                                                            @empty
                                                                <x-aaran-ui::dropdown.new
                                                                    wire:click.prevent="citySave('{{ $itemList[0]['city_name'] }}','{{0}}')"
                                                                    label="City"/>
                                                            @endforelse
                                                        @endif
                                                    </x-aaran-ui::dropdown.select>
                                                </div>
                                            </x-aaran-ui::dropdown.wrapper>
                                            @error('itemList.0.city_name')
                                            <span class="text-red-400"> {{$message}}</span>
                                            @enderror

                                            <!-- State ------------------------------------------------------------------>
                                            <x-aaran-ui::dropdown.wrapper label="State" type="stateTyped">
                                                <div class="relative ">
                                                    <x-aaran-ui::dropdown.input label="State" id="state_name"
                                                                      wire:model.live="itemList.{{0}}.state_name"
                                                                      wire:keydown.arrow-up="decrementState"
                                                                      wire:keydown.arrow-down="incrementState"
                                                                      wire:keydown.enter="enterState({{0}})"/>
                                                    <x-aaran-ui::dropdown.select>
                                                        @if($stateCollection)
                                                            @forelse ($stateCollection as $i => $states)
                                                                <x-aaran-ui::dropdown.option
                                                                    highlight="{{$highlightState === $i  }}"
                                                                    wire:click.prevent="setState('{{$states->vname}}','{{$states->id}}','{{0}}')">
                                                                    {{ $states->vname }}
                                                                </x-aaran-ui::dropdown.option>
                                                            @empty
                                                                <x-aaran-ui::dropdown.new
                                                                    wire:click.prevent="stateSave('{{ $itemList[0]['state_name'] }}','{{0}}')"
                                                                    label="State"/>
                                                            @endforelse
                                                        @endif
                                                    </x-aaran-ui::dropdown.select>
                                                </div>
                                            </x-aaran-ui::dropdown.wrapper>
                                            @error('itemList.0.state_name')
                                            <span class="text-red-400"> {{$message}}</span>
                                            @enderror

                                            <!-- Pincode ------------------------------------------------------------------>

                                            <x-aaran-ui::dropdown.wrapper label="Pincode" type="pincodeTyped">
                                                <div class="relative ">
                                                    <x-aaran-ui::dropdown.input label="Pincode" id="pincode_name"
                                                                      wire:model.live="itemList.{{0}}.pincode_name"
                                                                      wire:keydown.arrow-up="decrementPincode"
                                                                      wire:keydown.arrow-down="incrementPincode"
                                                                      wire:keydown.enter="enterPincode({{0}})"/>
                                                    <x-aaran-ui::dropdown.select>
                                                        @if($pincodeCollection)
                                                            @forelse ($pincodeCollection as $i => $pincode)
                                                                <x-aaran-ui::dropdown.option
                                                                    highlight="{{$highlightPincode === $i  }}"
                                                                    wire:click.prevent="setPincode('{{$pincode->vname}}','{{$pincode->id}}','{{0}}')">
                                                                    {{ $pincode->vname }}
                                                                </x-aaran-ui::dropdown.option>
                                                            @empty
                                                                <x-aaran-ui::dropdown.new
                                                                    wire:click.prevent="pincodeSave('{{$itemList[0]['pincode_name'] }}','{{0}}')"
                                                                    label="Pincode"/>
                                                            @endforelse
                                                        @endif
                                                    </x-aaran-ui::dropdown.select>
                                                </div>
                                            </x-aaran-ui::dropdown.wrapper>
                                            @error('itemList.0.pincode_name')
                                            <span class="text-red-400"> {{$message}}</span>
                                            @enderror

                                            <!-- Country -------------------------------------------------------------------------->
                                            <x-aaran-ui::dropdown.wrapper label="Country" type="countryTyped">
                                                <div class="relative ">
                                                    <x-aaran-ui::dropdown.input label="Country" id="country_name"
                                                                      wire:model.live="itemList.{{0}}.country_name"
                                                                      wire:keydown.arrow-up="decrementCountry"
                                                                      wire:keydown.arrow-down="incrementCountry"
                                                                      wire:keydown.enter="enterCountry('{{0}}')"/>
                                                    <x-aaran-ui::dropdown.select>
                                                        @if($countryCollection)
                                                            @forelse ($countryCollection as $i => $country)
                                                                <x-aaran-ui::dropdown.option
                                                                    highlight="{{$highlightCountry === $i  }}"
                                                                    wire:click.prevent="setCountry('{{$country->vname}}','{{$country->id}}','{{0}}')">
                                                                    {{ $country->vname }}
                                                                </x-aaran-ui::dropdown.option>
                                                            @empty
                                                                <x-aaran-ui::dropdown.new
                                                                    wire:click.prevent="countrySave('{{$itemList[0]['country_name']}}','{{0}}')"
                                                                    label="Country"/>
                                                            @endforelse
                                                        @endif
                                                    </x-aaran-ui::dropdown.select>
                                                </div>
                                            </x-aaran-ui::dropdown.wrapper>
                                            @error('itemList.0.country_name')
                                            <span class="text-red-400"> {{$message}}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    @foreach( $secondaryAddress as $index => $row )
                                        <div x-show="openTab === {{$row}}" class="p-2">

                                            <div class="flex flex-col gap-3">

                                                <x-aaran-ui::input.floating wire:model.live="itemList.{{$row}}.address_1"
                                                                  label="Address"/>
                                                <x-aaran-ui::input.floating wire:model.live="itemList.{{$row}}.address_2"
                                                                  label="Area-Road"/>

                                                <x-aaran-ui::dropdown.wrapper label="City" type="cityTyped">
                                                    <div class="relative ">
                                                        <x-aaran-ui::dropdown.input label="City" id="city_name"
                                                                          wire:model.live="itemList.{{$row}}.city_name"
                                                                          wire:keydown.arrow-up="decrementCity"
                                                                          wire:keydown.arrow-down="incrementCity"
                                                                          wire:keydown.enter="enterCity('{{$row}}')"/>
                                                        <x-aaran-ui::dropdown.select>
                                                            @if($cityCollection)
                                                                @forelse ($cityCollection as $i => $city)
                                                                    <x-aaran-ui::dropdown.option
                                                                        highlight="{{$highlightCity === $i  }}"
                                                                        wire:click.prevent="setCity('{{$city->vname}}','{{$city->id}}','{{$row}}')">
                                                                        {{ $city->vname }}
                                                                    </x-aaran-ui::dropdown.option>
                                                                @empty
                                                                    <button
                                                                        wire:click.prevent="citySave('{{$itemList[$row]['city_name']}}','{{$row}}')"
                                                                        class="text-white bg-green-500 text-center w-full">
                                                                        create
                                                                    </button>
                                                                @endforelse
                                                            @endif
                                                        </x-aaran-ui::dropdown.select>
                                                    </div>
                                                </x-aaran-ui::dropdown.wrapper>

                                                <x-aaran-ui::dropdown.wrapper label="State" type="stateTyped">
                                                    <div class="relative ">
                                                        <x-aaran-ui::dropdown.input label="State" id="state_name"
                                                                          wire:model.live="itemList.{{$row}}.state_name"
                                                                          wire:keydown.arrow-up="decrementState"
                                                                          wire:keydown.arrow-down="incrementState"
                                                                          wire:keydown.enter="enterState('{{$row}}')"/>
                                                        <x-aaran-ui::dropdown.select>
                                                            @if($stateCollection)
                                                                @forelse ($stateCollection as $i => $states)
                                                                    <x-aaran-ui::dropdown.option
                                                                        highlight="{{$highlightState === $i  }}"
                                                                        wire:click.prevent="setState('{{$states->vname}}','{{$states->id}}','{{$row}}')">
                                                                        {{ $states->vname }}
                                                                    </x-aaran-ui::dropdown.option>
                                                                @empty
                                                                    <button
                                                                        wire:click.prevent="stateSave('{{$itemList[$row]['state_name']}}','{{$row}}')"
                                                                        class="text-white bg-green-500 text-center w-full">
                                                                        create
                                                                    </button>
                                                                @endforelse
                                                            @endif
                                                        </x-aaran-ui::dropdown.select>
                                                    </div>
                                                </x-aaran-ui::dropdown.wrapper>

                                                <x-aaran-ui::dropdown.wrapper label="Pincode" type="pincodeTyped">
                                                    <div class="relative ">
                                                        <x-aaran-ui::dropdown.input label="Pincode" id="pincode_name"
                                                                          wire:model.live="itemList.{{$row}}.pincode_name"
                                                                          wire:keydown.arrow-up="decrementPincode"
                                                                          wire:keydown.arrow-down="incrementPincode"
                                                                          wire:keydown.enter="enterPincode('{{$row}}')"/>
                                                        <x-aaran-ui::dropdown.select>
                                                            @if($pincodeCollection)
                                                                @forelse ($pincodeCollection as $i => $pincode)
                                                                    <x-aaran-ui::dropdown.option
                                                                        highlight="{{$highlightPincode === $i  }}"
                                                                        wire:click.prevent="setPincode('{{$pincode->vname}}','{{$pincode->id}}','{{$row}}')">
                                                                        {{ $pincode->vname }}
                                                                    </x-aaran-ui::dropdown.option>
                                                                @empty
                                                                    <button
                                                                        wire:click.prevent="pincodeSave('{{$itemList[$row]['pincode_name']}}','{{$row}}')"
                                                                        class="text-white bg-green-500 text-center w-full">
                                                                        create
                                                                    </button>
                                                                @endforelse
                                                            @endif
                                                        </x-aaran-ui::dropdown.select>
                                                    </div>
                                                </x-aaran-ui::dropdown.wrapper>

                                                <x-aaran-ui::dropdown.wrapper label="Country" type="countryTyped">
                                                    <div class="relative ">

                                                        <x-aaran-ui::dropdown.input label="Country" id="country_name"
                                                                          wire:model.live="itemList.{{$row}}.country_name"
                                                                          wire:keydown.arrow-up="decrementCountry"
                                                                          wire:keydown.arrow-down="incrementCountry"
                                                                          wire:keydown.enter="enterCountry('{{$row}}')"/>

                                                        <x-aaran-ui::dropdown.select>
                                                            @if($countryCollection)

                                                                @forelse ($countryCollection as $i => $country)
                                                                    <x-aaran-ui::dropdown.option
                                                                        highlight="{{$highlightCountry === $i  }}"
                                                                        wire:click.prevent="setCountry('{{$country->vname}}','{{$country->id}}','{{$row}}')">
                                                                        {{ $country->vname }}
                                                                    </x-aaran-ui::dropdown.option>

                                                                @empty

                                                                    <button
                                                                        wire:click.prevent="countrySave('{{$itemList[$row]['country_name']}}','{{$row}}')"
                                                                        class="text-white bg-green-500 text-center w-full">
                                                                        create
                                                                    </button>
                                                                @endforelse
                                                            @endif

                                                        </x-aaran-ui::dropdown.select>
                                                    </div>
                                                </x-aaran-ui::dropdown.wrapper>

                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                </x-aaran-ui::tabs.content>

                <x-aaran-ui::tabs.content>

                    <div class="flex flex-col gap-3">

                        <x-aaran-ui::dropdown.wrapper label="Contact Type" type="contactTypeTyped">
                            <div class="relative ">
                                <x-aaran-ui::dropdown.input label="Contact Type" id="contact_type_name"
                                                  wire:model.live="contact_type_name"
                                                  wire:keydown.arrow-up="decrementContactType"
                                                  wire:keydown.arrow-down="incrementContactType"
                                                  wire:keydown.enter="enterContactType"/>
                                <x-aaran-ui::dropdown.select>
                                    @if($contactTypeCollection)
                                        @forelse ($contactTypeCollection as $i => $contactType)
                                            <x-aaran-ui::dropdown.option highlight="{{$highlightContactType === $i  }}"
                                                               wire:click.prevent="setContactType('{{$contactType->vname}}','{{$contactType->id}}')">
                                                {{ $contactType->vname }}
                                            </x-aaran-ui::dropdown.option>
                                        @empty
                                            <x-aaran-ui::dropdown.create
                                                wire:click.prevent="contactTypeSave('{{$contact_type_name}}')"
                                                label="Contact Type"/>
                                        @endforelse
                                    @endif
                                </x-aaran-ui::dropdown.select>
                            </div>
                        </x-aaran-ui::dropdown.wrapper>

                        <x-aaran-ui::input.floating wire:model="msme_no" label="MSME No"/>

                        <x-aaran-ui::dropdown.wrapper label="MSME Type" type="MsmeTypeTyped">
                            <div class="relative ">
                                <x-aaran-ui::dropdown.input label="MSME Type" id="msme_type_name" wire:model.live="msme_type_name"
                                                  wire:keydown.arrow-up="decrementMsmeType"
                                                  wire:keydown.arrow-down="incrementMsmeType"
                                                  wire:keydown.enter="enterMsmeType"/>
                                <x-aaran-ui::dropdown.select wire:model="msme_type_id">
                                    @if($msmeTypeCollection)
                                        @foreach ($msmeTypeCollection as $msmeType)
                                            <x-aaran-ui::dropdown.option
                                                :highlight="$highlightMsmeType === $loop->index"
                                                wire:click.prevent="setMsmeType('{{ $msmeType['id'] }}')">
                                                {{ $msmeType['vname'] }}
                                            </x-aaran-ui::dropdown.option>
                                        @endforeach
                                    @endif
                                </x-aaran-ui::dropdown.select>
                            </div>
                        </x-aaran-ui::dropdown.wrapper>

                        <x-aaran-ui::input.floating wire:model="opening_balance" label="Opening Balance"/>

{{--                        <x-input.floating wire:model="outstanding" label="Outstanding"/>--}}

                        <x-aaran-ui::input.model-date wire:model="effective_from" :label="'Opening Date'"/>
                    </div>
                </x-aaran-ui::tabs.content>

            </x-slot>
        </x-aaran-ui::tabs.tab-panel>
    </x-aaran-ui::forms.m-panel-auto>

    <!-- Save Button area --------------------------------------------------------------------------------------------->
    <x-aaran-ui::forms.m-panel-bottom-button active save back/>

    <div class="px-10 py-16 space-y-4">
{{--        @if(!$log->isEmpty())--}}
{{--            <div class="text-xs text-orange-600  font-merri underline underline-offset-4">Activity</div>--}}
{{--        @endif--}}
{{--        @foreach($log as $row)--}}
{{--            <div class="px-6">--}}
{{--                <div class="relative">--}}
{{--                    <div class=" border-l-[3px] border-dotted px-8 text-[10px]  tracking-wider py-3">--}}
{{--                        <div class="flex gap-x-5 ">--}}
{{--                            <div class="inline-flex text-gray-500 items-center font-sans font-semibold">--}}
{{--                                <span>Model:</span> <span>{{$row->vname}}</span></div>--}}
{{--                            <div class="inline-flex  items-center space-x-1 font-merri"><span--}}
{{--                                    class="text-blue-600">@</span><span--}}
{{--                                    class="text-gray-500">{{$row->user->name}}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div--}}
{{--                            class="text-gray-400 text-[8px] font-semibold">{{date('M d, Y', strtotime($row->created_at))}}</div>--}}
{{--                        <div class="pb-2 font-lex leading-5 py-2 text-justify">{!! $row->description !!}</div>--}}
{{--                    </div>--}}
{{--                    <div class="absolute top-0 -left-1 h-2.5 w-2.5  rounded-full bg-teal-600 "></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    </div>
</div>
