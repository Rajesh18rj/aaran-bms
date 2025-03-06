@props([
    'list' => null
])
<div class="w-10/12 mx-auto">
    @foreach($list as $row)

        <div class="flex   bg-white">
            <div>
                <div class="relative w-full mx-auto">

                    <div class="mt-6 border-l-4 border-dotted px-4 space-y-3">
                        <div class="flex gap-x-5">
                            <div>{{$row->vname}}</div>
                            <div>{{$row->user->name}}</div>
                        </div>
                        <div class="text-gray-600 text-xs font-semibold">{{date('M d, Y', strtotime($row->created_at))}}</div>
                        <div class="text-sm leading-5 tracking-wider">{{$row->description}}</div>
                    </div>
                    <div class="absolute top-0 -ml-1 h-3 w-3 rounded-full bg-teal-600"></div>
                </div>
            </div>
        </div>
    @endforeach

</div>

