<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .info{width:200px;}
        .table tr:nth-child(odd){background-color:#eaf4f0;}
        .table tr:nth-child(even){background-color:#d2eee3;}
        .table tr>td:nth-child(1){width:200px;}
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
                    <a href="javascript:;">票务商品</a>
                </li>
                <li>
                    <a href="<?=U('index') ?>">商品列表</a>
                </li>
                <li class="active">商品详情</li>
            </ol>
            </div>
        </div>

        <div style="margin-bottom:10px"><a class="btn btn-primary" href="<?=U('ticketEdit',['id'=>$detail['id']]) ?>" role="button">更新</a></div>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>ID</td>
                    <td><?=$detail['id'] ?></td>
                </tr>
                <tr>
                    <td>商品名</td>
                    <td><?=$detail['title'] ?></td>
                </tr>
                <tr>
                    <td>排序值</td>
                    <td><?=$detail['sorted'] ?></td>
                </tr>
                <tr>
                    <td>演出时间</td>
                    <td>
                        <?php foreach($detail['performance_time'] as $time): 
                            echo $time.'&nbsp;&nbsp;&nbsp;&nbsp;';
                        endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td>分类</td>
                    <td><?=$detail['cate_name'] ?></td>
                </tr>
                <tr>
                    <td>栏目</td>
                    <td><?=$detail['column_name'] ?></td>
                </tr>
                <tr>
                    <td>城市</td>
                    <td><?=$detail['city_name'] ?></td>
                </tr>
                <tr>
                    <td>显示在首页</td>
                    <td><?=$detail['is_home']?'是':'否' ?></td>
                </tr>
                <tr>
                    <td>是否预售中</td>
                    <td><?=$detail['is_order']?'是':'否' ?></td>
                </tr>
                <tr>
                    <td>预售金额</td>
                    <td><?=$detail['deposit']?$detail['deposit']:'0' ?></td>
                </tr>
                <tr>
                    <td>分享提成</td>
                    <td><?=$detail['distribute_price'] ?></td>
                </tr>
                <tr>
                    <td>场馆</td>
                    <td><?=$detail['venues'] ?></td>
                </tr>
                <tr>
                    <td>观看位置</td>
                    <td><?php foreach($detail['view_location'] as $location){
                        echo $location.'&nbsp;&nbsp;&nbsp;&nbsp;';
                     }?></td>
                </tr>
                <tr>
                    <td>价格</td>
                    <td><?php foreach($detail['price'] as $price){
                        echo $price.'&nbsp;&nbsp;&nbsp;&nbsp;';
                     }?></td>
                </tr>
                <tr>
                    <td>会员价格</td>
                    <td><?php foreach($detail['vip_price'] as $vip_price){
                        echo $vip_price.'&nbsp;&nbsp;&nbsp;&nbsp;';
                     }?></td>
                </tr>
                <tr>
                    <td>库存</td>
                    <td><?=$detail['inventory'] ?></td>
                </tr>
                <tr>
                    <td>演出持续时间</td>
                    <td><?=$detail['performance_duration'] ?></td>
                </tr>
                <tr>
                    <td>入场时间</td>
                    <td><?=$detail['entry_time'] ?></td>
                </tr>
                <tr>
                    <td>限购说明</td>
                    <td><?=$detail['limit_explain'] ?></td>
                </tr>
                <tr>
                    <td>儿童入场说明</td>
                    <td><?=$detail['child_explain'] ?></td>
                </tr>
                <tr>
                    <td>购票须知</td>
                    <td><?=$detail['should_known'] ?></td>
                </tr>
                <tr>
                    <td>首页缩略图</td>
                    <td><img src="<?=$detail['home_thumb'] ?>" alt="图片不存在"></td>
                </tr>
                <tr>
                    <td>列表缩略图</td>
                    <td><img src="<?=$detail['thumb'] ?>" alt=""></td>
                </tr>
                <tr>
                    <td>是否销售中</td>
                    <td><?=$detail['status']?'销售中':'已下架' ?></td>
                </tr>
                <tr>
                    <td>添加时间</td>
                    <td><?=$detail['create_at'] ?></td>
                </tr>
                <tr>
                    <td>更新时间</td>
                    <td><?=$detail['update_at']?date('Y-m-d H:i:s',$detail['update_at']):'未更新' ?></td>
                </tr>
                <tr>
                    <td>详情</td>
                    <td><?=$detail['detail'] ?></td>
                </tr>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
</body>
</html>