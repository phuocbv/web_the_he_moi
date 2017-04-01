var home = function() {
    this.init = function() {
        this.addEvent();
    }
    this.addEvent = function() {
        $('.block-product-home').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
    }
}
var home = new home();
home.init();
