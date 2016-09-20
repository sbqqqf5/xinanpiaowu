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
                    <a href="javascript:;">商品管理</a>
                </li>
                <li>
                    <a href="javascript:;">明星周边商品</a>
                </li>
                <li><a href="<?=U('index') ?>">商品列表</a></li>
                <li class="active">编辑商品价格</li>
            </ol>
            </div>
        </div>
        
        <form action="<?=U('addProductStep3') ?>" method="POST" class="form-horizontal" role="form">
        
                <div class="form-group" style="padding-left:110px;padding-right:110px;">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <?php foreach ($fieldsInfo as $field): ?>
                                    <th><?=$field['name'] ?></th>
                                <?php endforeach ?>
                                <th width="180">价格</th>
                                <th width="180">会员价</th>
                                <th width="180">库存</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(count($fieldsInfo)==2): // 两种规格 ?>
                        <?php foreach($fieldsInfo[0]['value'] as $k1=>$value): ?>
                        <?php foreach($fieldsInfo[1]['value'] as $k2=>$v): ?>
                            <tr>
                                <td><?=$value ?></td>
                                <td><?=$v ?></td>
                                <td><input type="text" name="price[<?=$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2 ?>]" class="form-control input-sm" value="<?=$priceInfo[$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2]['price'] ?>" required></td>
                                <td><input type="text" name="vip_price[<?=$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2 ?>]" class="form-control input-sm" value="<?=$priceInfo[$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2]['vip_price'] ?>" required></td>
                                <td><input type="text" name="inventory[<?=$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2 ?>]" class="form-control input-sm" value="<?=$priceInfo[$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2]['inventory'] ?>" required></td>
                                <input type="hidden" name="key_value[]" value="<?=$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2 ?>">
                                <input type="hidden" name="key_name[<?=$fieldsInfo[0]['id'].'_'.$k1.'+'.$fieldsInfo[1]['id'].'_'.$k2 ?>]" value="<?=$value.'_'.$v ?>">
                            </tr>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if(count($fieldsInfo)==1): // 仅一种规格 ?>
                        <?php foreach($fieldsInfo[0]['value'] as $k1=>$value): ?>
                            <tr>
                                <td><?=$value ?></td>
                                <td><input type="text" name="price[<?=$fieldsInfo[0]['id'].'_'.$k1 ?>]" class="form-control input-sm" value="<?=$priceInfo[$fieldsInfo[0]['id'].'_'.$k1]['price'] ?>" required></td>
                                <td><input type="text" name="vip_price[<?=$fieldsInfo[0]['id'].'_'.$k1 ?>]" class="form-control input-sm" value="<?=$priceInfo[$fieldsInfo[0]['id'].'_'.$k1]['vip_price'] ?>" required></td>
                                <td><input type="text" name="inventory[<?=$fieldsInfo[0]['id'].'_'.$k1 ?>]" class="form-control input-sm" value="<?=$priceInfo[$fieldsInfo[0]['id'].'_'.$k1]['inventory'] ?>" required></td>
                            </tr>
                            <input type="hidden" name="key_value[]" value="<?=$fieldsInfo[0]['id'].'_'.$k1 ?>">
                            <input type="hidden" name="key_name[<?=$fieldsInfo[0]['id'].'_'.$k1 ?>]" value="<?=$value?>" >
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-1">
                        <input type="hidden" name="goods_id" value="<?=$goods_id ?>">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
        </form>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="/Public/admin/assets/js/starproductadd.js"></script>

<script type="text/javascript">

</script>
</body>
</html>