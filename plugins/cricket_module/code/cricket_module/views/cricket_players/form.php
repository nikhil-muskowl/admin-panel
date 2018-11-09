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

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#commonTab">Common</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#imageTab">Image</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#detailsTab">Details</a>
                        </li>                        
                    </ul>
                    <br>

                    <div class="tab-content clearfix">
                        <div class="tab-pane container active" id="commonTab">
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('name') ?></label>
                                <div class="col-md-9">
                                    <input name="name" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('points') ?></label>
                                <div class="col-md-9">
                                    <input name="points" value="<?= $points ?>" placeholder="<?= humanize('points') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>   



                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('description') ?></label>
                                <div class="col-md-9">                    
                                    <textarea name="description"  placeholder="<?= humanize('description') ?>" class="form-control"><?= $description ?></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>   
                        </div>
                        <div class="tab-pane container fade" id="imageTab">
                            <?php include 'image_form.php'; ?>
                        </div>
                        <div class="tab-pane container fade" id="detailsTab">
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('team') ?></label>
                                <div class="col-md-9">
                                    <select name="team_id" id="team_id" class="form-control" style="width: 100%">
                                        <option value="0">---None---</option>
                                        <?php if ($cricket_teams): ?> 
                                            <?php foreach ($cricket_teams as $value) : ?>
                                                <?php if ($value['id'] == $team_id): ?>
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
                                <label class="control-label col-md-3"><?= humanize('type') ?></label>
                                <div class="col-md-9">
                                    <select name="type_id" id="type_id" class="form-control" style="width: 100%">
                                        <option value="0">---None---</option>
                                        <?php if ($cricket_tournament_types): ?> 
                                            <?php foreach ($cricket_tournament_types as $value) : ?>
                                                <?php if ($value['id'] == $type_id): ?>
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
                                <label class="control-label col-md-3"><?= humanize('batting_type') ?></label>
                                <div class="col-md-9">
                                    <select name="batting_type_id" id="batting_type_id" class="form-control" style="width: 100%">                                        
                                        <option value="0">---None---</option>
                                        <?php if ($cricket_batting_types): ?> 
                                            <?php foreach ($cricket_batting_types as $value) : ?>
                                                <?php if ($value['id'] == $batting_type_id): ?>
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
                                <label class="control-label col-md-3"><?= humanize('bowlling_type') ?></label>
                                <div class="col-md-9">
                                    <select name="bowlling_type_id" id="bowlling_type_id" class="form-control" style="width: 100%">                                        
                                        <option value="0">---None---</option>
                                        <?php if ($cricket_bowlling_types): ?> 
                                            <?php foreach ($cricket_bowlling_types as $value) : ?>
                                                <?php if ($value['id'] == $bowlling_type_id): ?>
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
                                <label class="control-label col-md-3"><?= humanize('roles') ?></label>
                                <div class="col-md-9">
                                    <select name="roles[]" id="roles" multiple class="form-control" style="width: 100%">                                
                                        <?php if ($cricket_roles): ?> 
                                            <?php foreach ($cricket_roles as $value) : ?>
                                                <?php if (in_array($value['id'], $roles)): ?>
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
                                <label class="control-label col-md-3"><?= humanize('tournament_levels') ?></label>
                                <div class="col-md-9">
                                    <select name="levels[]" id="levels" multiple class="form-control" style="width: 100%">                                
                                        <?php if ($cricket_tournament_levels): ?> 
                                            <?php foreach ($cricket_tournament_levels as $value) : ?>
                                                <?php if (in_array($value['id'], $levels)): ?>
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

                        </div>
                    </div>





                </form>
            </div>    
        </div>
    </div>
</div>



<script>
    $('#team_id').select2();
    $('#batting_type_id').select2();
    $('#bowlling_type_id').select2();
    $('#roles').select2();
    $('#levels').select2();
    $('#type_id').select2();
</script>