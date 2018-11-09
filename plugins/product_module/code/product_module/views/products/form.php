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
                            <?php include 'details_form.php'; ?>
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
</script>
