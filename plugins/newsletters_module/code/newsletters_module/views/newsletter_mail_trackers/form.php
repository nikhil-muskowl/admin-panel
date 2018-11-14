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
                        <label class="control-label col-md-2"><?= humanize('title') ?></label>
                        <div class="col-md-10">
                            <input name="title" value="<?= $title ?>" placeholder="<?= humanize('title') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
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
                        <label class="control-label col-md-2"><?= humanize('to_email') ?></label>
                        <div class="col-md-10">
                            <input name="to_email" value="<?= $to_email ?>" placeholder="<?= humanize('to_email') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('subject') ?></label>
                        <div class="col-md-10">
                            <input name="subject" value="<?= $subject ?>" placeholder="<?= humanize('subject') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('text') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="text" placeholder="<?= humanize('text') ?>" class="form-control"><?= $text ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('html') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="html" data-toggle="tinymce"  placeholder="<?= humanize('html') ?>" class="form-control"><?= $html ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>  
                </form>
            </div>    
        </div>
    </div>
</div>
