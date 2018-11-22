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
                            <a class="nav-link" data-toggle="tab" href="#imagesTab">Images</a>
                        </li>                        
                    </ul>
                    <br>

                    <div class="tab-content clearfix">
                        <div class="tab-pane container active" id="commonTab">
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

                            <?php if ($event_module): ?>
                                <div class="form-group row">
                                    <label class="control-label col-md-2"><?= humanize('events') ?></label>
                                    <div class="col-md-10">
                                        <select name="event_id" id="event_id" class="form-control">
                                            <?php if ($events): ?> 
                                                <?php foreach ($events as $value) : ?>
                                                    <?php if ($value['id'] == $event_id): ?>
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
                            <?php endif; ?>

                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('story_type') ?></label>
                                <div class="col-md-10">
                                    <select name="types[]" multiple id="types" class="form-control">
                                        <?php if ($story_types): ?> 
                                            <?php foreach ($story_types as $value) : ?>
                                                <?php if (in_array($value['id'], $types)): ?>
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
                                <label class="control-label col-md-2"><?= humanize('tages') ?></label>
                                <div class="col-md-10">
                                    <select name="tags[]" multiple id="tags" class="form-control">
                                        <?php if ($tags): ?> 
                                            <?php foreach ($tags as $value) : ?>
                                                <option value="<?= $value ?>" selected><?= $value ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="0">No result</option>
                                        <?php endif; ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <?php include 'details_form.php'; ?>
                        </div>

                        <div class="tab-pane container fade" id="imageTab">
                            <?php include 'image_form.php'; ?>
                        </div>
                        <div class="tab-pane container fade" id="imagesTab">
                            <?php include 'images_form.php'; ?>
                        </div>
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>

<script>
    $('#user_id').select2();
    $('#event_id').select2();
    $('#types').select2();
    $('#tags').select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>
