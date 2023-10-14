@props(['model'])
<div>
    {{ $model->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
</div>
