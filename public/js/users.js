var users = function() {
    this.init = function() {
        this.addEvent();
    }

    this.addEvent = function() {
        $('.btn-danger').click(function(event) {
            event.preventDefault();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $('#'+$('#delete').attr('user-id')).submit();
            });
        });
    }
}
