<?php if ($carts): ?>
    <?php foreach ($carts as $value) : ?>
        <tr>
            <td><?= $value['product_name'] ?></td>
            <td><?= $value['model'] ?></td>
            <td>
                <div class="input-group btn-block">
                    <input type="text" name="cart_quantity_<?= $value['id'] ?>" value="<?= $value['quantity'] ?>" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" onclick="editToCart('<?= $value['id'] ?>')" class="btn btn-primary" data-toggle="tooltip" title="<?= $this->lang->line('text_refresh') ?>"><i class="fa fa-refresh"></i>
                        </button>
                    </span>
                </div>                        
            </td>
            <td><?= $value['price'] ?></td>
            <td><?= $value['total'] ?></td>
            <td>
                <button type="button" onclick="deleteToCart('<?= $value['id'] ?>')" class="btn btn-danger" data-toggle="tooltip" title="<?= $this->lang->line('text_delete') ?>"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>


