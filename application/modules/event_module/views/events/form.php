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
                            <a class="nav-link" data-toggle="tab" href="#detailTab">Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#locationTab">Location</a>
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

                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('from_date') ?></label>
                                <div class="col-md-10">
                                    <input name="from_date" value="<?= $from_date ?>" placeholder="<?= humanize('from_date') ?>" id="fromDatePicker" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('to_date') ?></label>
                                <div class="col-md-10">
                                    <input name="to_date" value="<?= $to_date ?>" placeholder="<?= humanize('to_date') ?>" id="toDatePicker" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 





                        </div>

                        <div class="tab-pane container fade" id="imageTab">
                            <?php include 'image_form.php'; ?>
                        </div>

                        <div class="tab-pane container fade" id="detailTab">
                            <?php include 'details_form.php'; ?>
                        </div>
                        <div class="tab-pane container fade" id="locationTab">
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('latitude') ?></label>
                                <div class="col-md-10">
                                    <input name="latitude" value="<?= $latitude ?>" placeholder="<?= humanize('latitude') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('longitude') ?></label>
                                <div class="col-md-10">
                                    <input name="longitude" value="<?= $longitude ?>" placeholder="<?= humanize('longitude') ?>" class="form-control" type="text">
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
    $('#user_id').select2();
    $('#fromDatePicker').datetimepicker({
        footer: true,
        modal: true,
        uiLibrary: 'bootstrap4',
        ampm: true,
        format: 'dd-mm-yyyy hh:MM'

    });
    $('#toDatePicker').datetimepicker({
        footer: true,
        modal: true,
        uiLibrary: 'bootstrap4',
        ampm: true,
        format: 'dd-mm-yyyy hh:MM'
    });
</script>
