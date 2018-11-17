<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">    
                <div class="button-group float-right">
                    <a href="<?= $ajax_form ?>" class="btn btn-success" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>                        
                    <button class="btn btn-default" data-toggle="tooltip" title="Reload" onclick="reload_table()"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger" data-toggle="tooltip" title="Bulk Delete" onclick="bulk_delete()"><i class="fa fa-trash"></i></button>
                    <a href="<?= $ajax_csv_export ?>" class="btn btn-success" data-toggle="tooltip" title="Export in csv"><i class="fa fa-download"></i></a>
                    <button type="button" onclick="upload('<?= $ajax_csv_import ?>')" data-loading-text="loading..." class="btn btn-warning" title="Csv Import" data-toggle="tooltip" data-placement="top"><i class="fa fa-upload"></i></button>
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
                                <th><?= $this->lang->line('text_name') ?></th>
                                <th><?= $this->lang->line('text_email') ?></th>
                                <th><?= $this->lang->line('text_contact') ?></th>
                                <th><?= $this->lang->line('text_subscribe') ?></th>
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


<script type="text/javascript">
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
                "type": "POST"
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

    function upload(url) {
        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function () {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $("#loading").show();
                    },
                    complete: function () {
                        $("#loading").hide();
                    },
                    success: function (data) {
                        if (data.status) {
                            reload_table();
                            notification('Success:', 'success', data.message);
                        } else {
                            notification('Error:', 'error', data.message);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    }
</script>


