<div class="row">
    <div class="col-md-3">
        <ul class="nav flex-column nav-pills" id="content">                                            
            <?php $images_row = 1; ?>
            <?php if ($images): ?>
                <?php foreach ($images as $key => $image) : ?>
                    <li>
                        <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" href="#tab-content<?= $images_row ?>" data-toggle="tab">
                            <i class="fa fa-minus-circle" onclick="$('#content a:first').tab('show');
                                    $('#content a[href=\'#tab-content<?= $images_row ?>\']').parent().remove();
                                    $('#tab-content<?= $images_row ?>').remove();">
                            </i> 
                            <?= humanize('image') ?> <?= $images_row ?>
                        </a>
                    </li>
                    <?php $images_row += 1; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <li id="content-add"><a class="nav-link" onclick="addImages();"><i class="fa fa-plus-circle"></i><?= humanize('add_image') ?></a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="content-images-tab-content">
            <?php $images_row = 1; ?>
            <?php if ($images): ?>
                <?php foreach ($images as $key => $image) : ?>
                    <div class="tab-pane container fade <?php if ($key == 0): ?> show active <?php endif; ?>" id="tab-content<?= $images_row ?>">                        

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

                        <hr/>  

                        <ul class="nav nav-tabs">
                            <?php foreach ($image['image_details'] as $key2 => $image_detail) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($key2 == 0): ?> show active <?php endif; ?>" data-toggle="tab" href="#imageDetailsTab<?= $images_row ?><?= $image_detail['language_id'] ?>"><?= $image_detail['language'] ?></a>
                                </li>                            
                            <?php endforeach; ?>
                        </ul>
                        <br>

                        <div class="tab-content clearfix">

                            <?php foreach ($image['image_details'] as $key2 => $image_detail) : ?>
                                <div class="tab-pane container fade <?php if ($key2 == 0): ?> show active <?php endif; ?>" id="imageDetailsTab<?= $images_row ?><?= $image_detail['language_id'] ?>">                                    
                                    <div class="form-group row">
                                        <label class="control-label col-md-2"><?= humanize('title') ?></label>
                                        <div class="col-md-10">
                                            <input name="images[<?= $images_row ?>][image_details][<?= $image_detail['language_id'] ?>][title]" value="<?= $image_detail['title'] ?>" placeholder="<?= humanize('title') ?>" class="form-control" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>   
                                    <div class="form-group row">
                                        <label class="control-label col-md-2"><?= humanize('description') ?></label>
                                        <div class="col-md-10">                    
                                            <textarea name="images[<?= $images_row ?>][image_details][<?= $image_detail['language_id'] ?>][description]"  placeholder="<?= humanize('description') ?>" class="form-control"><?= $image_detail['description'] ?></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>   

                                    <div class="form-group row">
                                        <label class="control-label col-md-2"><?= humanize('html') ?></label>
                                        <div class="col-md-10">                    
                                            <textarea name="images[<?= $images_row ?>][image_details][<?= $image_detail['language_id'] ?>][html]" data-toggle="tinymce"  placeholder="<?= humanize('html') ?>" class="form-control"><?= $image_detail['html'] ?></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>  
                                </div>
                            <?php endforeach; ?>
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

        $('#content-add').before('<li><a class="nav-link" href="#tab-content' + images_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#content a:first\').tab(\'show\'); $(\'a[href=\\\'#tab-content' + images_row + '\\\']\').parent().remove(); $(\'#tab-content' + images_row + '\').remove();"></i> <?= humanize('image') ?> ' + images_row + '</a></li>');
        $('#content a[href=\'#tab-content' + images_row + '\']').tab('show');
        $('#tab-content' + images_row + ' .form-group[data-sort]').detach().each(function () {
            if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#tab-content' + images_row + ' .form-group').length) {
                $('#tab-content' + images_row + ' .form-group').eq($(this).attr('data-sort')).before(this);
            }

            if ($(this).attr('data-sort') > $('#tab-content' + images_row + ' .form-group').length) {
                $('#tab-content' + images_row + ' .form-group:last').after(this);
            }

            if ($(this).attr('data-sort') < -$('#tab-content' + images_row + ' .form-group').length) {
                $('#tab-content' + images_row + ' .form-group:first').before(this);
            }
        });

        images_row++;
    }
</script>