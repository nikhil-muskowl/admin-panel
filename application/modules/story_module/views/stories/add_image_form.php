<div class="tab-pane fade" id="tab-content<?= $images_row ?>">    

    <div class="form-group">
        <label class="control-label col-md-2"><?= humanize('image') ?></label>
        <div class="col-md-10">
            <a href="" id="thumb-image" data-toggle="image">
                <img alt="" name="" src="<?= $thumb ?>" class="img-fluid" data-placeholder="<?= $thumb ?>"/>
                <input type="hidden" name="images[<?= $images_row ?>][image]" value="" id="input-image" />
            </a>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2"><?= humanize('link') ?></label>
        <div class="col-md-10">                                        
            <input type="text" name="images[<?= $images_row ?>][link]" placeholder="<?= humanize('link') ?>" class="form-control"/>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2"><?= humanize('sort_order') ?></label>
        <div class="col-md-10">                                        
            <input type="text" name="images[<?= $images_row ?>][sort_order]" placeholder="<?= humanize('sort_order') ?>" class="form-control"/>
            <span class="help-block"></span>
        </div>
    </div>

    <hr/>  

    <ul class="nav nav-tabs">
        <?php foreach ($image_details as $key2 => $image_detail) : ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($key2 == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#imageDetailsTab<?= $images_row ?><?= $image_detail['language_id'] ?>"><?= $image_detail['language'] ?></a>
            </li>                            
        <?php endforeach; ?>
    </ul>
    <br>

    <div class="tab-content clearfix">
        <?php foreach ($image_details as $key2 => $image_detail) : ?>
            <div class="tab-pane container <?php if ($key2 == 0): ?> active <?php endif; ?>" id="imageDetailsTab<?= $images_row ?><?= $image_detail['language_id'] ?>">
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