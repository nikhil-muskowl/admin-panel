<div class="form-group row">
    <label class="control-label col-md-2"><?= $this->lang->line('text_zone') ?></label>
    <div class="col-md-10">
        <select name="zone_id" id="zone_id" class="form-control">
            <?php if ($zones): ?> 
                <?php foreach ($zones as $value) : ?>
                    <?php if ($value['id'] == $zone_id): ?>
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