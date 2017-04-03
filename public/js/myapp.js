var myApp = function() {
    this.data = {
        pusher_key: null,
        chanel: null
    }

    this.init = function(data) {
        this.data.pusher_key = data.pusher_key;
        this.data.chanel = data.chanel;
        this.listenEvent();
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

    this.listenEvent = function() {
        //Pusher.logToConsole = true;
        var pusher = new Pusher(this.data.pusher_key);
        var channel = pusher.subscribe(this.data.chanel);
        channel.bind('App\\Events\\HaveNewProductEvent', function(data) {
            alert(data.message);
        });
    }
}
