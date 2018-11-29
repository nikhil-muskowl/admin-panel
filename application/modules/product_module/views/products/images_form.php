<div class="row">
    <div class="col-md-3">
        <ul class="nav flex-column nav-pills" id="images-content">                                            
            <?php $images_row = 1; ?>
            <?php if ($images): ?>
                <?php foreach ($images as $key => $image) : ?>
                    <li>
                        <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" href="#image-tab-content<?= $images_row ?>" data-toggle="tab">
                            <i class="fa fa-minus-circle" onclick="$('#images-content a:first').tab('show');
                                    $('#images-content a[href=\'#image-tab-content<?= $images_row ?>\']').parent().remove();
                                    $('#image-tab-content<?= $images_row ?>').remove();">
                            </i> 
                            <?= humanize('image') ?> <?= $images_row ?>
                        </a>
                    </li>
                    <?php $images_row += 1; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <li id="image-content-add"><a class="nav-link" onclick="addImages();"><i class="fa fa-plus-circle"></i><?= humanize('add_image') ?></a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="content-images-tab-content">
            <?php $images_row = 1; ?>
            <?php if ($images): ?>
                <?php foreach ($images as $key => $image) : ?>
                    <div class="tab-pane container fade <?php if ($key == 0): ?> show active <?php endif; ?>" id="image-tab-content<?= $images_row ?>">                        

                        <div class="form-group">
                            <label class="control-label col-md-2"><?= humanize('image') ?></label>
                            <div class="col-md-10">
                                <a href="" id="thumb-image" data-toggle="image">
                                    <img alt="" name="" src="<?= $image['image_thumb'] ?>" class="img-fluid" data-placeholder="<?= $thumb ?>"/>
                                    <input type="hidden" name="images[<?= $images_row ?>][image]" value="<?= $image['image'] ?>" id="input-image" />
                                </a>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2"><?= humanize('link') ?></label>
                            <div class="col-md-10">                                        
                                <input type="text" name="images[<?= $images_row ?>][link]" value="<?= $image['link'] ?>" placeholder="<?= humanize('link') ?>" class="form-control"/>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2"><?= humanize('sort_order') ?></label>
                            <div class="col-md-10">                                        
                                <input type="text" name="images[<?= $images_row ?>][sort_order]" value="<?= $image['sort_order'] ?>" placeholder="<?= humanize('sort_order') ?>" class="form-control"/>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <?php $images_row += 1; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type="text/javascript">

    var images_row = <?= $images_row ?>;
    var html = '';
    function addImages() {
        $.ajax({
            url: "<?= $ajax_image_form ?>" + images_row,
            type: "GET",
            dataType: "HTML",
            async: false,
            success: function (data) {
                html = data;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', errorThrown);
            }
        });


        $('#content-images-tab-content').append(html);

        $('#image-content-add').before('<li><a class="nav-link" href="#image-tab-content' + images_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#images-content a:first\').tab(\'show\'); $(\'a[href=\\\'#image-tab-content' + images_row + '\\\']\').parent().remove(); $(\'#image-tab-content' + images_row + '\').remove();"></i> <?= humanize('image') ?> ' + images_row + '</a></li>');
        $('#images-content a[href=\'#image-tab-content' + images_row + '\']').tab('show');
        
        $('#image-tab-content' + images_row + ' .form-group[data-sort]').detach().each(function () {
            if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#image-tab-content' + images_row + ' .form-group').length) {
                $('#image-tab-content' + images_row + ' .form-group').eq($(this).attr('data-sort')).before(this);
            }

            if ($(this).attr('data-sort') > $('#image-tab-content' + images_row + ' .form-group').length) {
                $('#image-tab-content' + images_row + ' .form-group:last').after(this);
            }

            if ($(this).attr('data-sort') < -$('#image-tab-content' + images_row + ' .form-group').length) {
                $('#image-tab-content' + images_row + ' .form-group:first').before(this);
            }
        });

        images_row++;
    }
</script>