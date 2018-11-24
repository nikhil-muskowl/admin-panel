<?= $map['js'] ?>
<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('api_type') ?></label>
    <div class="col-md-10">
        <select name="api_type" id="api_type" class="form-control" style="width: 100%">
            <?php if ($api_types): ?> 
                <?php foreach ($api_types as $key => $value) : ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach; ?>            
            <?php endif; ?>
        </select>
        <span class="help-block"></span>
    </div>
</div>

<div id="google-area">
    <div class="form-group row">
        <label class="control-label col-md-2"><?= humanize('google_location') ?></label>
        <div class="col-md-10">
            <input name="google_location" id="google_location" value="<?= $location ?>" placeholder="<?= humanize('google_location') ?>" class="form-control" type="text">
            <span class="help-block"></span>
        </div>
    </div>

    <?= $map['html'] ?>
    <br>
</div>

<div id="baidu-area">
    <div class="form-group row">
        <label class="control-label col-md-2"><?= humanize('baidu_location') ?></label>
        <div class="col-md-10">
            <input name="baidu_location" value="<?= $location ?>" placeholder="<?= humanize('baidu_location') ?>" class="form-control" type="text">
            <span class="help-block"></span>
        </div>
    </div>
</div>





<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('latitude') ?></label>
    <div class="col-md-10">
        <input name="latitude" id="latitude" value="<?= $latitude ?>" placeholder="<?= humanize('latitude') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('longitude') ?></label>
    <div class="col-md-10">
        <input name="longitude" id="longitude" value="<?= $longitude ?>" placeholder="<?= humanize('longitude') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div>


<script>
    $('#api_type').select2();

    $('#api_type').on('change', function () {
        if (this.value == 'google') {
            $('#google-area').show();
            $('#baidu-area').hide();
        } else {
            $('#google-area').hide();
            $('#baidu-area').show();
        }
    });

    $('#api_type').val('google').trigger('change');
</script>