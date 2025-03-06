@props([
    'left' => false,
    'center' => false,
    'right' => false,
])
<td {{$attributes->class(['p-4 border-r border-neutral-300', 'text-left'=>$left,
    'text-center'=>$center,
    'text-right'=>$right,])}}>
    <div class="inline-flex items-center gap-x-3">
        <div class="flex items-center gap-x-2">
            <img class="object-cover w-10 h-10 rounded-full"
                 src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                 alt="">
            <div>
                <h2 class="font-medium text-gray-800 dark:text-white ">Arthur
                    Melo</h2>
                <p class="text-sm font-normal text-gray-600 dark:text-gray-400">
                    @authurmelo</p>
            </div>
        </div>
    </div>
</td>
