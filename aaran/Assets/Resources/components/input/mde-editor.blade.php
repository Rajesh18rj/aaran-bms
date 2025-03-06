@props([
    'height'=>'h-64',
    'placeholder'
])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/1.11/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/1.11/simplemde.min.js"></script>


<div
    wire:model = "content"
    wire:ignore.self
    x-data="{
        init() {
            let editor = new SimpleMDE({ element: this.$refs.editor })

            editor.value(this.value)

            editor.codemirror.on('change', () => {
                this.value = editor.value()
            })
        },
    }"
    class="prose w-full"
    >
    <textarea x-ref="editor" class="{{$height}}" placeholder="{{$placeholder}}"></textarea>
</div>
