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
                        <label class="control-label col-md-2"><?= humanize('users') ?></label>
                        <div class="col-md-10">
                            <select name="user_id" id="user_id" class="form-control">
                                <?php if ($users): ?> 
                                    <?php foreach ($users as $value) : ?>
                                        <?php if ($value['id'] == $user_id): ?>
                                            <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>                                
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('provider') ?></label>
                        <div class="col-md-10">
                            <select name="provider" id="provider" class="form-control">
                                <?php if ($providers): ?> 
                                    <?php foreach ($providers as $key => $pro) : ?>
                                        <?php if ($key == $provider): ?>
                                            <option value="<?= $key ?>" selected><?= $pro ?></option>
                                        <?php else: ?>
                                            <option value="<?= $key ?>"><?= $pro ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>                                
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('type') ?></label>
                        <div class="col-md-10">
                            <select name="type" id="type" class="form-control">
                                <?php if ($types): ?> 
                                    <?php foreach ($types as $key => $ty) : ?>
                                        <?php if ($key == $type): ?>
                                            <option value="<?= $key ?>" selected><?= $ty ?></option>
                                        <?php else: ?>
                                            <option value="<?= $key ?>"><?= $ty ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>                                
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('code') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="code" placeholder="<?= humanize('code') ?>" class="form-control"><?= $code ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>  

                </form>
            </div>    
        </div>
    </div>
</div>
<script>
    $('#user_id').select2();
    $('#provider').select2();
    $('#type').select2();
</script>