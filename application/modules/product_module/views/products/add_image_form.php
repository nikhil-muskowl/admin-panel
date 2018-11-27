<div class="tab-pane fade" id="image-tab-content<?= $images_row ?>">    

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

</div>