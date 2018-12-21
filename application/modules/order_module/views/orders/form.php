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
                            <a class="nav-link active" data-toggle="tab" href="#commonTab"><?= humanize('common') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#productTab"><?= humanize('product') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#paymentTab"><?= humanize('payment') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#shippingTab"><?= humanize('shipping') ?></a>
                        </li>
                    </ul>
                    <br>

                    <div class="tab-content clearfix">
                        <div class="tab-pane container active" id="commonTab">
                            <?php include 'info_form.php'; ?>
                        </div>
                        <div class="tab-pane container" id="productTab">
                            <?php include 'product_form.php'; ?>
                        </div>
                        <div class="tab-pane container" id="paymentTab">
                            <?php include 'payment_form.php'; ?>
                        </div>
                        <div class="tab-pane container" id="shippingTab">
                            <?php include 'shipping_form.php'; ?>
                        </div>
                    </div>


                </form>
            </div>    
        </div>
    </div>
</div>

