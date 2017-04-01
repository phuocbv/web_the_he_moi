var uploadImage = function() {
    this.config = {
        apiKey: null,
        authDomain: null,
        databaseURL: null,
        storageBucket: null,
        messagingSenderId: null,
    };

    this.metadata = {
        contentType: 'image/jpeg',
    };

    this.firebase = null;

    this.image = null;

    this.imageUrl = null;

    this.init = function(config) {
        if (typeof config !== 'undefined') {
            this.changeConfig(config);
            this.firebase = firebase.initializeApp(this.config);
        }
    };

    this.changeConfig = function(config) {
        for (var p_key in this.config) {
            this.config[p_key] = config[p_key];
        }
    };

    this.changeImage = function(image) {
        this.image = image;
    };

    this.returnImageUrl = function() {
        return this.imageUrl;
    };

    this.upload = function(success, error) {
        var current = this;
        var file = current.image;
        if (file) {
            var storageRef = this.firebase.storage().ref();
            var uploadTask = storageRef.child('images/' + file.name).put(file, this.metadata);
            uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, function(snapshot) {

            }, function(error) {
                error();
            }, function() {
                success(uploadTask.snapshot.downloadURL);
            });
        }
    };
}
