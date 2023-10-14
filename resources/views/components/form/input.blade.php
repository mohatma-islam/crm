@props(['model', 'type', 'name'])

<x-form.field>
    <x-form.label name="{{ $name }}" />
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" 
    value="{{ old($name, $model->$name) }}" id="{{ $name }}">
</x-form.field>