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
                    <input type="hidden" value="<?= $language_id ?>" name="language_id"/>  

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('user') ?></label>
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
                                <?php else: ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('story') ?></label>
                        <div class="col-md-10">
                            <select name="story_id" id="story_id" class="form-control">
                                <?php if ($stories): ?> 
                                    <?php foreach ($stories as $value) : ?>
                                        <?php if ($value['id'] == $story_id): ?>
                                            <option value="<?= $value['id'] ?>" selected><?= $value['title'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
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
                        <label class="control-label col-md-2"><?= humanize('story_commnets') ?></label>
                        <div class="col-md-10">
                            <select name="story_commnet_id" id="story_commnet_id" class="form-control">
                                <?php if ($story_commnets): ?> 
                                    <?php foreach ($story_commnets as $value) : ?>
                                        <?php if ($value['id'] == $story_commnet_id): ?>
                                            <option value="<?= $value['id'] ?>" selected><?= $value['comment'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['comment'] ?></option>
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
                        <label class="control-label col-md-2"><?= humanize('title') ?></label>
                        <div class="col-md-10">
                            <input name="title" value="<?= $title ?>" placeholder="<?= humanize('title') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('description') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="description" placeholder="<?= humanize('description') ?>" class="form-control"><?= $description ?></textarea>
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
    $('#story_id').select2();   
    $('#story_commnet_id').select2();   
</script>