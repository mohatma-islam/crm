@props(['name'])

<x-form.field>
    <x-form.label name="{{ $name }}"/>

    <select class="form-select" name="{{ $name }}" id="{{ $name }}">
        <option value="">Please Select</option>
        {{ $slot }}
    </select>

</x-form.field>