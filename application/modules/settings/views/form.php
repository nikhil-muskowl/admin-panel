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
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="#generalTab" class="nav-link active" data-toggle="tab"><?= humanize('general') ?></a></li>
                        <li class="nav-item"><a href="#addressTab" class="nav-link" data-toggle="tab"><?= humanize('address') ?></a></li>
                        <li class="nav-item"><a href="#mailTab" class="nav-link" data-toggle="tab"><?= humanize('mail_setting') ?></a></li>    
                        <li class="nav-item"><a href="#formatTab" class="nav-link" data-toggle="tab"><?= humanize('format_setting') ?></a></li>    
                        <li class="nav-item"><a href="#imageTab" class="nav-link" data-toggle="tab"><?= humanize('image_setting') ?></a></li>    
                    </ul>
                    <br/> 

                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="generalTab">

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('name') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" name="name">
                                    <span class="help-block"></span>
                                </div>
                            </div>        

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('contact') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $contact ?>" placeholder="<?= humanize('contact') ?>" name="contact">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('email') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $email ?>" placeholder="<?= humanize('email') ?>" name="email">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="addressTab">       
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('address') ?></label>
                                <div class="col-md-9">
                                    <textarea name="address" class="form-control" rows="5" placeholder="<?= humanize('address') ?>"><?= $address ?></textarea>                
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="mailTab">

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('mail_protocol') ?></label>
                                <div class="col-md-9">
                                    <select class="form-control" name="mail_protocol">
                                        <option value="mail" <?php if ($mail_protocol == 'mail'): ?>selected<?php endif; ?>>Mail</option>
                                        <option value="smtp" <?php if ($mail_protocol == 'smtp'): ?>selected<?php endif; ?>>SMTP</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('smtp_hostname') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $smtp_hostname ?>" placeholder="<?= humanize('smtp_hostname') ?>" name="smtp_hostname">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('smtp_username') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $smtp_username ?>" placeholder="<?= humanize('smtp_username') ?>" name="smtp_username">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('smtp_password') ?></label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" value="<?= $smtp_password ?>" placeholder="<?= humanize('smtp_password') ?>" name="smtp_password">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('smtp_port') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $smtp_port ?>" placeholder="<?= humanize('smtp_port') ?>" name="smtp_port">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('smtp_timeout') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $smtp_timeout ?>" placeholder="<?= humanize('smtp_timeout') ?>" name="smtp_timeout">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="formatTab">
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('date_format') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $date_format ?>" placeholder="<?= humanize('date_format') ?>" name="date_format">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('datetime_format') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $datetime_format ?>" placeholder="<?= humanize('datetime_format') ?>" name="datetime_format">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3"><?= humanize('decimal_format') ?></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?= $decimal_format ?>" placeholder="<?= humanize('decimal_format') ?>" name="decimal_format">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="imageTab">
                            <?php include 'image_setting.php'; ?>
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