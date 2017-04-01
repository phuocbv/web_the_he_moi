var shop = function() {
    this.data = {
        avatar: null,
        userId: null,
        shopId: null,

    }

    this.init = function(data) {
        this.data.avatar = data.avatar;
        this.data.userId = data.idUser;
        this.data.shopId = data.idShop;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.block-info-detail-shop .avatar-shop').css('background-image', 'url(' + current.data.avatar + ')');
        $('.nav-tabs a').on('click', function() {
            $(this).tab('show');
        });
        current.hoverBlockProduct();
        if ($('#btn-follow').data('follow') > 0) {
            $('#btn-follow').css({'border-color': 'red', 'color': 'red'});
        }
        if ($('#btn-like').data('like') > 0) {
            $('#btn-like').css({'border-color': 'red', 'color': 'red'});
        }
        $('#list-product').easyPaginate({
            paginateElement: 'div.block-product-category-all',
            elementsPerPage: 24,
            effect: 'climb'
        });
        $('.nav.nav-tabs li').on('click', function(event) {
            addCart.init('.btn-add-cart');
            current.hoverBlockProduct();
        });
        $('div.easyPaginateNav a').on('click', function() {
            addCart.init('.btn-add-cart');
            current.hoverBlockProduct();
        });
        $('#btn-follow').on('click', function(event) {
            if (!current.data.userId) {
                alert(lang['cart']['unauthenticated']);

                return;
            }
            follow.changeFollow({
                shopId: current.data.shopId
            }, current.changeSinceFollow, current.error);
        });
        $('#btn-like').on('click', function(event) {
            if (!current.data.userId) {
                alert(lang['cart']['unauthenticated']);

                return;
            }
            current.changeLike({
                shopId: current.data.shopId
            }, current.changeSinceLike, current.error);
        });
    }

    this.hoverBlockProduct = function() {
        $('.block-product-category').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
    }

    this.changeSinceFollow = function() {
        if ($('#btn-follow').data('follow') == 0) {
            $('#btn-follow').data('follow', 1)
                .html(lang['shop']['follow-full'])
                .css({'border-color': 'red', 'color': 'red'});
            $('#number-follow').html(parseInt($('#number-follow').html()) + 1);
        } else {
            $('#btn-follow').data('follow', 0)
                .html(lang['shop']['not-follow'])
                .css({'border-color': '#fff', 'color': '#fff'});
            $('#number-follow').html(parseInt($('#number-follow').html()) - 1);
        }
    }

    this.error = function() {
        alert(lang['cart']['error']);
    }

    this.changeSinceLike = function() {
        if ($('#btn-like').data('like') == 0) {
            $('#btn-like').data('like', 1)
                .html(lang['shop']['liked'])
                .css({'border-color': 'red', 'color': 'red'});
            $('#number-like').html(parseInt($('#number-like').html()) + 1);
        } else {
            $('#btn-like').data('like', 0)
                .html(lang['shop']['like'])
                .css({'border-color': '#fff', 'color': '#fff'});
            $('#number-like').html(parseInt($('#number-like').html()) - 1);
        }
    };

    this.changeLike = function(data, success, error) {
        $.ajax({
            url: '/shops/' + data.shopId + '/like',
            type: 'POST',
            data: {},
        })
        .done(function(data) {
            if (data === 'success') {
                success();
            }
            if (data === 'error') {
                error();
            }
        });
    }
}
