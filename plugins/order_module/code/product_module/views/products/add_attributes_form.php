<div class="tab-pane fade" id="attribute-tab-content<?= $attributes_row ?>">                        

    <div class="form-group row">
        <label class="control-label col-md-2"><?= humanize('attributes') ?></label>
        <div class="col-md-10">
            <select name="attributes[<?= $attributes_row ?>][attribute_id]" id="attributeId<?= $attributes_row ?>" class="form-control" style="width: 100%">
                <?php if ($attributes): ?> 
                    <?php foreach ($attributes as $value) : ?>
                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="0">No result</option>
                <?php endif; ?>
            </select>
            <span class="help-block"></span>
        </div>
    </div>   

    <script type="text/javascript">
        $('#attributeId<?= $attributes_row ?>').select2();
    </script>

    <?php if ($languages): ?>
        <ul class="nav nav-tabs" id="attributes-detail-tabs">
            <?php foreach ($languages as $key => $language) : ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($key == 0): ?> show active <?php endif; ?>" data-toggle="tab" href="#attributeDetailsTab<?= $attributes_row ?><?= $language['id'] ?>"><?= $language['name'] ?></a>
                </li>                            
            <?php endforeach; ?>
        </ul>
        <br>
        <div class="tab-content clearfix">
            <?php foreach ($languages as $key => $language) : ?>
                <div class="tab-pane container fade <?php if ($key == 0): ?> show active <?php endif; ?>" id="attributeDetailsTab<?= $attributes_row ?><?= $language['id'] ?>">
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('text') ?></label>
                        <div class="col-md-10">                                        
                            <input type="text" name="attributes[<?= $attributes_row ?>][description][<?= $language['id'] ?>][text]" value="" placeholder="<?= humanize('text') ?>" class="form-control"/>
                            <span class="help-block"></span>
                        </div>
                    </div>  
                </div>
            <?php endforeach; ?>
        </div>        
    <?php endif; ?>
</div>
