<style type="text/css">
    #actions {
        margin: 2em 0;
    }
    div.table {
        display: table;
    }
    div.table .file-row {
        display: table-row;
    }
    div.table .file-row > div {
        display: table-cell;
        vertical-align: top;
        border-top: 1px solid #ddd;
        padding: 8px;
    }
    div.table .file-row:nth-child(odd) {
        background: #f9f9f9;
    }
    #total-progress {
        opacity: 0;
        transition: opacity 0.3s linear;
    }
    #previews .file-row.dz-success .progress {
        opacity: 0;
        transition: opacity 0.3s linear;
    }
    #previews .file-row .start, 
    #previews .file-row .cancel {
        display: none;
    }
    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
        display: none;
    }
    #previews .file-row.dz-success .delete {
        display: block;
    }
    .dz-image-preview .progress{
        /*display: none;*/
    }
</style>

<script>
    $(function () {
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(document.body, {// Make the whole body a dropzone
            url: "<?= current_url() ?>/upload", // Set the url
            thumbnailWidth: 220,
            thumbnailHeight: 220,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
            init: function () {
                thisDropzone = this;
                $.get('<?= base_url() ?>admin/uploader/get_photo_dz/<?= $id_album ?>/', function (data) {
                    var num = 0;
                    $.each(data, function (key, value) {
                        var mockFile = {name: value.name, size: value.size};
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "<?= base_url() ?>img/user/<?= $user ?>/<?= $id_album ?>/" + value.name);
                        var previewContainer = $(thisDropzone.previewsContainer.children[num]);
                        console.log(previewContainer.append('<input type="text" name="" value="" class="pull-right">'));
//                        previewContainer.appen
                        num++;
                    });
                }, 'json');
            }
        });



        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            $(file.previewElement).find('.delete').css('display', "none");
            $(file.previewElement).find('.cancel').css('display', "inline");
            file.previewElement.querySelector(".start").onclick = function () {
                myDropzone.enqueueFile(file);
            };
            var popis = Dropzone.createElement('<div class="default_pic_container"><input type="text" name="' + file.name + '" value="" /> Popis</div>');
            file.previewElement.appendChild(popis);
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1";
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0";
            location.reload();
        });

        myDropzone.on("removedfile", function (file) {
            //show delete button, hide others
            $.post("<?= base_url() ?>admin/uploader/del_photo_dz/", {name: file.name});
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function () {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };
        document.querySelector("#actions .cancel").onclick = function () {
            myDropzone.removeAllFiles(true);
        };
    });
</script>
