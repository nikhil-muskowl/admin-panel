<div class="form-group row">
    <label class="control-label col-md-2"><?= $this->lang->line('text_address') ?></label>
    <div class="col-md-10">
        <select name="payment_address_id" id="payment_address_id" class="form-control" onchange="paymentAddresses(this.value);" style="width: 100%;">
        </select>   
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('payment_name') ?></label>
    <div class="col-md-10">
        <input name="payment_name" value="<?= $payment_name ?>" placeholder="<?= humanize('payment_name') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= $this->lang->line('text_country') ?></label>
    <div class="col-md-10">
        <select name="payment_country_id" id="payment_country_id" class="form-control" onchange="payment_select_zone(this.value);" style="width: 100%;">
            <?php if ($countries): ?> 
                <?php foreach ($countries as $value) : ?>
                    <?php if ($value['id'] == $payment_country_id): ?>
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
        <select name="payment_zone_id" id="payment_zone_id" class="form-control" style="width: 100%;">
            <option value="">---Select---</option>
        </select>   
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('payment_city') ?></label>
    <div class="col-md-10">
        <input name="payment_city" value="<?= $payment_city ?>" placeholder="<?= humanize('payment_city') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div> 

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('payment_postcode') ?></label>
    <div class="col-md-10">
        <input name="payment_postcode" value="<?= $payment_postcode ?>" placeholder="<?= humanize('payment_postcode') ?>" class="form-control" type="text">
        <span class="help-block"></span>
    </div>
</div>

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('payment_address') ?></label>
    <div class="col-md-10">        
        <textarea name="payment_address" placeholder="<?= humanize('payment_address') ?>" class="form-control"><?= $payment_address ?></textarea>
        <span class="help-block"></span>
    </div>
</div>

<script>
    $('#user_id').on('change', function () {
        paymentUserAddress(this.value);
    });
    $('#user_id').trigger('change');

    $(document).ready(function () {
        $('#payment_country_id').select2();
        $('#payment_zone_id').select2();
        paymentSelectZone('<?= $payment_country_id ?>', '<?= $payment_zone_id ?>');
    });


    function paymentUserAddress(user_id) {
        $.ajax({
            url: "<?= $ajax_address ?>",
            type: "POST",
            data: {
                user_id: user_id
            },
            dataType: "HTML",
            success: function (data) {
                $('#payment_address_id').html(data);
            }
        });
    }

    function paymentAddresses(address_id) {
        $.ajax({
            url: "<?= $ajax_address_info ?>" + address_id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('input[name=\'payment_name\']').val(data.result.name);
                    $('input[name=\'payment_contact\']').val(data.result.contact);

                    $('select[name=\'payment_country_id\']').val(data.result.country_id);
                    $('select[name=\'payment_zone_id\']').val(data.result.zone_id);
                    $('input[name=\'payment_city\']').val(data.result.city);
                    $('input[name=\'payment_postcode\']').val(data.result.postcode);
                    $('textarea[name=\'payment_address\']').val(data.result.address);

                    paymentSelectZone(data.result.country_id, data.result.zone_id);
                    
                    $('#payment_country_id').trigger('change');
                }
            }
        });
    }

    function paymentSelectZone(country_id, zone_id) {
        $.ajax({
            url: "<?= $ajax_zones ?>",
            type: "POST",
            data: {
                country_id: country_id,
                zone_id: zone_id
            },
            dataType: "HTML",
            success: function (data) {
                $('#payment_zone_id').html(data);
                $('#payment_zone_id').trigger('change');
            }
        });
    }



</script>