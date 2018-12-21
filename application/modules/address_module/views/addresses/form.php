<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">   
                <div class="button-group float-right">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <a href="<?= $ajax_list ?>" class="btn btn-danger">Cancel</a>

                </div>
                <div class="card-title">
                    <h2><?= $meta_title ?></h2>
                </div>  
            </div>
            <div class="card-body">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="<?= $id ?>" name="id"/>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= $this->lang->line('text_user') ?></label>
                        <div class="col-md-10">
                            <select name="user_id" id="user_id" class="form-control">
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
                        <label class="control-label col-md-2"><?= $this->lang->line('text_country') ?></label>
                        <div class="col-md-10">
                            <select name="country_id" id="country_id" class="form-control" onchange="select_zone(this.value);">
                                <?php if ($countries): ?> 
                                    <?php foreach ($countries as $value) : ?>
                                        <?php if ($value['id'] == $country_id): ?>
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
                            <select name="zone_id" id="zone_id" class="form-control" style="width: 100%;">
                                <option value="">---Select---</option>
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
                        <label class="control-label col-md-2"><?= humanize('contact') ?></label>
                        <div class="col-md-10">
                            <input name="contact" value="<?= $contact ?>" placeholder="<?= humanize('contact') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>                      
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('city') ?></label>
                        <div class="col-md-10">
                            <input name="city" value="<?= $city ?>" placeholder="<?= humanize('city') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>                      
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('postcode') ?></label>
                        <div class="col-md-10">
                            <input name="postcode" value="<?= $postcode ?>" placeholder="<?= humanize('postcode') ?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('address') ?></label>
                        <div class="col-md-10">                    
                            <textarea name="address"  placeholder="<?= humanize('address') ?>" class="form-control"><?= $address ?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div> 
                </form>
            </div>    
        </div>
    </div>
</div>
<script>
    function select_zone(country_id) {
        var zone_id = '<?= $zone_id ?>';
        $.ajax({
            url: "<?= $ajax_zones ?>",
            type: "POST",
            data: {
                country_id: country_id,
                zone_id: zone_id
            },
            dataType: "HTML",
            success: function (data) {
                $('#zone_id').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', errorThrown);
            }
        });
    }
    $('#country_id').trigger('change');
    $('#country_id').select2();
    $('#zone_id').select2();
</script>