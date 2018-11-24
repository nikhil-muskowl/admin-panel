<?= $map['js'] ?>

<script src="<?= base_url('assets/js/autocomplete.js') ?>" type="text/javascript"></script>


<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('location_api_type') ?></label>
    <div class="col-md-10">
        <select name="location_api_type" id="location_api_type" class="form-control" style="width: 100%">
            <?php if ($location_api_types): ?> 
                <?php foreach ($location_api_types as $key => $value) : ?>
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
        <label class="control-label col-md-2"><?= humanize('baidu_cities') ?></label>
        <div class="col-md-10">
            <select name="baidu_area_id" id="baidu_area_id" class="form-control" style="width: 100%">
                <?php if ($baidu_cities): ?> 
                    <?php foreach ($baidu_cities as $value) : ?>
                        <option value="<?= $value['area_id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>            
                <?php endif; ?>
            </select>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2"><?= humanize('baidu_location') ?></label>
        <div class="col-md-10">
            <input name="baidu_location" id="baidu_location" value="<?= $location ?>" placeholder="<?= humanize('baidu_location') ?>" class="form-control" type="text">
            <span class="help-block"></span>
        </div>
    </div>
    <div id="allmap"></div>
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
    $('#location_api_type').select2();
    $('#baidu_area_id').select2();

    $('#location_api_type').on('change', function () {
        if (this.value == 'google') {
            $('#google-area').show();
            $('#baidu-area').hide();
        } else {
            $('#google-area').hide();
            $('#baidu-area').show();
        }
    });

    $('#location_api_type').val('google').trigger('change');


    $("#baidu_location").autocomplete({
        'source': function (request, response) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('baidu/location') ?>",
                data: {
                    query: request,
                    location: $('#baidu_area_id').val()
                },
                dataType: 'json',
                success: function (json) {
                    response($.map(json.result, function (item) {
                        return {
                            label: item['name'],
                            value: item['uid'],
                            location: item['location'],
                        }
                    }));
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notification('Error:', 'error', 'error');
                }
            });
        },
        'select': function (item) {
            if (item) {
                console.log(item);
                $('#baidu_location').val(item.label);
                $('#latitude').val(item.location.lat);
                $('#longitude').val(item.location.lng);
            }
        }
    });


</script>
