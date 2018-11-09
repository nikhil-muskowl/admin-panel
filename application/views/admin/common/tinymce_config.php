<script type="text/javascript">
    $('[data-toggle=\'tinymce\']').each(function () {

        var element = this;

//        var lang = 'en';
//
//        if ($(this).attr('data-lang')) {
//            lang = $(this).attr('data-lang');
//        }

        tinymce.init({
            target: element,
            forced_root_block: false,
            browser_spellcheck: true,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },
            height: 300,
            code_dialog_width: 500,
            theme: 'modern',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'                
            ],
            noneditable_noneditable_class: 'fa',
            plugins: 'code noneditable print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            toolbar2: 'code',
            extended_valid_elements: 'span[*]',
            image_advtab: true,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,           
            file_browser_callback: function (field_name, url, type, win) {
                // from http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
                var w = window,
                        d = document,
                        e = d.documentElement,
                        g = d.getElementsByTagName('body')[0],
                        x = w.innerWidth || e.clientWidth || g.clientWidth,
                        y = w.innerHeight || e.clientHeight || g.clientHeight;

                var cmsURL = '<?= base_url('filemanager') ?>' + '?&field_name=' + field_name;

//                if (type == 'image') {
//                    cmsURL = cmsURL + "&type=images";
//                }

                tinymce.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        });

    });
</script>