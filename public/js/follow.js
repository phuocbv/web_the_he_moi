var follow = function() {
    this.changeFollow = function(data, success, error) {
        $.ajax({
            url: '/shops/' + data.shopId + '/follow',
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
var follow = new follow();
