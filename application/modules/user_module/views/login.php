<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="#" id="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                    <span class="help-block"></span>                            
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" onkeyup="form_submit(event);" class="form-control" placeholder="Password">
                    <span class="help-block"></span>
                </div>               
                <p class="mb-1">
                    <a href="<?= $link_forgot_password ?>">I forgot my password</a>
                </p>
                <button type="button" onclick="form_save()" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("input").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().next().empty();
        });
        $("textarea").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().next().empty();
        });
        $("select").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().next().empty();
        });
    });
    function form_save() {
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: '<?= $ajax_login ?>',
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