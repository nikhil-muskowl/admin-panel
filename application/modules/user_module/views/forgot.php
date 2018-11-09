<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Enter email for update password</p>
            <form action="#" id="form" method="post" enctype="multipart/form-data">                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" onkeyup="form_submit(event);" class="form-control" placeholder="Email">
                    <span class="help-block"></span>
                </div>                        
                <button type="button" onclick="form_save()" class="btn btn-primary">Submit</button>
                <a href="<?= base_url('admin')?>" class="btn btn-danger">Cancel</a>
            </form>
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