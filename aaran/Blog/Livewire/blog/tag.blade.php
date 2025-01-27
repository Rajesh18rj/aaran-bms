<div>
    <x-slot name="header">Blog Tag</x-slot>

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Blog Tag'">
            {{$list->count()}}
        </x-table.caption>

        <x-table.form>
            <x-slot:table_header name="table_header">

                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')">
                    vname
                </x-table.header-text>

                <x-table.header-text wire:click.prevent="sortBy('common_id')" sortIcon="{{$getListForm->sortAsc}}">Blog
                    Category
                </x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>
                            {{\Aaran\Blog\Models\BlogTag::common($row->blogcategory_id)}}
                        </x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>

                @endforeach
            </x-slot:table_body>

        </x-table.form>
        <x-modal.delete/>

        <x-forms.create :id="$common->vid">

            <div class="flex flex-col  gap-3">

                <x-input.floating wire:model="common.vname" label="Tag Name"/>

                <x-dropdown.wrapper label="Blog Category" type="blogcategoryTyped">
                    <div class="relative ">
                        <x-dropdown.input label="Blog Category" id="blogcategory_name"
                                          wire:model.live="blogcategory_name"
                                          wire:keydown.arrow-up="decrementBlogcategory"
                                          wire:keydown.arrow-down="incrementBlogcategory"
                                          wire:keydown.enter="enterBlogcategory"/>
                        <x-dropdown.select>
                            @if($blogcategoryCollection)
                                @forelse ($blogcategoryCollection as $i => $blogcategory)
                                    <x-dropdown.option highlight="{{$highlightBlogCategory === $i  }}"
                                                       wire:click.prevent="setBlogcategory('{{$blogcategory->vname}}','{{$blogcategory->id}}')">
                                        {{ $blogcategory->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <button
                                        wire:click.prevent="blogcategorySave('{{$blogcategory_name}}')"
                                        class="text-white bg-green-500 text-center w-full">
                                        create
                                    </button>
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>

                {{--                <div class="flex flex-row py-3 gap-3">--}}
                {{--                    <div class="xl:flex w-full gap-2">--}}
                {{--                        <label for="blogcategory_name"--}}
                {{--                               class="w-[10rem] text-zinc-500 tracking-wide py-2">Blog Category</label>--}}
                {{--                        <div x-data="{isTyped: @entangle('blogcategoryTyped')}" @click.away="isTyped = false"--}}
                {{--                             class="w-full relative">--}}
                {{--                            <div>--}}
                {{--                                <input--}}
                {{--                                    id="blogcategory_name"--}}
                {{--                                    type="search"--}}
                {{--                                    wire:model.live="blogcategory_name"--}}
                {{--                                    autocomplete="off"--}}
                {{--                                    placeholder="Blog Category Name.."--}}
                {{--                                    @focus="isTyped = true"--}}
                {{--                                    @keydown.escape.window="isTyped = false"--}}
                {{--                                    @keydown.tab.window="isTyped = false"--}}
                {{--                                    @keydown.enter.prevent="isTyped = false"--}}

                {{--                                    class="block w-full rounded-lg"--}}
                {{--                                />--}}

                {{--                                <!-- HSN Code Dropdown -->--}}
                {{--                                <div x-show="isTyped"--}}
                {{--                                     x-transition:leave="transition ease-in duration-100"--}}
                {{--                                     x-transition:leave-start="opacity-100"--}}
                {{--                                     x-transition:leave-end="opacity-0"--}}
                {{--                                     x-cloak--}}
                {{--                                >--}}
                {{--                                    <div class="absolute z-20 w-full mt-2">--}}
                {{--                                        <div class="block py-1 shadow-md w-full rounded-lg border-transparent flex-1 appearance-none border--}}
                {{--                             bg-white text-gray-800 ring-1 ring-purple-600">--}}
                {{--                                            <ul class="overflow-y-scroll h-20">--}}
                {{--                                                @if($blogcategoryCollection)--}}
                {{--                                                    @forelse ($blogcategoryCollection as $i => $blogcategory)--}}
                {{--                                                        <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8--}}
                {{--                                            {{ $highlightBlogCategory === $i ? 'bg-yellow-100' : '' }}"--}}
                {{--                                                            wire:click.prevent="setBlogcategory('{{$blogcategory->vname}}','{{$blogcategory->id}}')"--}}
                {{--                                                            x-on:click="isTyped = false">--}}
                {{--                                                            {{ $blogcategory->vname }}--}}
                {{--                                                        </li>--}}
                {{--                                                    @empty--}}
                {{--                                                        <button--}}
                {{--                                                            wire:click.prevent="blogcategorySave('{{$blogcategory_name}}')"--}}
                {{--                                                            class="text-white bg-green-500 text-center w-full">--}}
                {{--                                                            create--}}
                {{--                                                        </button>--}}
                {{--                                                    @endforelse--}}
                {{--                                                @endif--}}
                {{--                                            </ul>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
