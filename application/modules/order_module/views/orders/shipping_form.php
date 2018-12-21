<div class="form-group row">
    <label class="control-label col-md-2"><?= $this->lang->line('text_address') ?></label>
    <div class="col-md-10">
        <select name="shipping_address_id" id="shipping_address_id" class="form-control" onchange="shippingAddresses(this.value);" style="width: 100%;">
        </select>   
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('shipping_name') ?></label>
    <div class="col-md-10">
        <input name="shipping_name" value="<?= $shipping_name ?>" placeholder="<?= humanize('shipping_name') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= $this->lang->line('text_country') ?></label>
    <div class="col-md-10">
        <select name="shipping_country_id" id="shipping_country_id" class="form-control" onchange="shipping_select_zone(this.value);" style="width: 100%;">
            <?php if ($countries): ?> 
                <?php foreach ($countries as $value) : ?>
                    <?php if ($value['id'] == $shipping_country_id): ?>
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
    <label class="control-label col-md-2"><?= $this->lang->line('text_zone') ?></label>
    <div class="col-md-10">
        <select name="shipping_zone_id" id="shipping_zone_id" class="form-control" style="width: 100%;">
            <option value="">---Select---</option>
        </select>   
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('shipping_city') ?></label>
    <div class="col-md-10">
        <input name="shipping_city" value="<?= $shipping_city ?>" placeholder="<?= humanize('shipping_city') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('shipping_postcode') ?></label>
    <div class="col-md-10">
        <input name="shipping_postcode" value="<?= $shipping_postcode ?>" placeholder="<?= humanize('shipping_postcode') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('shipping_address') ?></label>
    <div class="col-md-10">        
        <textarea name="shipping_address" placeholder="<?= humanize('shipping_address') ?>" class="form-control"><?= $shipping_address ?></textarea>
        <span class="help-block"></span>
    </div>
</div>

<script>
    $('#user_id').on('change', function () {
        shippingUserAddress(this.value);
    });
    $('#user_id').trigger('change');

    $(document).ready(function () {
        $('#shipping_country_id').select2();
        $('#shipping_zone_id').select2();
        shippingSelectZone('<?= $shipping_country_id ?>', '<?= $shipping_zone_id ?>');
    });


    function shippingUserAddress(user_id) {
        $.ajax({
            url: "<?= $ajax_address ?>",
            type: "POST",
            data: {
                user_id: user_id
            },
            dataType: "HTML",
            success: function (data) {
                $('#shipping_address_id').html(data);
            }
        });
    }

    function shippingAddresses(address_id) {
        $.ajax({
            url: "<?= $ajax_address_info ?>" + address_id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('input[name=\'shipping_name\']').val(data.result.name);
                    $('input[name=\'shipping_contact\']').val(data.result.contact);

                    $('select[name=\'shipping_country_id\']').val(data.result.country_id);
                    $('select[name=\'shipping_zone_id\']').val(data.result.zone_id);
                    $('input[name=\'shipping_city\']').val(data.result.city);
                    $('input[name=\'shipping_postcode\']').val(data.result.postcode);
                    $('textarea[name=\'shipping_address\']').val(data.result.address);

                    shippingSelectZone(data.result.country_id, data.result.zone_id);
                    
                    $('#shipping_country_id').trigger('change');
                }
            }
        });
    }

    function shippingSelectZone(country_id, zone_id) {
        $.ajax({
            url: "<?= $ajax_zones ?>",
            type: "POST",
            data: {
                country_id: country_id,
                zone_id: zone_id
            },
            dataType: "HTML",
            success: function (data) {
                $('#shipping_zone_id').html(data);
                $('#shipping_zone_id').trigger('change');
            }
        });
    }



</script>