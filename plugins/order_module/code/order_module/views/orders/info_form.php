<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('user') ?></label>
    <div class="col-md-10">
        <select name="user_id" id="user_id" class="form-control" onchange="user_info(this.value);">
            <option value="0">--Select--</option>
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
    <label class="control-label col-md-2"><?= humanize('name') ?></label>
    <div class="col-md-10">
        <input name="name" value="<?= $name ?>" placeholder="<?= humanize('name') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('email') ?></label>
    <div class="col-md-10">
        <input name="email" value="<?= $email ?>" placeholder="<?= humanize('email') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('contact') ?></label>
    <div class="col-md-10">
        <input name="contact" value="<?= $contact ?>" placeholder="<?= humanize('contact') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<script>
    $('#user_id').select2();
    $('#user_id').trigger('change');

    function user_info(user_id) {
        $.ajax({
            url: "<?= $ajax_users ?>",
            type: "POST",
            data: {
                user_id: user_id,
            },
            dataType: "JSON",
            success: function (data) {
                if (data['status']) {
                    $('input[name=\'name\']').val(data.result.name);
                    $('input[name=\'email\']').val(data.result.email);
                    $('input[name=\'contact\']').val(data.result.contact);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', errorThrown);
            }
        });
    }
      
</script>