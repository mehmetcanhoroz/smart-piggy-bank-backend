<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script>
    function deleteIt(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this! Related records will be deleted too!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: url,
                    type: "DELETE",
                    //data: {_token: ''},
                    success: function (data, textStatus, jqXHR) {
                        //data - response from server
                        Swal.fire(
                            'Deleted!',
                            data.message ? data.message : 'The record and related items have been deleted.',
                            'success'
                        ).then(function () {
                            location.reload();
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire(
                            'Error!',
                            jqXHR.responseJSON.message ? jqXHR.responseJSON.message : 'The record and related items couldn\'t be deleted.',
                            'error'
                        );
                    }
                });
            }
        })
    }
</script>
@stack('footer')
