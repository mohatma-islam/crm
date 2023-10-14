@props(['model','name', 'value'])

<x-form.field>
    
    <x-form.label name="{{ $name }}" />

    {{-- Checking if checkbox button is clicked or not --}}
    <input class="form-check-input" type="checkbox" name="{{ $name }}" value="{{ $value }}"
        @if ($model->exists)
        {{-- if model is found then get data from database or use old data for validation  --}}
        {{ old($name, $model->$name) ? 'checked' : '' }}>
        @else
        {{-- Otherwise, old user data for validatoin --}}
        {{ old($name) == $value ? 'checked' : '' }}> 
        @endif
</x-form.field>
