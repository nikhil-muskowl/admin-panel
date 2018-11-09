<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">    
                <div class="button-group float-right">            
                    <button class="btn btn-default" data-toggle="tooltip" title="<?= $this->lang->line('text_refresh') ?>" onclick="reload_table()"><i class="fa fa-refresh"></i></button>            
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
                               <th><?= $this->lang->line('text_title') ?></th>          
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
        //datatables
        table = $('#table').DataTable({
            "ajax": {
                "url": "<?= $ajax_list ?>",
                "type": "POST"
            },
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

    function install(code) {
        if (confirm('are you sure want to install this plugin?')) {
            $.ajax({
                url: '<?= $ajax_install ?>' + code,
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

    function uninstall(code) {
        if (confirm('are you sure want to uninstall this plugin?')) {
            $.ajax({
                url: '<?= $ajax_uninstall ?>' + code,
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

    function backup(code) {
        if (confirm('are you sure want to backup this plugin?')) {
            $.ajax({
                url: '<?= $ajax_backup ?>' + code,
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

</script>


