@props(['name', 'selection_type'])

<x-form.field>
    <x-form.label name="{{ $name }}" />

    <select class="form-select select2" name="{{ $name }}" id="{{ $name }}"
     {{ isset($selection_type) ? $selection_type : '' }}>
        <option value="">Please Select</option>
        {{ $slot }}
    </select>

</x-form.field>