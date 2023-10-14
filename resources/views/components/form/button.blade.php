@props(['model', 'type' => 'submit'])
<button type="{{ $type }}" class="btn btn-primary">
    @if ($model->exists)
        Update
    @else
        Create
    @endif
</button>