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
                        <label class="control-label col-md-2"><?= humanize('name') ?></label>
                        <div class="col-md-10">
                            <input name="name" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('iso_code_2') ?></label>
                        <div class="col-md-10">
                            <input name="iso_code_2" value="<?= $iso_code_2 ?>" placeholder="<?= humanize('iso_code_2') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('iso_code_3') ?></label>
                        <div class="col-md-10">
                            <input name="iso_code_3" value="<?= $iso_code_3 ?>" placeholder="<?= humanize('iso_code_3') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('address_format') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="address_format"  placeholder="<?= humanize('address_format') ?>" class="form-control"><?= $address_format ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div> 
                </form>
            </div>    
        </div>
    </div>
</div>
