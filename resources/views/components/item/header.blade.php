@props(['data_target'])
<h2 class="accordion-header" id="headingTwo">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="{{ $data_target }}" aria-expanded="false" aria-controls="one">
        {{ $slot }}
    </button>
</h2>