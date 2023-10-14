@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 p-3 m-3" id="myAlert"
        role="alert" style="width: 400px;">
        <i class="bi bi-check-circle-fill me-2"></i> {!! session('success') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



<script>
    setTimeout(function() {
        var alert = document.getElementById('myAlert');
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    }, 4000);
</script>
