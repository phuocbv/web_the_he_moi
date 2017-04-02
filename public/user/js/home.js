var home = function(data) {
    this.addCart = data.addCart;

    this.init = function() {
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.block-product-home').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
        $(document).on('click', '.button.btn-add-cart', function() {
            current.addCart.addToCart($(this).attr('product-id'));
        });
    }
}
