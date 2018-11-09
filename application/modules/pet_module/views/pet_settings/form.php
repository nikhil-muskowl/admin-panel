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
                        <label class="control-label col-md-3"><?= humanize('register_points') ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?= $register_points ?>" placeholder="<?= humanize('register_points') ?>" name="register_points">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('story_upload_points') ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?= $story_upload_points ?>" placeholder="<?= humanize('story_upload_points') ?>" name="story_upload_points">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('story_comment_points') ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?= $story_comment_points ?>" placeholder="<?= humanize('story_comment_points') ?>" name="story_comment_points">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('story_like_points') ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?= $story_like_points ?>" placeholder="<?= humanize('story_like_points') ?>" name="story_like_points">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3"><?= humanize('story_dislike_points') ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?= $story_dislike_points ?>" placeholder="<?= humanize('story_dislike_points') ?>" name="story_dislike_points">
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