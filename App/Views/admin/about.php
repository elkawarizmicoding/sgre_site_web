<div class="tab-panel">
    <form class="text-edit">
        <h2 class="text-center">Edit About Page</h2>
        <div style="padding: 2em;">
            <textarea id="textEditor"><?= $variables["about"] ?></textarea>
            <div style="margin-top: 25px; width: 100%;" class="form-group text-center">
                <button type="button" class="btn btn-info" id="setEditPage">Update About Page</button>
            </div>
        </div>
    </form>
</div>
<script>
    var editor = CKEDITOR.replace('textEditor');
    CKFinder.setupCKEditor( editor, { basePath : '/layout/ckfinder/', baseURL : '/layout/upload/files/file_admin/', rememberLastFolder : false });
    /*var data_html =
    CKEDITOR.setData(data_html);*/
    $("#setEditPage").on("click", function () {
        $.post("index.php", {"ajax_action": "admin.about.edit", "about_setting": editor.getData()}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                window.location.href = "?p=admin/about";
            }else{
                alert(xData["msg"]);
            }
        });
    });
</script>