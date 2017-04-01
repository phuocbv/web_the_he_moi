var myApp = function() {

    this.init = function() {
        this.addEvent();
        this.remove();
    }

    this.addEvent = function() {
        $('#logout').click(function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
    }

    this.remove = function() {
        if (window.location.hash && window.location.hash == '#_=_') {
            window.location.hash = '';
        }
    }
}
