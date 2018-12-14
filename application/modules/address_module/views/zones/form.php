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
                        <label class="control-label col-md-2"><?= $this->lang->line('text_country') ?></label>
                        <div class="col-md-10">
                            <select name="country_id" id="country_id" class="form-control">
                                <?php if ($countries): ?> 
                                    <?php foreach ($countries as $value) : ?>
                                        <?php if ($value['id'] == $country_id): ?>
                                            <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('name') ?></label>
                        <div class="col-md-10">
                            <input name="name" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('code') ?></label>
                        <div class="col-md-10">
                            <input name="code" value="<?= $code ?>" placeholder="<?= humanize('code') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>                      
                </form>
            </div>    
        </div>
    </div>
</div>
<script>
    $('#country_id').select2();
</script>