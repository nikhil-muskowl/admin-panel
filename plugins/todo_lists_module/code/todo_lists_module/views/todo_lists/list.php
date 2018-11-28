<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">    
                <div class="button-group float-right">
                    <a href="<?= $ajax_form ?>" class="btn btn-success" data-toggle="tooltip" title="<?= $this->lang->line('text_add') ?>"><i class="fa fa-plus"></i></a>
                    <button class="btn btn-default" data-toggle="tooltip" title="<?= $this->lang->line('text_refresh') ?>" onclick="reload_table()"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger" data-toggle="tooltip" title="<?= $this->lang->line('text_bulk_delete') ?>" onclick="bulk_delete()"><i class="fa fa-trash"></i></button>
                    <input type="checkbox" checked name="status_filter" data-size="mini" id="toggle-filter" data-toggle="toggle" data-on="<?= $this->lang->line('text_enable') ?>" data-off="<?= $this->lang->line('text_disable') ?>">
                    <button type="button" title="<?= $this->lang->line('text_send') ?>" class="btn btn-primary" data-toggle="modal" data-target="#sendModal"><i class="fa fa-send"></i></button>
                </div>
                <div class="card-title">
                    <h2><?= $meta_title ?></h2>
                </div>        
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check-all"></th>
                                <th><?= $this->lang->line('text_user') ?></th>                                
                                <th><?= $this->lang->line('text_subject') ?></th>                                
                                <th><?= $this->lang->line('text_text') ?></th>                                                                
                                <th><?= $this->lang->line('text_status') ?></th>
                                <th><?= $this->lang->line('text_modified_date') ?></th>                            
                                <th style="width:80px;"><?= $this->lang->line('text_action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="send-form" class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('to') ?></label>
                        <div class="col-md-10">
                            <select name="user_id" id="user_id" class="form-control" style="width: 100%">
                                <?php if ($users): ?> 
                                    <?php foreach ($users as $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= humanize('cc') ?></label>
                        <div class="col-md-10">
                            <select name="cc_users[]" multiple id="cc_users" class="form-control" style="width: 100%">
                                <?php if ($users): ?> 
                                    <?php foreach ($users as $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2"><?= $this->lang->line('text_date') ?></label>
                        <div class="col-md-10">
                            <input name="date" placeholder="<?= $this->lang->line('text_date') ?>" id="datepicker" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="send_email()">Send</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#user_id').select2();
    $('#cc_users').select2();
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });

    var save_method;
    var table;
    var base_url = '<?= base_url() ?>';

    $(document).ready(function () {
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= $ajax_list ?>",
                "type": "POST",
                "data": function (data) {
                    data.status = $('[name="status_filter"]').prop('checked');
                }
            },
            "fnDrawCallback": function () {
                $("[data-toggle='toggle']").bootstrapToggle('destroy');
                $("[data-toggle='toggle']").bootstrapToggle({
                    on: '<?= $this->lang->line('text_enable') ?>',
                    off: '<?= $this->lang->line('text_disable') ?>'
                });
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false,
                },
                {
                    "targets": [-1],
                    "orderable": false,
                },
            ],
            "language": {
                "decimal": "<?= $this->lang->line('datatables_decimal') ?>",
                "emptyTable": "<?= $this->lang->line('datatables_emptyTable') ?>",
                "info": "<?= $this->lang->line('datatables_info') ?>",
                "infoEmpty": "<?= $this->lang->line('datatables_infoEmpty') ?>",
                "infoFiltered": "<?= $this->lang->line('datatables_infoFiltered') ?>",
                "infoPostFix": "<?= $this->lang->line('datatables_infoPostFix') ?>",
                "thousands": "<?= $this->lang->line('datatables_thousands') ?>",
                "lengthMenu": "<?= $this->lang->line('datatables_lengthMenu') ?>",
                "loadingRecords": "<?= $this->lang->line('datatables_loadingRecords') ?>",
                "processing": "<?= $this->lang->line('datatables_processing') ?>",
                "search": "<?= $this->lang->line('datatables_search') ?>",
                "zeroRecords": "<?= $this->lang->line('datatables_zeroRecords') ?>",
                "paginate": {
                    "first": "<?= $this->lang->line('datatables_first') ?>",
                    "last": "<?= $this->lang->line('datatables_last') ?>",
                    "next": "<?= $this->lang->line('datatables_next') ?>",
                    "previous": "<?= $this->lang->line('datatables_previous') ?>"
                },
                "aria": {
                    "sortAscending": "<?= $this->lang->line('datatables_sortAscending') ?>",
                    "sortDescending": "<?= $this->lang->line('datatables_sortDescending') ?>"
                }
            }
        });

        $('#toggle-filter').change(function () {
            table.ajax.reload(null, false);
        });
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function delete_record(id) {
        if (confirm("<?= $this->lang->line('text_confirm_delete') ?>")) {
            $.ajax({
                url: '<?= $ajax_delete ?>/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        notification('Success:', 'success', data.message);
                        reload_table();
                    } else {
                        notification('Error:', 'error', data.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notification('Error:', 'error', 'error');
                }
            });
        }
    }

    function bulk_delete() {
        var list_id = [];
        $(".data-check:checked").each(function () {
            list_id.push(this.value);
        });
        if (list_id.length > 0) {

            if (confirm("<?= $this->lang->line('text_confirm_delete') ?>")) {
                $.ajax({
                    type: "POST",
                    data: {list_id: list_id},
                    url: '<?= $ajax_delete ?>',
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status) {
                            notification('Success:', 'success', data.message);
                            reload_table();
                        } else {
                            notification('Error:', 'error', data.message);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        notification('Error:', 'error', 'error');
                    }
                });
            }
        } else {
            notification('Warning:', 'warning', '<?= $this->lang->line('textNoDataSelectedError') ?>');
        }
    }

    function change_status(id, status) {
        $.ajax({
            url: "<?= $ajax_change_status ?>",
            type: "POST",
            data: {id: id, status: status},
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    notification('Success:', 'success', data.message);
                } else {
                    notification('Error:', 'error', data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', errorThrown);
            }
        });
    }
    
    function send_email() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        var formData = new FormData($('#send-form')[0]);

        $.ajax({
            url: '<?= $ajax_send_mail ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    notification('Success:', 'success', data.message);
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
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                notification('Error:', 'error', 'error');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            }
        });
    }
</script>


