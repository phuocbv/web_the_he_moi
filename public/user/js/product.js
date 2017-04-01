var product = function() {
    this.dataRate = {
        productId: null,
        userId: null,
        shopId: null,
        number: null,
        content: null,
        userName: null,
        urlAvatar: null,
        addCart: null,
    }

    this.init = function(data) {
        this.dataRate.productId = data.idProduct;
        this.dataRate.userId = data.idUser;
        this.dataRate.userName = data.userName;
        this.dataRate.urlAvatar = data.urlAvatar;
        this.dataRate.shopId = data.idShop;
        this.dataRate.addCart = data.addCart;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.nav-tabs a').click(function() {
            $(this).tab('show');
        });
        $('.block-product-category').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
        if ($('#btn-follow').data('follow') > 0) {
            $('#btn-follow').css({'border-color': 'red', 'color': 'red'});
        }
        $('#input-rate').on('rating.change', function(event, value) {
            current.dataRate.number = value;
        });
        $('.button.btn-rate').on('click', function(event) {
            current.dataRate.content = $('#content-comment').val();
            $('#rate-comment .rating span.filled-stars').css('width', '0');
            $('#content-comment').val('');
            if (!current.dataRate.userId) {
                alert(lang['cart']['unauthenticated']);

                return;
            }
            if (current.dataRate.content != '') {
                current.rate(current.dataRate);
            } else {
                alert(lang['rate']['not-fill']);
            }
        });
        $('#list-rating').easyPaginate({
            paginateElement: 'div.block-rate',
            elementsPerPage: 10,
            effect: 'climb'
        });
        $('#btn-follow').on('click', function(event) {
            if (!current.dataRate.userId) {
                alert(lang['cart']['unauthenticated']);

                return;
            }
            follow.changeFollow({
                shopId: current.dataRate.shopId
            }, current.changeSinceFollow, current.error);
        });
        $('.info-sell-product .operator-minus').on('click', function(event) {
            current.changeNumber('minus');
        });
        $('.info-sell-product .operator-add').on('click', function(event) {
            current.changeNumber('add');
        });
        $('.add-product-in-cart input.btn-add-cart-product-detail').on('click', function(event) {
            var number = $('.info-sell-product span.number').html();
            var productId = $(this).data('id');
            current.dataRate.addCart.addToCartWithNumber(productId, number);
        });
    }

    this.changeNumber = function(data) {
        var number = parseInt($('.info-sell-product .number').html());
        var sum = parseInt($('.info-sell-product .avarible-product span.sum').html());
        if (data === 'add') {
            if (number >= sum) {
                number = sum;
            } else {
                number += 1; 
            }
        } else {
            if (number <= 1) {
                number = 1;
            } else {
                number -= 1;
            }
        }
        $('.info-sell-product .number').html(number);
    }

    this.rate = function(data) {
        var current = this;
        $.ajax({
            url: '/products/' + data.productId + '/rate',
            type: 'POST',
            data: {
                number: data.number,
                content: data.content,
            },
        })
        .done(function(data) {
            if (data === 'rated') {
                alert(lang['rate']['rated']);

                return;
            }
            if (data === 'not-product') {
                alert(lang['rate']['not-found-product']);

                return;
            }
            if (data != null && data != 'error') {
                $('.rate#rate-product-detail .rating .filled-stars').css('width', data.point_rate * 20 + '%');
                $('#list-rating').prepend(
                    '<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 block-rate">'
                    + '<div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 avatar">'
                    + '<img src="' + current.dataRate.urlAvatar + '" width="50" height="50"></div>'
                    + '<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 row block-content">'
                    + '<a href="javascript:void(0)" class="user-name">'
                    + '<span>' + current.dataRate.userName + '</span>'
                    + '</a>'
                    + '<div class="number-rate">'
                    + '<div class="rating-container rating-md rating-animate rating-disabled">'
                    + '<div class="clear-rating " title="Clear">'
                    + '<i class="glyphicon glyphicon-minus-sign"></i>'
                    + '</div>'
                    + '<div class="rating">'
                    + '<span class="empty-stars">'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>'
                    + '</span>'
                    + '<span class="filled-stars" style="width: ' + current.dataRate.number * 20 + '%;">'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '<span class="star"><i class="glyphicon glyphicon-star"></i></span>'
                    + '</span></div>'
                    + '<div class="caption">'
                    + '<span class="label label-warning">Two Stars</span>'
                    + '</div>'
                    + '<input id="input-1" name="input-1" class="rating hide" value="' + current.dataRate.number + '" readonly="readonly">'
                    + '</div>'
                    + '</div>'
                    + '<div class="content-rate">' + current.dataRate.content + '</div>'
                    + '<div class="date-rate">'
                    + '<span>' + new Date() + '</span>'
                    + '</div></div></div>'
                );
                $('#count-rate').html(parseInt($('#count-rate').html()) + 1);
            }
        });
    }

    this.changeSinceFollow = function() {
        if ($('#btn-follow').data('follow') == 0) {
            $('#btn-follow').data('follow', 1)
                .html(lang['shop']['follow'])
                .css({'border-color': 'red', 'color': 'red'});
            $('#number-follow').html(parseInt($('#number-follow').html()) + 1);
        } else {
            $('#btn-follow').data('follow', 0)
                .html(lang['shop']['not-follow'])
                .css({'border-color': '#e7e7e7', 'color': '#878787'});
            $('#number-follow').html(parseInt($('#number-follow').html()) - 1);
        }
    }

    this.error = function() {
        alert(lang['cart']['error']);
    }
}
