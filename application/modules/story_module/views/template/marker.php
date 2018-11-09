<script src="<?= base_url() ?>node_modules/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>node_modules/html2canvas/dist/html2canvas.js" type="text/javascript"></script>

<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>

<style>
    .content{
        border-radius: 100%;
        background-color: #ff3333;
        color:#fff;
        margin: 0;
        text-align: center;
        width: 800px;
    }
    .image{
        border-radius: 100%;
        margin-left: -30px;
    }
</style>

<div id="marker" class="content">
    <div style="padding: 1%;margin-left: 4%;">
        <?php foreach ($stories as $story) : ?>
            <img class="image" src="<?= $story['user_image'] ?>" width="200" height="200">
        <?php endforeach; ?>
    </div>
</div>

<h3>Preview :</h3>
<div id="previewImage">
</div>

<script>
    $(document).ready(function () {
        var element = $("#marker");
        var getCanvas;
        html2canvas(element, {
            onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
                var imgageData = getCanvas.toDataURL("image/png");
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('story_module/api/stories_api/uploadmarker') ?>',
                    data: {
                        filename: '<?= $filename ?>',
                        image: newData
                    },
                    success: function (data) {                        
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            }
        });
    });
</script>