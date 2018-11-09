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
                                <label class="control-label col-md-3"><?= $this->lang->line('text_user_group') ?></label>
                                <div class="col-md-9">
                                    <select name="user_group_id" id="user_group_id" class="form-control">
                                        <?php if ($user_groups): ?> 
                                            <?php foreach ($user_groups as $value) : ?>
                                                <?php if ($value['id'] == $user_group_id): ?>
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
                                <label class="control-label col-md-3"><?= $this->lang->line('text_name') ?></label>
                                <div class="col-md-9">
                                    <input name="name" value="<?= $name ?>" placeholder="<?= $this->lang->line('text_name') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= $this->lang->line('text_email') ?></label>
                                <div class="col-md-9">
                                    <input name="email" value="<?= $email ?>" placeholder="<?= $this->lang->line('text_email') ?>" class="form-control" type="email">
                                    <span class="help-block"></span>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= $this->lang->line('text_contact') ?></label>
                                <div class="col-md-9">
                                    <input name="contact" value="<?= $contact ?>" placeholder="<?= $this->lang->line('text_contact') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= $this->lang->line('text_dob') ?></label>
                                <div class="col-md-9">
                                    <input name="dob" value="<?= $dob ?>" placeholder="<?= $this->lang->line('text_dob') ?>" id="datepicker" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= $this->lang->line('text_gender') ?></label>
                                <div class="col-md-9">
                                    <select name="gender_id" id="gender_id" class="form-control">
                                        <?php if ($genders): ?> 
                                            <?php foreach ($genders as $value) : ?>
                                                <?php if ($value['id'] == $gender_id): ?>
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
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
</script>