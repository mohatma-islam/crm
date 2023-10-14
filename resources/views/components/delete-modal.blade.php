@props(['action'])
<div class="modal fade" id="ModalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ $action }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $slot }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    Are you sure you want to delete?
                    <input id="id" name="id" hidden value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-target="#ModalDelete">Confirm</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    $(document).on('click', '.delete', function() {
        let id = $(this).attr('data-id');
        console.log(id);
        $('#id').val(id);
    });
</script>
