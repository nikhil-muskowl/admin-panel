<ul class="nav nav-tabs">
    <?php foreach ($details as $key => $value) : ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#detailsTab<?= $value['id'] ?>"><?= $value['language'] ?></a>
        </li>                            
    <?php endforeach; ?>
</ul>
<br>

<div class="tab-content clearfix">
    <?php foreach ($details as $key => $value) : ?>
        <div class="tab-pane container <?php if ($key == 0): ?> active <?php endif; ?>" id="detailsTab<?= $value['id'] ?>">
            <div class="form-group row">
                <label class="control-label col-md-2"><?= humanize('title') ?></label>
                <div class="col-md-10">
                    <input name="details[<?= $value['id'] ?>][title]" value="<?= $value['title'] ?>" placeholder="<?= humanize('title') ?>" class="form-control" type="text">
                    <span class="help-block"></span>
                </div>
            </div>   
            <div class="form-group row">
                <label class="control-label col-md-2"><?= humanize('description') ?></label>
                <div class="col-md-10">                    
                    <textarea name="details[<?= $value['id'] ?>][description]"  placeholder="<?= humanize('description') ?>" class="form-control"><?= $value['description'] ?></textarea>
                    <span class="help-block"></span>
                </div>
            </div>   

            <div class="form-group row">
                <label class="control-label col-md-2"><?= humanize('html') ?></label>
                <div class="col-md-10">                    
                    <textarea name="details[<?= $value['id'] ?>][html]" data-toggle="tinymce"  placeholder="<?= humanize('html') ?>" class="form-control"><?= $value['html'] ?></textarea>
                    <span class="help-block"></span>
                </div>
            </div>  
        </div>
    <?php endforeach; ?>
</div>