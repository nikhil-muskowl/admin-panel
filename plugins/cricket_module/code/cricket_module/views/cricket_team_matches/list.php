<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">    
                <div class="button-group float-right">
                    <a href="<?= $ajax_form ?>" class="btn btn-success" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>                        
                    <button class="btn btn-default" data-toggle="tooltip" title="Reload" onclick="reload_table()"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger" data-toggle="tooltip" title="Bulk Delete" onclick="bulk_delete()"><i class="fa fa-trash"></i></button>
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
                                <th><?= humanize('match_name') ?></th>
                                <th><?= humanize('team_name') ?></th>
                                <th><?= humanize('status') ?></th>
                                <th><?= humanize('created_date') ?></th>                            
                                <th><?= humanize('modified_date') ?></th>                            
                                <th style="width:80px;">Action</th>
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
        });
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function delete_record(id) {
        if (confirm('are you sure want to delete this data?')) {
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
            if (confirm('Are you sure delete this ' + list_id.length + ' data?')) {
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
            notification('Warning:', 'warning', 'no data selected');
        }
    }

    //check all
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });
</script>


