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
                        <label class="control-label col-md-2"><?= humanize('language_id') ?></label>
                        <div class="col-md-10">
                            <select name="language_id" id="language_id" class="form-control">
                                <?php if ($languages): ?> 
                                    <?php foreach ($languages as $value) : ?>
                                        <?php if ($value['id'] == $language_id): ?>
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
                        <label class="control-label col-md-2"><?= humanize('author') ?></label>
                        <div class="col-md-10">
                            <input name="author" value="<?= $author ?>" placeholder="<?= humanize('author') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('role') ?></label>
                        <div class="col-md-10">
                            <input name="role" value="<?= $role ?>" placeholder="<?= humanize('role') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('image') ?></label>
                        <div class="col-md-10">
                            <a href="" id="thumb-image" data-toggle="image">
                                <img alt="" name="" src="<?= $image_thumb ?>" class="img-fluid" data-placeholder="<?= $thumb ?>"/>                                
                                <input type="hidden" name="image" value="<?= $image ?>" id="input-image"/>
                            </a>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('text') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="text"  placeholder="<?= humanize('text') ?>" class="form-control"><?= $text ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div> 

                </form>
            </div>    
        </div>
    </div>
</div>

<script>
    $('#language_id').select2();
</script>