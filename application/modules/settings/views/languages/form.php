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
                        <label class="control-label col-md-3"><?= humanize('code') ?></label>
                        <div class="col-md-9">
                            <input name="code" value="<?= $code ?>" placeholder="<?= humanize('code') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('name') ?></label>
                        <div class="col-md-9">
                            <input name="name" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('sort_order') ?></label>
                        <div class="col-md-9">
                            <input name="sort_order" value="<?= $sort_order ?>" placeholder="<?= humanize('sort_order') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>   
                </form>
            </div>    
        </div>
    </div>
</div>