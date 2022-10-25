<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TinyMCE</title>
</head>

<body>
    <script src="https://cdn.tiny.cloud/1/bx4pqypup1nbpxv01ppodyyjkyol9bfjnjmteivgj4lophqb/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <textarea name="content" class="form-control my-editor"></textarea>
    <script>
        var editor_config = {
            height: 500,
            path_absolute: "/",
            selector: 'textarea.my-editor',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image imagetools charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste code help wordcount",
            ],
            toolbar: "undo redo | formatselect | styleselect | bold italic underline backcolor | \
               fontselect fontsizeselect | image code | \
               alignleft aligncenter alignright alignjustify | \
               bullist numlist outdent indent | removeformat | help",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
</body>

</html>
