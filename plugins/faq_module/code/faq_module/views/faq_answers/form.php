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
                        <label class="control-label col-md-2"><?= humanize('faq_questions') ?></label>
                        <div class="col-md-10">
                            <select name="question_id" id="question_id" class="form-control">
                                <?php if ($faq_questions): ?> 
                                    <?php foreach ($faq_questions as $value) : ?>
                                        <?php if ($value['id'] == $question_id): ?>
                                            <option value="<?= $value['id'] ?>" selected><?= $value['text'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['text'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <ul class="nav nav-tabs">
                        <?php foreach ($details as $key => $value) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#detailsTab<?= $value['id'] ?>"><?= $value['language'] ?></a>
                            </li>                            
                        <?php endforeach; ?>
                    </ul>
                    <br>

                    <div class="tab-content clearfix">
                        <?php foreach ($details as $key => $value) : ?>
                            <div class="tab-pane container <?php if ($key == 0): ?> active <?php endif; ?>" id="detailsTab<?= $value['id'] ?>">
                                <div class="form-group row">
                                    <label class="control-label col-md-2"><?= humanize('text') ?></label>
                                    <div class="col-md-10">
                                        <textarea name="details[<?= $value['id'] ?>][text]"  placeholder="<?= humanize('text') ?>" class="form-control"><?= $value['text'] ?></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>   
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>

<script>
    $('#question_id').select2();   
</script>