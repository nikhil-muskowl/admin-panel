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
                        <label class="control-label col-md-3"><?= humanize('run') ?></label>
                        <div class="col-md-9">
                            <input name="run" value="<?= $run ?>" placeholder="<?= humanize('run') ?>" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('ball') ?></label>
                        <div class="col-md-9">
                            <input name="ball" value="<?= $ball ?>" placeholder="<?= humanize('ball') ?>" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('fours') ?></label>
                        <div class="col-md-9">
                            <input name="fours" value="<?= $fours ?>" placeholder="<?= humanize('fours') ?>" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('sixs') ?></label>
                        <div class="col-md-9">
                            <input name="sixs" value="<?= $sixs ?>" placeholder="<?= humanize('sixs') ?>" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                </form>
            </div>    
        </div>
    </div>
</div>

