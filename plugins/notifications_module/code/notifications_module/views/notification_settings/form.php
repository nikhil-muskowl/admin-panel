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
                        <label class="control-label col-md-2"><?= humanize('fcm_key') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="fcm_key" placeholder="<?= humanize('fcm_key') ?>" class="form-control"><?= $fcm_key ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('pushy_key') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="pushy_key" placeholder="<?= humanize('pushy_key') ?>" class="form-control"><?= $pushy_key ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div> 

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


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