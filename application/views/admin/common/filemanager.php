<script type="text/javascript">
    $(document).on('click', 'a[data-toggle=\'image\']', function (e) {
        var $element = $(this);        
        e.preventDefault();
//            console.log($element);

        // destroy all image popovers
        $('a[data-toggle="image"]').popover('destroy');

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
            var $button = $(this);
            var $icon = $button.find('> i');

            $button.prop('disabled', true);
            if ($icon.length) {
                $icon.attr('class', 'fa fa-circle-o-notch fa-spin');
            }

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

                if (data.source === 'richfilemanager') {

                    console.log($element);
                    console.log($element.parent().find('input'));

                    $element.find('img').attr('src', data.preview_url).width(100);
                    $element.parent().find('input').val(data.preview_url);
                    
                }

                $button.prop('disabled', false);

                if ($icon.length) {
                    $icon.attr('class', 'fa fa-pencil');
                }

                $element.popover('dispose');
                opener.close();
                
            }

            $(window).on('message', handlePostMessage);
            $button.prop('disabled', false);

            if ($icon.length) {
                $icon.attr('class', 'fa fa-pencil');
            }

            $element.popover('dispose');
        });

        $('#button-clear').on('click', function () {
            $element.find('img').attr('src', $element.find('img').attr('data-placeholder')).width(100);
            $element.parent().find('input').val('');

            $element.popover('dispose');
        });

    });
</script>