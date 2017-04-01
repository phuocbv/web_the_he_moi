var collection = function() {

    this.table = null;

    this.init = function(table) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        this.table = table;
        this.update();
        this.remove();
    }

    this.update = function() {
        var dataId;
        var current = this;
        $('.update').on('click', function() {
            dataId = $(this).data('id');
            $('#nameCollection').val($('#collection-' + dataId).html());
        });

        $('.edit-collection').on('click', '.btn-primary', function() {
            $.ajax({
                type: 'POST',
                url: '/user/collection/updateAjax',
                data: {
                    id: dataId,
                    name: $('#nameCollection').val()
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    $('#collection-' + dataId).html($('#nameCollection').val());
                    $('.modal').modal('hide');
                    current.table.clear();
                    current.table.fnDraw();
                }
            });
        });
    }

    this.remove = function() {
        var dataId;
        var current = this;
        $('.delete').on('click', function () {
            dataId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/user/collection/deleteAjax',
                data: { 
                    id: dataId 
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    alert(data.sms);
                }
            });
            $(this).parent().parent().remove();
            current.table.clear();
            current.table.fnDraw();
        });
    }
}
