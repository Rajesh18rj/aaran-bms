<div>
    <x-slot name="header">Products</x-slot>

    <x-aaran-ui::forms.m-panel>
        <x-aaran-ui::alerts.notification />


        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-aaran-ui::forms.top-controls :show-filters="$showFilters"/>

        <x-aaran-ui::table.caption :caption="'Products'">
            {{$list->count()}}
        </x-aaran-ui::table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->

        <x-aaran-ui::table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-aaran-ui::table.header-serial width="20%"/>

                <x-aaran-ui::table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">Product
                </x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text sortIcon="none">Product&nbsp;Type</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-text sortIcon="none">HSN&nbsp;Code</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Gst&nbsp;Percent</x-aaran-ui::table.header-text>
                <x-aaran-ui::table.header-text sortIcon="none">Opening&nbsp;qty</x-aaran-ui::table.header-text>

                <x-aaran-ui::table.header-action/>

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-aaran-ui::table.row>
                        <x-aaran-ui::table.cell-text>{{$index+1}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text left>{{$row->vname}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text>{{$row->producttype_name}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text>
                            {{  $row->hsncode_name }}
                        </x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text>{{  $row->gstpercent_name }}%
                        </x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-text>{{$row->initial_quantity+0}}</x-aaran-ui::table.cell-text>
                        <x-aaran-ui::table.cell-action id="{{$row->id}}"/>
                    </x-aaran-ui::table.row>

                @endforeach

            </x-slot:table_body>
        </x-aaran-ui::table.form>

        <x-aaran-ui::modal.delete/>
        <div class="">{{ $list->links() }}</div>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-aaran-ui::forms.create :id="$common->vid">

            <div class="flex flex-col gap-3">

                <!-- Product ------------------------------------------------------------------------------------------>

                <x-aaran-ui::input.floating wire:model.live="common.vname" label="Product Name"/>
                @error('common.vname')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <x-aaran-ui::dropdown.wrapper label="Product Type" type="producttypeTyped">

                    <div class="relative">
                        <x-aaran-ui::dropdown.input label="Product Type" id="producttype_name"
                                          wire:model.live="producttype_name"
                                          wire:keydown.arrow-up="decrementProductType"
                                          wire:keydown.arrow-down="incrementProductType"
                                          wire:keydown.enter="enterProductType"/>

                        <x-aaran-ui::dropdown.select>
                            @if($producttypeCollection)
                                @forelse (\Aaran\Assets\Enums\ProductType::cases() as $i => $producttype)

                                    <x-aaran-ui::dropdown.option highlight="{{$highlightProductType === $i  }}"
                                                       wire:click.prevent="setProductType('{{$producttype->name}}','{{$producttype->value}}')">
                                        {{ $producttype->getName() }}
                                    </x-aaran-ui::dropdown.option>

                                @empty
                                    <x-aaran-ui::dropdown.new wire:click.prevent="productTypeSave('{{$producttype_name}}')"
                                                    label="Product"/>
                                @endforelse
                            @endif

                        </x-aaran-ui::dropdown.select>
                    </div>
                </x-aaran-ui::dropdown.wrapper>


                <!-- HSN Code ----------------------------------------------------------------------------------------->

                <x-aaran-ui::dropdown.wrapper label="HSN Code" type="hsncodeTyped">

                    <div class="relative">

                        <x-aaran-ui::dropdown.input label="HSN Code" id="hsncode_name"
                                          wire:model.live="hsncode_name"
                                          wire:keydown.arrow-up="decrementHsncode"
                                          wire:keydown.arrow-down="incrementHsncode"
                                          wire:keydown.enter="enterHsncode"/>

                        <x-aaran-ui::dropdown.select>
                            @if($hsncodeCollection)

                                @forelse ($hsncodeCollection as $i => $hsncode)
                                    <x-aaran-ui::dropdown.option highlight="{{$highlightHsncode === $i  }}"
                                                       wire:click.prevent="setHsncode('{{$hsncode->vname}}','{{$hsncode->id}}')">
                                        {{ $hsncode->vname }}
                                    </x-aaran-ui::dropdown.option>

                                @empty
                                    <x-aaran-ui::dropdown.new wire:click.prevent="hsncodeSave('{{$hsncode_name}}')"
                                                    label="HSN Code"/>
                                @endforelse
                            @endif

                        </x-aaran-ui::dropdown.select>
                    </div>
                </x-aaran-ui::dropdown.wrapper>
                @error('hsncode_name')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <!-- Unit Type ---------------------------------------------------------------------------------------->

                <x-aaran-ui::dropdown.wrapper label="Unit" type="unitTyped">
                    <div class="relative ">
                        <x-aaran-ui::dropdown.input label="Unit" id="unit_name"
                                          wire:model.live="unit_name"
                                          wire:keydown.arrow-up="decrementUnit"
                                          wire:keydown.arrow-down="incrementUnit"
                                          wire:keydown.enter="enterUnit"/>
                        <x-aaran-ui::dropdown.select>
                            @if($unitCollection)
                                @forelse ($unitCollection as $i => $unit)
                                    <x-aaran-ui::dropdown.option highlight="{{$highlightUnit === $i  }}"
                                                       wire:click.prevent="setUnit('{{$unit->vname}}','{{$unit->id}}')">
                                        {{ $unit->vname }}
                                    </x-aaran-ui::dropdown.option>
                                @empty
                                    <x-aaran-ui::dropdown.new wire:click.prevent="unitSave('{{$unit_name}}')" label="Units"/>
                                @endforelse
                            @endif
                        </x-aaran-ui::dropdown.select>
                    </div>
                </x-aaran-ui::dropdown.wrapper>
                @error('unit_name')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <!-- GST Percent -------------------------------------------------------------------------------------->

                <x-aaran-ui::dropdown.wrapper label="GST Percent" type="gstpercentTyped">
                    <div class="relative ">
                        <x-aaran-ui::dropdown.input label="GST Percent" id="gstpercent_name"
                                          wire:model.live="gstpercent_name"
                                          wire:keydown.arrow-up="decrementGstPercent"
                                          wire:keydown.arrow-down="incrementGstPercent"
                                          wire:keydown.enter="enterGstPercent"/>
                        <x-aaran-ui::dropdown.select>
                            @if($gstpercentCollection)
                                @forelse ($gstpercentCollection as $i => $gstpercent)
                                    <x-aaran-ui::dropdown.option highlight="{{$highlightGstPercent === $i}}"
                                                       wire:click.prevent="setGstPercent('{{$gstpercent->vname}}','{{$gstpercent->id}}')">
                                        {{ $gstpercent->vname }}
                                    </x-aaran-ui::dropdown.option>
                                @empty
                                    <x-aaran-ui::dropdown.new wire:click.prevent="gstPercentSave('{{$gstpercent_name}}')"
                                                    label="GST Percent"/>
                                @endforelse
                            @endif

                        </x-aaran-ui::dropdown.select>
                        @error('gstpercent_name')
                        <span class="text-red-400">{{$message}}</span>
                        @enderror
                    </div>
                </x-aaran-ui::dropdown.wrapper>
                <x-aaran-ui::input.floating wire:model="quantity" label="Opening Quantity"/>
                <x-aaran-ui::input.floating wire:model="price" label="Opening Price"/>
            </div>

        </x-aaran-ui::forms.create>

        <!-- Actions ------------------------------------------------------------------------------------------->



    </x-aaran-ui::forms.m-panel>
{{--    <div class="px-10  py-16 space-y-4">--}}
{{--        @if(!$log->isEmpty())--}}
{{--            <div class="text-xs text-orange-600  font-merri underline underline-offset-4">Activity</div>--}}
{{--        @endif--}}
{{--        @foreach($log as $row)--}}
{{--            <div class="px-6">--}}
{{--                <div class="relative ">--}}
{{--                    <div class=" border-l-[3px] border-dotted px-8 text-[10px]  tracking-wider py-3">--}}
{{--                        <div class="flex gap-x-5 ">--}}
{{--                            <div class="inline-flex text-gray-500 items-center font-sans font-semibold">--}}
{{--                                <span>Invoice No:</span> <span>{{$row->vname}}</span></div>--}}
{{--                            <div class="inline-flex  items-center space-x-1 font-merri"><span--}}
{{--                                    class="text-blue-600">@</span><span class="text-gray-500">{{$row->user->name}}</span>--}}
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
{{--    </div>--}}
</div>
