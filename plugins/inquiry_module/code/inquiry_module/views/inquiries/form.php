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
                        <label class="control-label col-md-2"><?= humanize('inquiry_type') ?></label>
                        <div class="col-md-10">
                            <select name="types[]" multiple id="types" class="form-control">
                                <?php if ($inquiry_types): ?> 
                                    <?php foreach ($inquiry_types as $value) : ?>
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
                        <label class="control-label col-md-2"><?= $this->lang->line('text_name') ?></label>
                        <div class="col-md-10">
                            <input name="name" value="<?= $name ?>" placeholder="<?= $this->lang->line('text_name') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= $this->lang->line('text_email') ?></label>
                        <div class="col-md-10">
                            <input name="email" value="<?= $email ?>" placeholder="<?= $this->lang->line('text_email') ?>" class="form-control" type="email">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= $this->lang->line('text_contact') ?></label>
                        <div class="col-md-10">
                            <input name="contact" value="<?= $contact ?>" placeholder="<?= $this->lang->line('text_contact') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= $this->lang->line('text_inquiry') ?></label>
                        <div class="col-md-10">
                            <textarea name="inquiry" cols="10" rows="5" class="form-control" placeholder="<?= $this->lang->line('text_inquiry') ?>"><?=$inquiry?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>

<script>
    $('#types').select2();
</script>
