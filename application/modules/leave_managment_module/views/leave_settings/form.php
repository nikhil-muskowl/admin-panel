<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">
                <div class="button-group float-right">
                    <button type="button" id="btnSave" onclick="save_setting()" class="btn btn-primary">Save</button>            
                </div>
                <h2 class="card-title">Setting</h2>
            </div>
            <div class="card-body">
                <form action="#" id="form" class="form-horizontal">

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('pending_id') ?></label>
                        <div class="col-md-10">
                            <select name="pending_id" id="pending_id" class="form-control">
                                <?php if ($leave_statuses): ?> 
                                    <?php foreach ($leave_statuses as $value) : ?>
                                        <?php if ($value['id'] == $pending_id): ?>
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
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('approved_id') ?></label>
                        <div class="col-md-10">
                            <select name="approved_id" id="approved_id" class="form-control">
                                <?php if ($leave_statuses): ?> 
                                    <?php foreach ($leave_statuses as $value) : ?>
                                        <?php if ($value['id'] == $approved_id): ?>
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
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('cancel_id') ?></label>
                        <div class="col-md-10">
                            <select name="cancel_id" id="cancel_id" class="form-control">
                                <?php if ($leave_statuses): ?> 
                                    <?php foreach ($leave_statuses as $value) : ?>
                                        <?php if ($value['id'] == $cancel_id): ?>
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
<script type="text/javascript">
    
     $('#pending_id').select2();
     $('#approved_id').select2();
     $('#cancel_id').select2();
     
    function save_setting() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        var formData = new FormData($('#form')[0]);

        $.ajax({
            url: '<?= $ajax_save ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    notification('Success:', 'success', data.message);
                    clear_form_validation();
                    $(location).attr('href', '<?= $ajax_list ?>');
                } else {
                    if (data.result) {
                        notification('Warning:', 'warning', data.message);
                        data.result.forEach(i => {
                            $('[name="' + i.id + '"]').closest('.form-group').addClass('has-error');
                            $('[name="' + i.id + '"]').nextAll('.help-block').text(i.text);
                        });
                    } else {
                        notification('Error:', 'error', data.message);
                    }
                }
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', 'error');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            }
        });
    }
</script>