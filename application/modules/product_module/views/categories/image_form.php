<div class="form-group row">
    <label class="control-label col-md-3"><?= humanize('image') ?></label>
    <div class="col-md-9">
        <a href="" id="thumb-image" data-toggle="image">
            <img alt="" name="" src="<?= $image_thumb ?>" class="img-fluid" data-placeholder="<?= $thumb ?>"/>                                
            <input type="hidden" name="image" value="<?= $image ?>" id="input-image"/>
        </a>
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group row">
    <label class="control-label col-md-3"><?= humanize('banner') ?></label>
    <div class="col-md-9">
        <a href="" id="thumb-banner" data-toggle="image">
            <img alt="" name="" src="<?= $banner_thumb ?>"  class="img-fluid" data-placeholder="<?= $thumb ?>"/>                                
            <input type="hidden" name="banner" value="<?= $banner ?>" id="input-banner"/>
        </a>                            
        <span class="help-block"></span>
    </div>
</div>