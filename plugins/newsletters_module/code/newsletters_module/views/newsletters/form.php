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
                        <label class="control-label col-md-2"><?= humanize('name') ?></label>
                        <div class="col-md-10">
                            <input name="name" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('email') ?></label>
                        <div class="col-md-10">
                            <input name="email" value="<?= $email ?>" placeholder="<?= humanize('email') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('contact') ?></label>
                        <div class="col-md-10">
                            <input name="contact" value="<?= $contact ?>" placeholder="<?= humanize('contact') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('subscribe') ?></label>
                        <div class="col-md-10">
                            <select name="subscribe" class="form-control">
                                <?php if ($subscribes): ?> 
                                    <?php foreach ($subscribes as $key => $value) : ?>
                                        <?php if ($key == $subscribe): ?>
                                            <option value="<?= $key ?>" selected><?= $value ?></option>
                                        <?php else: ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>
