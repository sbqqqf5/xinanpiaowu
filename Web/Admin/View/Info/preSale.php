<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
</head>
<body>
<div id="wrapper">
<?php require __DIR__.'/../Layout/_menu.php' ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                <li>
                    <a href="javascript:;">网站管理</a>
                </li>
                <li class="active">预售票提示信息</li>
            </ol>
            </div>
        </div>
        <form action="<?=U('preSale') ?>" method="POST" role="form">
            <legend>预售票提示信息设置</legend>
        
            <div class="form-group">
                <label for="textareaContent" class="control-label">提示内容</label>
                <textarea name="content" id="textareaContent" class="form-control" rows="3" required="required"><?=$data['content'] ?></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
</body>
</html>