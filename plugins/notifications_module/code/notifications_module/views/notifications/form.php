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
                    </ul>
                    <br>

                    <div class="tab-content clearfix">
                        <div class="tab-pane container active" id="commonTab">      
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('users') ?></label>
                                <div class="col-md-10">
                                    <select name="users[]" multiple id="users" class="form-control">
                                        <?php if ($users): ?> 
                                            <?php foreach ($users as $value) : ?>
                                                <?php if (in_array($value['id'], $notification_users)): ?>
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
                            <?php include 'details_form.php'; ?>
                        </div>

                        <div class="tab-pane container fade" id="imageTab">
                            <?php include 'image_form.php'; ?>
                        </div>                        
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>
<script>
    $('#users').select2();
</script>