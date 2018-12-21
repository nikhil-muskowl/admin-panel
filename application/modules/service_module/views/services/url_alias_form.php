<ul class="nav nav-tabs">
    <?php foreach ($url_alias as $key => $value) : ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#url_aliasTab<?= $value['id'] ?>"><?= $value['language'] ?></a>
        </li>                            
    <?php endforeach; ?>
</ul>
<br>

<div class="tab-content clearfix">
    <?php foreach ($url_alias as $key => $value) : ?>
        <div class="tab-pane container <?php if ($key == 0): ?> active <?php endif; ?>" id="url_aliasTab<?= $value['id'] ?>">
            <div class="form-group row">
                <label class="control-label col-md-2"><?= humanize('keyword') ?></label>
                <div class="col-md-10">
                    <input name="url_alias[<?= $value['id'] ?>][keyword]" value="<?= $value['keyword'] ?>" placeholder="<?= humanize('keyword') ?>" class="form-control" type="text">
                    <span class="help-block"></span>
                </div>
            </div>   
            <div class="form-group row">
                <label class="control-label col-md-2"><?= humanize('meta_title') ?></label>
                <div class="col-md-10">
                    <input name="url_alias[<?= $value['id'] ?>][meta_title]" value="<?= $value['meta_title'] ?>" placeholder="<?= humanize('meta_title') ?>" class="form-control" type="text">
                    <span class="help-block"></span>
                </div>
            </div>   
            <div class="form-group row">
                <label class="control-label col-md-2"><?= humanize('meta_keyword') ?></label>
                <div class="col-md-10">                    
                    <textarea name="url_alias[<?= $value['id'] ?>][meta_keyword]"  placeholder="<?= humanize('meta_keyword') ?>" class="form-control"><?= $value['meta_keyword'] ?></textarea>
                    <span class="help-block"></span>
                </div>
            </div>   

            <div class="form-group row">
                <label class="control-label col-md-2"><?= humanize('meta_description') ?></label>
                <div class="col-md-10">                    
                    <textarea name="url_alias[<?= $value['id'] ?>][meta_description]"  placeholder="<?= humanize('meta_description') ?>" class="form-control"><?= $value['meta_description'] ?></textarea>
                    <span class="help-block"></span>
                </div>
            </div>  
        </div>
    <?php endforeach; ?>
</div>