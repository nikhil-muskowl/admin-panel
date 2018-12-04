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


                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#commonTab">Common</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#detailTab">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#unitDetailTab">Unit Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#imageTab">Image</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#imagesTab">Images</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#attributesTab">Attributes</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seoTab">Seo</a>
                        </li> 
                    </ul>
                    <br>

                    <div class="tab-content clearfix">
                        <div class="tab-pane container active" id="commonTab">
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('product_categories') ?></label>
                                <div class="col-md-10">
                                    <select name="categories[]" multiple id="categories" class="form-control">
                                        <?php if ($product_categories): ?> 
                                            <?php foreach ($product_categories as $value) : ?>
                                                <?php if (in_array($value['id'], $categories)): ?>
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
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('model') ?></label>
                                <div class="col-md-10">
                                    <input name="model" value="<?= $model ?>" placeholder="<?= humanize('model') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('sku') ?></label>
                                <div class="col-md-10">
                                    <input name="sku" value="<?= $sku ?>" placeholder="<?= humanize('sku') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('price_type') ?></label>
                                <div class="col-md-10">
                                    <select name="price_type" id="price_type" class="form-control" style="width: 100%;">
                                        <?php if ($price_types): ?> 
                                            <?php foreach ($price_types as $key => $price_type_value) : ?>
                                                <?php if ($key == $price_type): ?>
                                                    <option value="<?= $key ?>" selected><?= $price_type_value ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $key ?>"><?= $price_type_value ?></option>
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
                                <label class="control-label col-md-2"><?= humanize('price') ?></label>
                                <div class="col-md-10">
                                    <input name="price" value="<?= $price ?>" placeholder="<?= humanize('price') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('quantity') ?></label>
                                <div class="col-md-10">
                                    <input name="quantity" value="<?= $quantity ?>" placeholder="<?= humanize('quantity') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 


                        </div>

                        <div class="tab-pane container fade" id="detailTab">
                            <?php include 'details_form.php'; ?>
                        </div>
                        <div class="tab-pane container fade" id="unitDetailTab">
                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('weight_class') ?></label>
                                <div class="col-md-10">
                                    <select name="weight_class_id" id="weight_class_id" class="form-control" style="width: 100%;">
                                        <?php if ($weights): ?> 
                                            <?php foreach ($weights as $value) : ?>
                                                <?php if ($value['id'] == $weight_class_id): ?>
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

                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('weight') ?></label>
                                <div class="col-md-10">
                                    <input name="weight" value="<?= $weight ?>" placeholder="<?= humanize('weight') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('length_class') ?></label>
                                <div class="col-md-10">
                                    <select name="length_class_id" id="length_class_id" class="form-control" style="width: 100%;">
                                        <?php if ($lengths): ?> 
                                            <?php foreach ($lengths as $value) : ?>
                                                <?php if ($value['id'] == $length_class_id): ?>
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

                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('length') ?></label>
                                <div class="col-md-10">
                                    <input name="length" value="<?= $length ?>" placeholder="<?= humanize('length') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('width') ?></label>
                                <div class="col-md-10">
                                    <input name="width" value="<?= $width ?>" placeholder="<?= humanize('width') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label class="control-label col-md-2"><?= humanize('height') ?></label>
                                <div class="col-md-10">
                                    <input name="height" value="<?= $height ?>" placeholder="<?= humanize('height') ?>" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>  
                        </div>
                        <div class="tab-pane container fade" id="imageTab">
                            <?php include 'image_form.php'; ?>
                        </div>
                        <div class="tab-pane container fade" id="imagesTab">
                            <?php include 'images_form.php'; ?>
                        </div>
                        <div class="tab-pane container fade" id="attributesTab">
                            <?php include 'attributes_form.php'; ?>
                        </div>
                        <div class="tab-pane container fade" id="seoTab">
                            <?php include 'url_alias_form.php'; ?>
                        </div>
                    </div>

                </form>
            </div>    
        </div>
    </div>
</div>

<script>
    $('#categories').select2();
    $('#weight_class_id').select2();
    $('#length_class_id').select2();
</script>
