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
                        <label class="control-label col-md-3"><?= humanize('password') ?></label>
                        <div class="col-md-9">
                            <input name="password" placeholder="<?= humanize('password') ?>" class="form-control" type="password">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('confirm_password') ?></label>
                        <div class="col-md-9">
                            <input name="passconf" placeholder="<?= humanize('confirm_password') ?>" class="form-control" type="password">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>