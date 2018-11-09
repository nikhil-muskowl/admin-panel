<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">Home</a>
        </li>        
    </ul>

    <form class="form-inline ml-auto">
        <div class="input-group input-group-sm">
            <select name="language_id" id="language_id" class="form-control">
                <option value="0">Select Language</option>
                <?php if ($this->languages_lib->getAll()): ?>
                    <?php foreach ($this->languages_lib->getAll() as $value) : ?>
                        <?php if ($this->languages_lib->getLanguageId() == $value['id']): ?>
                            <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>                        
                        <?php else: ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>                        
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>            
        </div>
    </form>
</nav>
<!-- /.navbar -->

<script>
    $('#language_id').select2();
    $('#language_id').on('change', function (e) {
//        alert(this.value);
        $.ajax({
            url: '<?= base_url('settings/api/languages_api/switch/') ?>' + this.value,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    notification('Success:', 'success', data.message);
                    $(location).attr('href', '<?= current_url() ?>');
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
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', 'error');
            }
        });
    });
</script>