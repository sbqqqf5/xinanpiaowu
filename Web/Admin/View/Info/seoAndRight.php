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
                <li class="active">SEO及版权设置</li>
            </ol>
            </div>
        </div>
        
        <form action="<?=U('seoAndRight') ?>" method="POST" role="form">
            <legend>网站管理—SEO及版权设置</legend>
        
            <div class="form-group">
                <label for="seo_keywords">SEO关键字</label>
                <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" required value="<?=$data['seo_keywords'] ?>">
            </div>
            <div class="form-group">
                <label for="seo_description">SEO描述信息</label>
                <textarea name="seo_description" id="seo_description" class="form-control" rows="3" required="required"><?=$data['seo_description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="site_rights">版权信息</label>
                <input type="text" class="form-control" id="site_rights" name="site_rights" required value="<?=$data['rights'] ?>">
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
</body>
</html>