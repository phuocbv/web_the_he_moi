var profile = function() {

    this.firebase = null;

    this.init = function(firebase) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (typeof firebase !== 'undefined') {
            this.firebase = firebase;
        }
        this.addEvent();
    };    

    this.addEvent = function() {
        var current = this;
        current.firebase.changeElement(current.element);
        $('#fileUpload').on('change', function() {
            $('#bound').show();
            current.firebase.uploadImage();
        });
        $('.btn-primary').on('click', function(event) {
            event.preventDefault();
            if (current.firebase.getUrlImage()) {
                current.update(current.firebase.getUrlImage());
            } else {
                current.update($('#avatar').attr('default'));
            }
        });
    };

    this.element = {
        input_file: 'fileUpload',
        img_circle: '.img-circle',
        progress: '#progress',
        input_file_logo: null,
    };

    this.update = function(avatar_url) {
        var new_name = $('#name').val();
        var new_phone = $('#phone').val();
        var users = $('#name').attr('users');
        $.ajax({
            url: '/users/' + users,
            type: 'patch',
            async: false,
            data: {
                name: new_name,
                avatar: avatar_url,
                phone: new_phone
            },
        })
        .done(function(data) {
            if (data == null || data == '') {
                $('#username').html(new_name);
                swal('Success!', '', 'success');
            } else {
                swal('Error', data, 'error');
            }
        })
        .fail(function() {
            swal('Error', '', 'error');
        });
    };
}
