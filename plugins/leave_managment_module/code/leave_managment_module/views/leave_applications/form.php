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
                        <label class="control-label col-md-2"><?= humanize('leave_reason') ?></label>
                        <div class="col-md-10">
                            <select name="leave_reason_id" id="leave_reason_id" class="form-control">
                                <?php if ($leave_reasons): ?> 
                                    <?php foreach ($leave_reasons as $value) : ?>
                                        <?php if ($value['id'] == $leave_reason_id): ?>
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
                        <label class="control-label col-md-2"><?= humanize('leave_type') ?></label>
                        <div class="col-md-10">
                            <select name="leave_type_id" id="leave_type_id" class="form-control">
                                <?php if ($leave_types): ?> 
                                    <?php foreach ($leave_types as $value) : ?>
                                        <?php if ($value['id'] == $leave_type_id): ?>
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
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('total') ?></label>
                        <div class="col-md-10">
                            <input name="total" value="<?= $total ?>" placeholder="<?= humanize('total') ?>" class="form-control" type="text" readonly>
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
                        <label class="control-label col-md-2"><?= humanize('leave_status') ?></label>
                        <div class="col-md-10">
                            <select name="leave_status_id" id="leave_status_id" class="form-control">
                                <?php if ($leave_statuses): ?> 
                                    <?php foreach ($leave_statuses as $value) : ?>
                                        <?php if ($value['id'] == $leave_status_id): ?>
                                            <option value="<?= $value['id'] ?>" selected><?= $value['title'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>                                
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

<script>
    $('#user_id').select2();
    $('#leave_reason_id').select2();
    $('#leave_type_id').select2();
    $('#leave_status_id').select2();
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

    check_total_leave();

    $('input[name=from_date]').change(function () {
        check_total_leave();
    });

    $('input[name=to_date]').change(function () {
        check_total_leave();
    });
    
    $('input[name=to_date]').keyup(function () {
        check_total_leave();
    });

    $('#leave_type_id').change(function () {
        check_total_leave();
    });

    function check_total_leave() {

        var formData = new FormData($('#form')[0]);

        $.ajax({
            url: '<?= $ajax_date_days ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('input[name=total]').val(data.total);
                }else{
                    $('input[name=total]').val('');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    }
</script>