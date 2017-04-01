var myProducts = function() {
    this.dataProduct = {
        name: null,
        price: null,
        code: null,
        quantity: null,
        discount: null,
        description: null,
        status: null,
        category_id: null,
        shop_id: null,
        collection: null,
        images: null,
    }

    this.typeImage = ['gif', 'png', 'jpeg', 'jpg'];

    this.init = function(data) {
        this.dataProduct.shop_id = data.shopId;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.uploadImage = data.uploadImage;
        this.addEvent();
    }

    this.uploadImage = null;

    this.arrayImage = [];

    this.arrayImageUrl = [];

    this.addEvent = function() {
        var current = this;
        $('#list-product').easyPaginate({
            paginateElement: 'div.block-product',
            elementsPerPage: 24,
            effect: 'climb'
        });
        $('#file').on('change', function(event) {
            var file = document.getElementById('file').files[0];
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (file && current.typeImage.indexOf(ext) > 0) {
                current.uploadImage.changeImage(file);
                current.arrayImage.push(file.name);
                current.uploadImage.upload(current.successUploadImage, current.error);
                $('#display-image-list').append(
                    '<span class="label label-success title-image"><span>'
                    + file.name
                    + '</span><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>'
                    + '<div class="margin-top-10"></div>'
                );
            } else {
                alert(lang['shop']['not-image'])
            }
            $(this).val(null);
        });
        $('#btn-add-edit').on('click', function(event) {
            current.dataProduct.images = null;
            current.dataProduct.category_id = $('#category').val();
            current.dataProduct.name = $('#name').val();
            current.dataProduct.price = $('#price').val();
            current.dataProduct.code = $('#code').val();
            current.dataProduct.quantity = $('#quantity').val();
            current.dataProduct.discount = $('#discount').val();
            current.dataProduct.description = $('#description').val();
            current.dataProduct.status = $('#status').val();
            current.dataProduct.collection = $('#collection').val();
            current.dataProduct.images = ($('#array-image').val() != '') ? $('#array-image').val().split(',') : '';
            if (!current.dataProduct.shop_id) {
                alert(lang['shop']['not-exits']);

                return;
            }
            if (current.dataProduct.category_id == 0) {
                alert(lang['shop']['not-chosen-category']);

                return;
            }
            if (current.dataProduct.collection == 0) {
                alert(lang['shop']['not-chosen-collection']);

                return;
            }
            if ($(this).data('type') === 'add') {
                if (current.dataProduct.name != '' && current.dataProduct.price != '' &&
                    current.dataProduct.code != '' && current.dataProduct.quantity != '' &&
                    current.dataProduct.description != '' && current.dataProduct.status != '' &&
                    current.dataProduct.shop_id != null) {
                    current.addProduct(current.dataProduct, current.loadAddProduct, current.error);
                } else {
                    alert(lang['rate']['not-fill']);
                }
            }
        });
        $('#list-product div.option span.glyphicon-trash').on('click', function(event) {
            if (confirm(lang['confirm-delete'])) {
                current.deleteProduct($(this).data('id'), current.loadAddProduct);
            }
        });
    }

    this.successUploadImage = function(url) {
        if (!$('#array-image').length) {
            $('#filed-image').append('<input type="hidden" id="array-image" value="">');
        }
        if ($('#array-image').val() != '') {
            $('#array-image').val($('#array-image').val() + ',' + url);
        } else {
            $('#array-image').val(url);
        }
    }

    this.addProduct = function(data, success, error) {
        $.ajax({
            url: '/product',
            type: 'POST',
            data: {
                name: data.name,
                price: data.price,
                code: data.code,
                quantity: data.quantity,
                discount: data.discount,
                description: data.description,
                status: data.status,
                category_id: data.category_id,
                collection: data.collection,
                images: data.images,
            },
        })
        .done(function(data) {
            if (data.status === 'success') {
                success();
            } else {
                error();
            }
        });
    }

    this.deleteProduct = function(id, callback) {
        $.ajax({
            url: '/product/' + id,
            type: 'DELETE',
        })
        .done(function(data) {
            if (data === 'success') {
                callback();
            } else {
                alert(lang[data]);
            }
        });
    }

    this.loadAddProduct = function() {
        window.location.reload();
    }

    this.error = function() {
        alert(lang['cart']['error']);
    }
}
