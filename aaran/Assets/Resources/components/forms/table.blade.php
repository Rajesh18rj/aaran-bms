<div class="flex-col space-y-4">
    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-cool-gray-200">
            <thead>
            <tr>
                @if(isset($table_header))
                    {{$table_header}}
                @endif

            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-cool-gray-200">
            @if(isset($table_body))
                {{$table_body}}
            @endif
            </tbody>
        </table>
    </div>
    <div class="py-2">
        @if(isset($table_pagination))
            {{$table_pagination}}
        @endif
    </div>
</div>
