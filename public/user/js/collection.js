var collection = function() {
    this.init = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        $('#collection').on('click', '.btn-success', function(event) {
            event.preventDefault();
            $.ajax({
                url: '/user/collection/add-product',
                type: 'POST',
                async: false,
                data: {
                    product_id: $(this).attr('product-id'),
                    collection_id: $(this).attr('collection-id')
                },
            })
            .done(function(data) {
                if (data == lang['collection']['add-error'] || data == lang['collection']['add-warning']) {
                    alert(data);
                } else {
                    $('#collection').html(data);
                }
            })
            
        });

        $('#collection').on('click', '.btn-danger', function(event) {
            event.preventDefault();
            $.ajax({
                url: '/user/collection/remove-product',
                type: 'POST',
                async: false,
                data: {
                    product_id: $(this).attr('product-id'),
                    collection_id: $(this).attr('collection-id')
                },
            })
            .done(function(data) {
                if (data == lang['collection']['remove-error']) {
                    alert(data);
                } else {
                    $('#collection').html(data);
                }
            })
        });
    }
}
