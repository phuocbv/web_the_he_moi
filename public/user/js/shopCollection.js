var shopCollection = function() {

    this.data = {
        imageUrl: null,
        idItemCollection: null,
    }

    this.init = function(data) {
        this.data.imageUrl = data.imageUrl;
        this.data.idItemCollection = data.idItemCollection;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('#item-collection-' + current.data.idItemCollection).css('color', 'red');
        $('.nav-tabs a').on('click', function() {
            $(this).tab('show');
        });
        $('.block-left-info-shop .image-background').css('background-image', 'url(' + current.data.imageUrl + ')');
        $('.block-product-category').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
        $('.list-collection a div.item-collection').hover(
            function() {
                $(this).css('background', 'rgb(224, 224, 224)');
            }, function() {
                $(this).css('background', '#fff');
            }
        );
        $('.search #search-product').on('click', function(event) {
            var to = $('#to').val();
            var from = $('#from').val();
            if (to != '' && from != '') {
                current.searchProduct(current.data.idItemCollection, from, to, current);
            } else {
                alert(lang['not-input']);
            }
        });
    }

    this.searchProduct = function(collectionId, from, to, current) {
        $.ajax({
            url: '/collection/' + collectionId + '/searchProduct',
            type: 'POST',
            data: {
                from: from,
                to: to
            },
        })
        .done(function(result) {
            $('#new').html(result);
            $('.btn-add-cart-search').on('click', function(event) {
                var addCart = new addcart('.btn-add-cart');
                addCart.addToCart($(this).attr('product-id'));
            });
        });
    }
}
