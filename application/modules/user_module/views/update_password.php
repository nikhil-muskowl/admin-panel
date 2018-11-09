<div class="container">
    <div class="row">
        <div class="col-md-8 my-auto">
            <div class="card">
                <div class="card-body">
                    <p>Enter email for update password</p>
                    <form action="#" id="form" method="post" enctype="multipart/form-data">                
                        <input type="hidden" value="<?= $id ?>" name="id"/>              
                        <div class="form-group row">
                            <label class="control-label col-md-3"><?= humanize('password') ?></label>
                            <div class="col-md-9">
                                <input name="password" placeholder="<?= humanize('password') ?>" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"><?= humanize('confirm_password') ?></label>
                            <div class="col-md-9">
                                <input name="passconf" placeholder="<?= humanize('confirm_password') ?>" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>                   
                        <button type="button" onclick="form_save()" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
       clear_form();
    });

   function clear_form(){
        $("input").change(function () {
            $(this).closest('.form-group').removeClass('has-error');
            $(this).nextAll('.help-block').empty();
        });
        $("textarea").change(function () {
            $(this).closest('.form-group').removeClass('has-error');
            $(this).nextAll('.help-block').empty();
        });
        $("select").change(function () {
            $(this).closest('.form-group').removeClass('has-error');
            $(this).nextAll('.help-block').empty();
        });
    }
    function form_save() {
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: '<?= $ajax_form ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function () {
                $("#loading").show();
                $('#button-submit').button('loading');
            },
            complete: function () {
                $("#loading").hide();
                $('#button-submit').button('reset');
            },
            success: function (data) {
                console.log(data);
                if (data.status) {
                    notification('Success:', 'success', data.message);
                    $('#form')[0].reset();
                    clear_form();
                    $(location).attr("href", data.redirect);
                } else {
                    data.result.forEach(i => {
                        $('[name="' + i.id + '"]').closest('.form-group').addClass('has-error');
                        $('[name="' + i.id + '"]').nextAll('.help-block').text(i.text);
                    });
                    notification('Warning:', 'warning', data.message);

                }

            }
        });
    }

    function form_submit(e) {
        if (e.keyCode == 13 || e.which == 13) {
            form_save();
        }
    }
</script>