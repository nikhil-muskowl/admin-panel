<script type="text/javascript">
    $(document).ready(function () {
        $(document).delegate('a[data-toggle=\'image\']', 'click', function (e) {
            var $element = $(this);            

            e.preventDefault();
           
            // destroy all image popovers
            $('a[data-toggle="image"]').popover('dispose');

            $element.popover({
                html: true,
                placement: 'right',
                trigger: 'manual',
                content: function () {
                    return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
                }
            });

            $element.popover('show');

            $('#button-image').on('click', function () {
//                var $button = $(this);
//                $button.prop('disabled', true);

                var width = screen.width * 0.7;
                var height = screen.height * 0.7;

                var iLeft = (screen.width - width) / 2;
                var iTop = (screen.height - height) / 2;
                var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes";
                sOptions += ",width=" + width;
                sOptions += ",height=" + height;
                sOptions += ",left=" + iLeft;
                sOptions += ",top=" + iTop;
                var opener = window.open('<?= base_url('filemanager') ?>', "BrowseWindow", sOptions);

                function handlePostMessage(e) {
                    var data = e.originalEvent.data;
//                    console.log(data);
                    if (data.source === 'richfilemanager') {                        
                        $element.find('img').attr('src', data.preview_url).width(100);
                        $element.find('input').val(data.preview_url);               
                        opener.close();
                        $element.popover('dispose');
                    }
                    // remove an event handler
                    $(window).on('message', handlePostMessage);
                    $element.popover('dispose');
                }

                $(window).on('message', handlePostMessage);
                $element.popover('dispose');
            });

            $('#button-clear').on('click', function () {
                $element.find('img').attr('src', $element.find('img').attr('data-placeholder')).width(100);
                $element.find('input').val('');
                           
                $element.popover('dispose');
            });

        });
    });
</script>