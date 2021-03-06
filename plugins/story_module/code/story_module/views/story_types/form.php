<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">   
                <div class="button-group float-right">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <a href="<?= $ajax_list ?>" class="btn btn-danger">Cancel</a>

                </div>
                <div class="card-title">
                    <h2><?= $meta_title ?></h2>
                </div>  
            </div>
            <div class="card-body">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="<?= $id ?>" name="id"/>  

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
                        <label class="control-label col-md-2"><?= humanize('is_upload') ?></label>
                        <div class="col-md-10">
                            <select name="is_upload" id="is_upload" class="form-control">
                                <?php if ($is_uploads): ?> 
                                    <?php foreach ($is_uploads as $key => $value) : ?>
                                        <?php if ($key == $is_upload): ?>
                                            <option value="<?= $key ?>" selected><?= $value ?></option>
                                        <?php else: ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

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
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>