<table id="cart-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>            
            <th><?= $this->lang->line('text_product') ?></th>
            <th><?= $this->lang->line('text_model') ?></th>
            <th><?= $this->lang->line('text_quantity') ?></th>           
            <th><?= $this->lang->line('text_price') ?></th>
            <th><?= $this->lang->line('text_total') ?></th>
            <th><?= $this->lang->line('text_delete') ?></th>
        </tr>
    </thead>
    <tbody id="cart-body"></tbody>
</table>

<div class="form-group row">
    <label class="control-label col-md-2"><?= humanize('product') ?></label>
    <div class="col-md-10">
        <select name="product_id" id="product_id" class="form-control" style="width: 100%">
            <option value="0">--Select--</option>
            <?php if ($products): ?> 
                <?php foreach ($products as $value) : ?>
                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="0">No result</option>
            <?php endif; ?>
        </select>
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


<button type="button" id="btnaddToCart" onclick="addToCart()" class="btn btn-primary"><?= humanize('add') ?></button>

<script>
    $('#product_id').select2();

    $('#user_id').on('change', function () {
        getCartProducts();
    });

    $(document).ready(function () {
        getCartProducts();
    });

    function getCartProducts() {
        $.ajax({
            url: "<?= $ajax_cart_product ?>",
            type: "POST",
            data: {
                user_id: $('select[name=\'user_id\']').val()
            },
            dataType: "HTML",
            beforeSend: function (xhr) {
                $('#cart-body').html('<div class="text-center">loading...</div>');
            },
            success: function (data) {
                $('#cart-body').html(data);
            }
        });
    }


    function addToCart() {
        $.ajax({
            url: "<?= $ajax_add_cart ?>",
            type: "POST",
            data: {
                user_id: $('select[name=\'user_id\']').val(),
                product_id: $('select[name=\'product_id\']').val(),
                quantity: $('input[name=\'quantity\']').val()
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    notification('Success:', 'success', data.message);
                    getCartProducts();
                } else {
                    if (data.result) {
                        notification('Warning:', 'warning', data.message);
                        data.result.forEach(i => {
                            $('[name="' + i.id + '"]').closest('.form-group').addClass('has-error');
                            $('[name="' + i.id + '"]').nextAll('.help-block').text(i.text);
                        });
                    } else {
                        notification('Error:', 'error', data.message);
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', errorThrown);
            }
        });
    }

    function deleteToCart(id) {
        $.ajax({
            url: "<?= $ajax_delete_cart ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    notification('Success:', 'success', data.message);
                    getCartProducts();
                } else {
                    notification('Warning:', 'warning', data.message);
                }
            }
        });
    }

    function editToCart(id) {
        $.ajax({
            url: "<?= $ajax_edit_cart ?>",
            type: "POST",
            data: {
                id: id,
                quantity: $('input[name=\'cart_quantity_' + id + '\']').val()
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    notification('Success:', 'success', data.message);
                    getCartProducts();
                } else {
                    notification('Warning:', 'warning', data.message);
                }
            }
        });
    }
</script>