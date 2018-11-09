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
                        <label class="control-label col-md-3"><?= humanize('player') ?></label>
                        <div class="col-md-9">
                            <select name="player_id" id="player_id" class="form-control">                                
                                <?php if ($cricket_players): ?> 
                                    <?php foreach ($cricket_players as $value) : ?>
                                        <?php if ($value['id'] == $player_id): ?>
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
                        <label class="control-label col-md-3"><?= humanize('role') ?></label>
                        <div class="col-md-9">
                            <select name="player_role_id" id="player_role_id" class="form-control">                                
                                <?php if ($cricket_roles): ?> 
                                    <?php foreach ($cricket_roles as $value) : ?>
                                        <?php if ($value['id'] == $player_role_id): ?>
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
                        <label class="control-label col-md-3"><?= humanize('description') ?></label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" placeholder="<?= humanize('description') ?>"><?= $description ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>  
                </form>
            </div>    
        </div>
    </div>
</div>
