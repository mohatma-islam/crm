@if ($errors->any())
    <ul class="alert alert-danger ps-4">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
