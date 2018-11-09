<div class="row">
    <div class="col-md-3">
        <ul class="nav flex-column nav-pills" id="attribute-content">                                            
            <?php $attributes_row = 1; ?>
            <?php if ($product_attributes): ?>
                <?php foreach ($product_attributes as $key => $attribute) : ?>
                    <li>
                        <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" href="#attribute-tab-content<?= $attributes_row ?>" data-toggle="tab">
                            <i class="fa fa-minus-circle" onclick="$('#attributes-content a:first').tab('show');
                                            $('#attributes-content a[href=\'#attribute-tab-content<?= $attributes_row ?>\']').parent().remove();
                                            $('#attribute-tab-content<?= $attributes_row ?>').remove();">
                            </i> 
                            <?= humanize('attribute') ?> <?= $attributes_row ?>
                        </a>
                    </li>
                    <?php $attributes_row += 1; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <li id="attribute-content-add"><a class="nav-link" onclick="addAttributes();"><i class="fa fa-plus-circle"></i><?= humanize('add_attribute') ?></a></li>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="content-attributes-tab-content">
            <?php $attributes_row = 1; ?>
            <?php if ($product_attributes): ?>
                <?php foreach ($product_attributes as $key => $attribute) : ?>
                    <div class="tab-pane container fade <?php if ($key == 0): ?> show active <?php endif; ?>" id="attribute-tab-content<?= $attributes_row ?>">                        

                        <div class="form-group row">
                            <label class="control-label col-md-2"><?= humanize('attributes') ?></label>
                            <div class="col-md-10">
                                <select name="attributes[<?= $attributes_row ?>][attribute_id]" id="attributeId<?= $attributes_row ?>" class="form-control" style="width: 100%">
                                    <?php if ($attributes): ?> 
                                        <?php foreach ($attributes as $value) : ?>
                                            <?php if ($attribute['attribute_id'] == $value['id']): ?>
                                                <option value="<?= $value['id'] ?>" selected><?= $value['title'] ?></option>
                                            <?php else: ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                            <?php endif; ?>
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
                            <ul class="nav nav-tabs">
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
                                                <input type="text" name="attributes[<?= $attributes_row ?>][description][<?= $language['id'] ?>][text]" value="<?= $attribute['description'][$language['id']]['text'] ?>" placeholder="<?= humanize('text') ?>" class="form-control"/>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>   
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <?php $attributes_row += 1; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    var attributes_row = <?= $attributes_row ?>;
    var html = '';
    function addAttributes() {
        $.ajax({
            url: "<?= $ajax_attribute_form ?>" + attributes_row,
            type: "GET",
            dataType: "HTML",
            async: false,
            success: function (data) {
                html = data;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', errorThrown);
            }
        });

        $('#content-attributes-tab-content').append(html);

        $('#attribute-content-add').before('<li><a class="nav-link" href="#attribute-tab-content' + attributes_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#attributes-content a:first\').tab(\'show\'); $(\'a[href=\\\'#attribute-tab-content' + attributes_row + '\\\']\').parent().remove(); $(\'#attribute-tab-content' + attributes_row + '\').remove();"></i> <?= humanize('attribute') ?> ' + attributes_row + '</a></li>');

        $('#attribute-content a[href=\'#attribute-tab-content' + attributes_row + '\']').tab('show');

        $('#attribute-tab-content' + attributes_row + ' .form-group[data-sort]').detach().each(function () {
            if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#attribute-tab-content' + attributes_row + ' .form-group').length) {
                $('#attribute-tab-content' + attributes_row + ' .form-group').eq($(this).attr('data-sort')).before(this);
            }

            if ($(this).attr('data-sort') > $('#attribute-tab-content' + attributes_row + ' .form-group').length) {
                $('#attribute-tab-content' + attributes_row + ' .form-group:last').after(this);
            }

            if ($(this).attr('data-sort') < -$('#attribute-tab-content' + attributes_row + ' .form-group').length) {
                $('#attribute-tab-content' + attributes_row + ' .form-group:first').before(this);
            }
        });
        attributes_row++;
    }
</script>