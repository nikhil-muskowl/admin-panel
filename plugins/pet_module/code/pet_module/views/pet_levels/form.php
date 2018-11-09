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
                        <label class="control-label col-md-2"><?= humanize('pet') ?></label>
                        <div class="col-md-10">
                            <select name="pet_id" id="pet_id" class="form-control">
                                <?php if ($pets): ?> 
                                    <?php foreach ($pets as $value) : ?>
                                        <?php if ($value['id'] == $pet_id): ?>
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
                        <label class="control-label col-md-2"><?= humanize('level') ?></label>
                        <div class="col-md-10">
                            <input name="level" value="<?= $level ?>" placeholder="<?= humanize('title') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div> 
                    
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('points') ?></label>
                        <div class="col-md-10">
                            <input name="points" value="<?= $points ?>" placeholder="<?= humanize('points') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div> 

                </form>
            </div>    
        </div>
    </div>
</div>

<script>
    $('#pet_id').select2();    
</script>