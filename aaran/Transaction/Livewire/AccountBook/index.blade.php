<div>
    <x-slot name="header">
        @if($filter == 2)
            Bank Books
        @elseif($filter == 3)
            Cash Books
        @elseif($filter == 4)
            UPI
        @else
            Account Books
        @endif
    </x-slot>

    <x-aaran-ui::forms.m-panel>
        <x-aaran-ui::alerts.notification />

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-aaran-ui::forms.top-controls :show-filters="$showFilters"/>

        @if($filter == 2)
            <x-aaran-ui::table.caption :caption="'Bank Books'">
                {{$list->count()}}
            </x-aaran-ui::table.caption>
        @elseif($filter == 3)
            <x-aaran-ui::table.caption :caption="'Cash Books'">
                {{$list->count()}}
            </x-aaran-ui::table.caption>

        @elseif($filter == 4)
            <x-aaran-ui::table.caption :caption="'UPI'">
                {{$list->count()}}
            </x-aaran-ui::table.caption>

        @else
            <x-aaran-ui::table.caption :caption="'Account Books'">
                {{$list->count()}}
            </x-aaran-ui::table.caption>
        @endif


        <div class="grid grid-cols-3 gap-8 justify-items-center py-8">

            <x-aaran-ui::cards.card-4 :list="$list" :data="$transaction" :filter="$filter"/>
{{--            <x-aaran-ui::cards.card-4 :list="$list" :data="collect($transaction)" :filter="$filter"/>--}}


        </div>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-aaran-ui::forms.create :id="$common->vid">

            <div class="flex flex-col gap-3">

                <div class="w-full flex flex-col gap-4">
                    <x-aaran-ui::input.model-select wire:model.live="trans_type_id">
                        <option value="Select" selected>Choose</option>
                        <option value="108">Cash -Ac</option>
                        <option value="109">Bank -Ac</option>
                        <option value="136">UPI -Ac</option>
                    </x-aaran-ui::input.model-select>

                    <div>
                        <x-aaran-ui::input.floating wire:model.live="common.vname" label="Account Name"/>
                        @error('common.vname')
                        <div class="text-xs text-red-500">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    {{--                    @if( $trans_type_id == 136)--}}
                    {{--                        <div>--}}
                    {{--                            <x-input.floating wire:model.live="account_no" label="UPI ID"/>--}}
                    {{--                            @error('account_no')--}}
                    {{--                            <div class="text-xs text-red-500">--}}
                    {{--                                {{$message}}--}}
                    {{--                            </div>--}}
                    {{--                            @enderror--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}

                </div>

                @if($trans_type_id == 109)

                    <div>
                        <x-aaran-ui::input.floating wire:model.live="account_no" label="Account No"/>
                        @error('account_no')
                        <div class="text-xs text-red-500">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <x-aaran-ui::input.floating wire:model.live="ifsc_code" label="IFSC Code"/>
                        @error('ifsc_code')
                        <div class="text-xs text-red-500">
                            {{$message}}
                        </div>
                        @enderror
                    </div>


                    <x-aaran-ui::dropdown.wrapper label="Account Type" type="account_typeTyped">

                        <div class="relative">

                            <x-aaran-ui::dropdown.input label="Account Type" id="account_type_name"
                                              wire:model.live="account_type_name"
                                              wire:keydown.arrow-up="decrementAccountType"
                                              wire:keydown.arrow-down="incrementAccountType"
                                              wire:keydown.enter="enterAccountType"/>

                            <x-aaran-ui::dropdown.select>
                                @if($account_typeCollection)

                                    @forelse ($account_typeCollection as $i => $account_type)
                                        <x-aaran-ui::dropdown.option highlight="{{$highlightAccountType === $i}}"
                                                           wire:click.prevent="setAccountType('{{$account_type->vname}}','{{$account_type->id}}')">
                                            {{ $account_type->vname }}
                                        </x-aaran-ui::dropdown.option>

                                    @empty
                                        <x-aaran-ui::dropdown.new wire:click.prevent="accountTypeSave('{{$account_type_name}}')"
                                                        label="Account Type"/>
                                    @endforelse
                                @endif

                            </x-aaran-ui::dropdown.select>
                        </div>
                        @error('account_type_id')
                        <div class="text-xs text-red-500">
                            {{$message}}
                        </div>
                        @enderror
                    </x-aaran-ui::dropdown.wrapper>

                    <x-aaran-ui::input.floating wire:model.live="branch" label="Branch"/>

                @endif

                @if($trans_type_id == 109 || $trans_type_id == 136)
                    <x-aaran-ui::dropdown.wrapper label="Bank" type="bankTyped">

                        <div class="relative">

                            <x-aaran-ui::dropdown.input label="Bank" id="bank_name"
                                              wire:model.live="bank_name"
                                              wire:keydown.arrow-up="decrementBank"
                                              wire:keydown.arrow-down="incrementBank"
                                              wire:keydown.enter="enterBank"/>

                            <x-aaran-ui::dropdown.select>
                                @if($bankCollection)

                                    @forelse ($bankCollection as $i => $bank)
                                        <x-aaran-ui::dropdown.option highlight="{{$highlightBank === $i}}"
                                                           wire:click.prevent="setBank('{{$bank->vname}}','{{$bank->id}}')">
                                            {{ $bank->vname }}
                                        </x-aaran-ui::dropdown.option>

                                    @empty
                                        <x-aaran-ui::dropdown.new wire:click.prevent="bankSave('{{$bank_name}}')"
                                                        label="Bank"/>
                                    @endforelse
                                @endif

                            </x-aaran-ui::dropdown.select>
                        </div>
                        @error('bank_id')
                        <div class="text-xs text-red-500">
                            {{$message}}
                        </div>
                        @enderror


                    </x-aaran-ui::dropdown.wrapper>
                @endif

                <x-aaran-ui::input.floating wire:model.live="opening_balance" label="Opening Balance"/>

                <x-aaran-ui::input.floating wire:model.live="opening_balance_date" type="date" label="Opening Balance date"/>

                <x-aaran-ui::input.floating wire:model.live="notes" label="Notes"/>


            </div>
        </x-aaran-ui::forms.create>

    </x-aaran-ui::forms.m-panel>

    <x-aaran-ui::modal.delete/>

</div>
