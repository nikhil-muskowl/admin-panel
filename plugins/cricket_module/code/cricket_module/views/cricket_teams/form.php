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
                        <label class="control-label col-md-3"><?= humanize('name') ?></label>
                        <div class="col-md-9">
                            <input name="name" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('points') ?></label>
                        <div class="col-md-9">
                            <input name="points" value="<?= $points ?>" placeholder="<?= humanize('points') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('remaining_points') ?></label>
                        <div class="col-md-9">
                            <input name="remaining_points" value="<?= $remaining_points ?>" placeholder="<?= humanize('remaining_points') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('description') ?></label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" placeholder="<?= humanize('description') ?>"><?= $description ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('image') ?></label>
                        <div class="col-md-9">
                            <a href="" data-toggle="image" class="img-fluid">
                                <img alt="" name="" src="<?= $image_thumb ?>" data-placeholder="<?= $thumb ?>"/>
                                <input type="hidden" name="image" value="<?= $image ?>" id="input-image" />
                            </a>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('banner') ?></label>
                        <div class="col-md-9">
                            <a href="" data-toggle="image" class="img-fluid">
                                <img alt="" name="" src="<?= $banner_thumb ?>" data-placeholder="<?= $thumb ?>"/>
                                <input type="hidden" name="banner" value="<?= $banner ?>" id="input-image" />
                            </a>
                            <span class="help-block"></span>
                        </div>
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>

