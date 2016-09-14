<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        thead tr{background-color:#00ca79;color:#fff;}
    </style>
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
                <li class="active">会员充值积分</li>
            </ol>
            </div>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">时长</th>
                    <th class="text-center">充值金额</th>
                    <th class="text-center">赠送积分</th>
                    <th class="text-center">更新</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $key => $v): ?>
                <form action="<?=U('vipPrice') ?>" method="post">
                <tr>
                    <td class="text-center"><?=$v['cate']==1?'月':($v['cate']==2?'年':'') ?></td>
                    <td width="300">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" value="<?=$v['price'] ?>" required="required" name="price">
                        <div class="input-group-addon">&yen;</div>
                    </div>
                    </td>
                    <td width="300">
                        <div class="input-group">
                        <input type="text" class="form-control input-sm" value="<?=$v['points'] ?>" required="required" name="points">
                        <div class="input-group-addon">积分</div>
                    </div>
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="id" value="<?=$v['id'] ?>">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </td>
                </tr>
                </form>
            <?php endforeach ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
</body>
</html>