<div class="form-group row">
    <label class="control-label col-md-2"><?= $this->lang->line('text_zone') ?></label>
    <div class="col-md-10">
        <select name="address_id" id="address_id" class="form-control">
            <option value="0">---Select Address---</option>
            <?php if ($addresses): ?> 
                <?php foreach ($addresses as $value) : ?>
                    <?php if ($value['id'] == $address_id): ?>
                        <option value="<?= $value['id'] ?>" selected><?= $value['address'] ?></option>
                    <?php else: ?>
                        <option value="<?= $value['id'] ?>"><?= $value['address'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="0">No result</option>
            <?php endif; ?>
        </select>
        <span class="help-block"></span>
    </div>
</div> 