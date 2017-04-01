var collection = function() {
    this.data = {
        name: null,
    }

    this.dataPage = {
        items: null,
        itemsOnPage: null,
    }

    this.imageAwait = null;

    this.elementSelected = null;

    this.init = function(data) {
        this.dataPage.items = data.items;
        this.dataPage.itemsOnPage = data.itemsOnPage;
        this.imageAwait = data.imageAwait;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $(document).on('click', '#btn-add', function(event) {
            current.data.name = $('#nameCollection').val();
            if (current.data.name) {
                current.addMyCollection(current.data, current.inform);
            } else {
                alert('Empty');
            }
        });
        $('.paginate').pagination({
            items: current.dataPage.items,
            itemsOnPage: current.dataPage.itemsOnPage,
            cssStyle: 'light-theme',
            hrefTextPrefix: 'javascript:void(',
            hrefTextSuffix: ')',
            onPageClick: function(pageNumber) {
                current.loadCollection(pageNumber);
            }
        });
        $(document).on('click', '.fa.fa-pencil#edit-collection', function(event) {
            $.blockUI({ message: '<img src="' + current.imageAwait + '"/>' });
            $idCollection = $(this).data('id');
            $('#editCollection #btn-edit').attr('data-id', $idCollection);
            current.getCollection($idCollection);
            current.elementSelected = this;
        });
        $(document).on('click', '#editCollection #btn-edit', function(event) {
            var name = $('#nameCollectionEdit').val();
            if (name) {
                current.updateCollection($(this).data('id'), { name: name },
                    current.informUpdate, current.elementSelected);
            } else {
                alert('Empty');
            }
        });
        $(document).on('click', '.fa.fa-trash-o#delete-collection', function(event) {
            if (confirm('Delete')) {
                current.deleteCollection($(this).data('id'), current.informDelete);
            }
        });
    }

    this.addMyCollection = function(data, callback) {
        $.ajax({
            url: '/user/collection',
            type: 'POST',
            data: data,
        })
        .done(function(data) {
            callback(data, '');
        })
        .fail(function() {
            alert('error');
        });
    }

    this.updateCollection =function(id, data, callback, element) {
        $.ajax({
            url: '/user/collection/' + id,
            type: 'PATCH',
            data: data,
        })
        .done(function(data) {
            callback(data, element);
        });
    }

    this.deleteCollection = function(id, callback) {
         $.ajax({
            url: '/user/collection/' + id,
            type: 'DELETE',
        })
        .done(function(data) {
            callback(data);
        });
    }

    this.loadCollection = function(pageNumber) {
        $.ajax({
            url: '/user/myCollection',
            type: 'GET',
            data: { page: pageNumber },
        })
        .done(function(data) {
            $('.item-collection').html(data);
        })
        .fail(function() {
            alert('error');
        });
    }

    this.inform = function(data, select) {
        switch (data.status) {
            case 'error':
                alert(data.status);
                break;
            case 'success':
                $('.modal#addCollection').modal('hide');
                window.location.reload();
                break;
            case 'validator':
                var str = '';
                for (var key in data.message) {
                    str += key + " : " + data.message[key];
                }
                alert(str);
                break;
        }
    }

    this.informUpdate = function(data, select) {
        switch (data.status) {
            case 'success':
                $('.modal#editCollection').modal('hide');
                $parent = $(select).parentsUntil('class', '.odd');
                $parent.children('td.name').children('a.name').html(data.data.name);
                break;
            case 'validator':
                var str = '';
                for (var key in data.message) {
                    str += key + ": " + data.message[key];
                }
                alert(str);
                break;
            default :
                alert(data.status);
        }
    }

    this.informDelete = function(data) {
        switch (data.status) {
            case 'success':
                window.location.reload();
                break;
            case 'validator':
                var str = '';
                for (var key in data.message) {
                    str += key + ": " + data.message[key];
                }
                alert(str);
                break;
            default :
                alert(data.status);
        }
    }

    this.getCollection = function(id) {
        $.ajax({
            url: '/user/collection/' + id + '/edit',
            type: 'GET',
        })
        .done(function(data) {
            switch (data.status) {
                case 'error':
                    alert(data.status);
                    break;
                case 'success':
                    $('#nameCollectionEdit').val(data.data['name']);
                    $.unblockUI();
                    $('.modal#editCollection').modal('show');
                    break;
            }
        });
    }
}
