var firebaseCustom = function() {
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

    this.element = {
        input_file: null,
        img_circle: null,
        progress: null,
        input_file_logo: null,
    };

    this.firebase = null;

    this.urlImage = null;

    this.init = function(config) {
        if (typeof config !== 'undefined') {
            this.changeConfig(config);
            this.firebase = firebase.initializeApp(this.config);
        }
    };

    this.changeElement = function(element) {
        for (var p_key in this.element) {
            this.element[p_key] = element[p_key];
        }
    };

    this.changeConfig = function(config) {
        for (var p_key in this.config) {
            this.config[p_key] = config[p_key];
        }
    };

    this.getUrlImage = function() {
        return this.urlImage; 
    };

    this.uploadImage = function() {
        var current = this;
        var file = document.getElementById(current.element.input_file).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(current.element.img_circle).attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
            var storageRef = this.firebase.storage().ref();
            var uploadTask = storageRef.child('images/' + file.name).put(file, this.metadata);
            uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, function(snapshot) {
                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                $(current.element.progress).css('width', progress + '%');
            }, function(error) {
                $(current.element.input_file_logo).val(null);
                swal('Error', 'Error load image!')
            }, function() {
                var downloadURL = uploadTask.snapshot.downloadURL;
                current.urlImage = downloadURL;
                $(current.element.input_file_logo).val(downloadURL);
                swal("Success!", "Upload Image Complete!", "success");
            });
        } else {
            $(current.element.progress).css('width', '0%');
        }
    };
}
