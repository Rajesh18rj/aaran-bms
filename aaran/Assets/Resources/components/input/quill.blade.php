@props([
    'height' => 'h-64',
    'width' => 'w-full',
    'placeholder' => null
])

<div wire:ignore.self class="rounded-md shadow-sm">
    <div x-data="{
            value: @entangle($attributes->wire('model')),
            init() {
                $(this.$refs.summernote).summernote({
                    height: '{{ $height }}',
                    placeholder: '{{ $placeholder }}',
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link', 'picture']],
                        ['view', ['fullscreen', 'codeview']]
                    ],
                    callbacks: {
                        onChange: (contents, $editable) => {
                            this.value = contents;
                        }
                    }
                });
            }
        }" x-init="init()">

        <div x-ref="summernote" style="width: {{ $width }};"></div>
    </div>
</div>

<!-- Include Summernote CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
