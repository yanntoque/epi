window.onload = function () {
    var _actionToDropZone = $("#form_snippet_file").attr('action');

    Dropzone.autoDiscover = false;
    var fileDropZoneArea = new Dropzone("#form_snippet_file", {url: _actionToDropZone});

    fileDropZoneArea.on("addedfile", function (file) {
        alert("fichier reçu !");
    });
};