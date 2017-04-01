var cart = function() {
    this.init = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();       
    }

    this.addEvent = function() {
        var current = this;
        $('#cart').on('click', '.cart_quantity_delete',function(event) {
            event.preventDefault();
            current.destroy($(this).data('id'));
        });

        $('#cart').on('click', '.cart_quantity_up',function(event) {
            event.preventDefault();
            if (($(this).data('qty') + 1) > $(this).data('quantity')) {
                alert(lang['cart']['not-enough']);
            } else {
                current.upQuantity($(this).data('id'));
            }
        });

        $('#cart').on('click', '.cart_quantity_down',function(event) {
            event.preventDefault();
            current.downQuantity($(this).data('id'));
        });
    }

    this.destroy = function(id) {
        $.ajax({
            url: '/user/cart/remove',
            type: 'POST',
            data: { id: id },
        })
        .done(function(data) {
            $('#cart').html(data);
        });
    }

    this.upQuantity = function(id) {
        $.ajax({
            url: '/user/cart/up',
            type: 'GET',
            data: { id: id },
        })
        .done(function(data) {
            $('#cart').html(data);
        });       
    }

    this.downQuantity = function(id) {
        $.ajax({
            url: '/user/cart/down',
            type: 'GET',
            data: { id: id },
        })
        .done(function(data) {
            $('#cart').html(data);
        });
    }
}
