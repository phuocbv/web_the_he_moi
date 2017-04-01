var search = function() {
    this.dataPage = {
        items: null,
        itemsOnPage: null,
    }

    this.addCart = null;

    this.url = null;

    this.init = function(data) {
        this.dataPage.items = data.items;
        this.dataPage.itemsOnPage = data.itemsOnPage;
        this.addCart = data.addCart;
        this.url = data.url;
        $('.metismenu').metisMenu();
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $(document).on('click', '.btn-add-cart', function (e) {
            current.addCart.addToCart($(this).attr('product-id'));
        });
        $('.paginate').pagination({
            items: current.dataPage.items,
            itemsOnPage: current.dataPage.itemsOnPage,
            cssStyle: 'light-theme',
            hrefTextPrefix: 'javascript:void(',
            hrefTextSuffix: ')',
            onPageClick: function(pageNumber) {
                current.searchProduct({
                    search: current.url.getUrlParameter('search'),
                    page: pageNumber,
                });
            }
        });
    }

    this.searchProduct = function(param) {
        $.ajax({
            url: '/searchProduct',
            type: 'GET',
            data: {
                search: param.search,
                page: param.page,
            },
        })
        .done(function(data) {
            $('.cart').html(data);
        })
        .fail(function() {
            alert('error');
        });
    }
}
