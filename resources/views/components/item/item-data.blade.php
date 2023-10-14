@props(['target_id'])
<div id="{{ $target_id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
    <div class="accordion-body">
        <strong>{{ $slot }}</strong>
    </div>
</div>
