var manageOrder = function() {
    this.data = {
        to: null,
        from: null,
    }

    this.init = function(data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $('#dataTables-example').DataTable();
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.date.datepicker').datepicker({
            format: 'dd/mm/yyyy',
        });

        $('#btn-search-order').on('click', function(event) {
            var from = $('#from').datepicker('getDate');
            var to = $('#to').datepicker('getDate');
            current.data.from = from.getFullYear() + '-' + (from.getMonth() + 1) + '-' + from.getDate();
            current.data.to = to.getFullYear() + '-' + (to.getMonth() + 1) + '-' + to.getDate();
            if (from != '' && to != '') {
                current.searchOrder(current.data, current);
            } else {
                alert[lang['input-false']];
            }
        });
    }

    this.searchOrder = function(data, current) {
        $.ajax({
            url: '/user/searchOrder',
            type: 'POST',
            data: data,
        })
        .done(function(data) {
            $('#table-display-ordered-product').html(data);
            $('#dataTables-example').DataTable();
        });
    }
}
