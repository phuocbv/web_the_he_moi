var category = function() {

    this.data = {
        parent_id: null,
        category_id: null,
    }

    this.dataSearch = {
        from: null,
        to: null,
    }

    this.addCart = null;

    this.init = function(data) {
        var current = this;
        this.data.parent_id = data.parent_id;
        this.data.category_id = data.category_id;
        this.addCart = data.addCart;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $('.metismenu').metisMenu();
        current.hoverBlockProduct();
        if (current.data.parent_id == null) {
            var category_current = "#category_" + current.data.category_id;
            $(category_current).css('color', 'red');
            $(category_current).parent().addClass('active');
            $(category_current).next().attr('aria-expanded', 'true').addClass('in');
        } else {
            var root_category = "#category_" + current.data.parent_id;
            var category_current = "#sub_category_" + current.data.category_id;
            $(category_current).css('color', 'red');
            $(root_category).css('color', 'red');
            $(root_category).parent().addClass('active');
            $(root_category).next().attr('aria-expanded', 'true').addClass('in');
        }
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('#search-by-price').on('click', function(event) {
            current.dataSearch.from = $('#from').val();
            current.dataSearch.to = $('#to').val();
            if (current.dataSearch.from === '' || current.dataSearch.to === '') {
                alert(lang['rate']['not-fill']);

                return;
            }
            if (current.dataSearch.from > current.dataSearch.to) {
                alert(lang['input-false']);

                return;
            }
            current.searchProduct(current.data.category_id, current.dataSearch,
                current.loadProduct, current);
        });
        $(document).on('click', '.pagination a', function (e) {
            current.getListCategories($(this).attr('href').split('page=')[1], current.hoverBlockProduct);
            e.preventDefault();
        });
        $(document).on('click', '.btn-add-cart', function (e) {
            current.addCart.addToCart($(this).attr('product-id'));
        });
    }

    this.searchProduct = function(category_id, data, callback, current) {
        $.ajax({
            url: '/category/' + category_id + '/searchProduct',
            type: 'POST',
            data: data,
        })
        .done(function(data) {
            callback(data, current);
            current.hoverBlockProduct();
        });
    }          

    this.loadProduct = function(data, current) {
        $('div.easyPaginateNav').remove();
        $('#list-product').html(data);
        current.paginate();
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

    this.getListCategories = function(page, callback) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.list-product-in-category').html(data);
            location.hash = page;
            callback();
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
}
