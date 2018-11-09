<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-block-down">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="https://www.muskowl.com">Muskowl</a>.</strong> All rights reserved.
</footer>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        //check all
        $("#check-all").click(function () {
            $(".data-check").prop('checked', $(this).prop('checked'));
        });

        $("input").change(function () {
            $(this).closest('.form-group').removeClass('has-error');
            $(this).closest('td').removeClass('has-error');
            $(this).nextAll('.help-block').empty();
        });

        $("textarea").change(function () {
            $(this).closest('.form-group').removeClass('has-error');
            $(this).closest('td').removeClass('has-error');
            $(this).nextAll('.help-block').empty();
        });

        $("select").change(function () {
            $(this).closest('.form-group').removeClass('has-error');
            $(this).closest('td').removeClass('has-error');
            $(this).nextAll('.help-block').empty();
        });

        // tooltips on hover
        $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
        // Makes tooltips work on ajax generated content
        $(document).ajaxStop(function () {
            $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
            $('[data-toggle=\'popover\']').popover({
                html: true,
                content: function () {
                    return $('#popover_content_wrapper').html();
                },
                container: 'body'
            });

        });

        $('[data-toggle=\'popover\']').click(function () {
            $('[data-toggle=\'popover\']').popover('hide');
        });

        $('[data-toggle=\'tooltip\']').click(function () {
            $('[data-toggle=\'tooltip\']').tooltip('destroy');
        });

        $('#modal_form').on('shown.bs.modal', function () {
            $('form:first *:input[type!=hidden]:first').focus();
        });
    });

    function bind_datetime() {
        $('.date').datetimepicker({
            format: "YYYY-MM-DD",
        });

        $('.time').datetimepicker({
            format: "hh:mm A",
        });

        $('.datetime').datetimepicker({
            format: "YYYY-MM-DD hh:mm A",
        });
    }

    function clear_form_validation() {
        $("input,textarea,select").closest('.form-group').removeClass('has-error');
        $("input,textarea,select").closest('td').removeClass('has-error');
        $("input,textarea,select").nextAll('.help-block').empty();
    }

    function close_all_popup() {
        $('[data-toggle=\'popover\']').popover('hide');
        $('[data-toggle=\'tooltip\']').tooltip('destroy');
    }
</script>

</body>
</html>
