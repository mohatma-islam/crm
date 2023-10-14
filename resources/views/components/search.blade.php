@props(['name', 'value', 'placeholder'])
<form method="GET" action="#">
    <div class="input-group">
        <input class="form-control" type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
        <div class="input-group-append">
            <button class="btn btn-warning h-100" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>
</form>
