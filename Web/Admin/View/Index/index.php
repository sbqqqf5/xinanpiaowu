<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <!-- <link rel="stylesheet" type="text/css" href="/Public/admin/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css"> -->
    <?=W('Widget/datepickerCss') ?>
    <link rel="stylesheet" type="text/css" href="/Public/admin/wangeditor/dist/css/wangEditor.min.css">
</head>
<body>
<div id="wrapper">
<?php require __DIR__.'/../Layout/_menu.php' ?>
<div id="page-wrapper">
    <div id="page-inner">
        <h1>Hello world!</h1>

            <?=W('Widget/datepicker',[['id'=>'begin','label'=>'开始时间','format'=>'yyyy-mm-dd hh:ii']]) ?>

            <div class="editor-container">
                <textarea id="wang-editor" style="height:600px"></textarea>
                <!-- <div id="wang-editor"></div> -->
            </div>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="/Public/admin/wangeditor/dist/js/wangEditor.min.js"></script>

<!-- <script src="/Public/admin/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/Public/admin/bootstrap-datepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script> -->
<?=W('Widget/datepickerSCRIPT') ?>
<script>
    <?=W('Widget/datepickerJS',[['selector'  => '.begin']]) ?>
    <?=W('Widget/wangEditor',[['id'=>'wang-editor']]) ?>
          // 获取编辑器区域完整html代码
        var html = editor.$txt.html();
</script>
</body>
</html>