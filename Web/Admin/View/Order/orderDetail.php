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
                    <a href="javascript:;">订单管理</a>
                </li>
                <li><a href="<?=U('index') ?>">订单列表</a></li>
                <li class="active">订单详情</li>
            </ol>
            </div>
        </div>
        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">基本信息</div>
            <!-- Table -->
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>订单ID</th>
                        <th>订单号</th>
                        <th>会员</th>
                        <th>电话</th>
                        <th>应付</th>
                        <th>订单状态</th>
                        <th>下单时间</th>
                        <th>支付时间</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$orderInfo['order_id'] ?></td>
                        <td><?=$orderInfo['order_sn'] ?></td>
                        <td><?=$userInfo['nickname'] ?></td>
                        <td><?=$userInfo['phone'] ?></td>
                        <td><?=$orderInfo['order_amount'] ?></td>
                        <td><?=$orderStatus[$orderInfo['order_status']].'/'.$payStatus[$orderInfo['pay_status']].'/'.$deliveryStatus[$orderInfo['delivery_status']] ?></td>
                        <td><?=$orderInfo['create_at'] ?></td>
                        <td><?=$orderInfo['pay_time']?date('Y-m-d H:i:s',$orderInfo['pay_time']):'' ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">收货信息</div>        
            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>收货人</th>
                        <th>联系方式</th>
                        <th>地址</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$orderInfo['consignee'] ?></td>
                        <td><?=$orderInfo['phone'] ?></td>
                        <td><?=$orderInfo['province'].'&nbsp;'.$orderInfo['city'].'&nbsp;'.$orderInfo['district'].'&nbsp;'.$orderInfo['address'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" <?=$orderInfo['delivery_status']==1?'disabled':'' ?> data-toggle="modal" href='#modal-delivery'>发货</button>
                            <button type="button" class="btn btn-success btn-sm" <?=$orderInfo['delivery_status']==1?'':'disabled' ?>>查看物流</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">商品信息</div>        
            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>商品</th>
                        <th>规格</th>
                        <th>数量</th>
                        <th>单价（普通）</th>
                        <th>单价（会员）</th>
                        <th>积分</th>
                        <th>单号小计</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($goodsInfo as $v): ?>
                    <?php 
                        $price_total     += $v['goods_num']*$v['goods_price']; // 总价  普通
                        $vip_price_total += $v['goods_num']*$v['vip_goods_price']; // 总价  会员
                        $integral_total  += $v['goods_num']*$v['integral']; // 总积分
                     ?>
                    <tr>
                        <td><?=$v['goods_name'] ?></td>
                        <td><?php 
                            if($goodsProperties){//存在规格
                                foreach($goodsProperties as $property){
                                    echo $property['name'].':'.$property['value'].'&nbsp;';
                                }
                            }
                         ?></td>
                        <td><?=$v['goods_num'] ?></td>
                        <td><?=$v['goods_price'] ?></td>
                        <td><?=$v['vip_goods_price'] ?></td>
                        <td><?=$v['integral'] ?></td>
                        <td>（普通）<?=sprintf('%.2f', $v['goods_num']*$v['goods_price']) ?> ￥ / （会员）<?=sprintf('%.2f', $v['goods_num']*$v['vip_goods_price']) ?> ￥ / <?=$v['integral']*$v['goods_num'] ?> 积分</td>
                    </tr>
                <?php endforeach; ?>

                    <tr>
                        <td colspan="6" style="text-align: right;">小计：</td>
                        <td>（普通）<?=sprintf('%.2f', $price_total) ?> ￥ /（会员）<?=sprintf('%.2f', $vip_price_total) ?> ￥ / <?=$integral_total ?> 积分</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">费用信息</div>        
            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>小计</th>
                        <th>使用订金</th>
                        <th>使用积分</th>
                        <th>积分抵扣</th>
                        <th>应付</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$orderInfo['goods_price'] ?></td>
                        <td><?=$orderInfo['use_desposit'] ?></td>
                        <td><?=$orderInfo['use_integral'] ?></td>
                        <td><?=$orderInfo['integral_money'] ?></td>
                        <td><?=$orderInfo['order_amount'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">操作</div>        
            <!-- Table -->
            <div class="">
                <button type="button" class="btn btn-success">button</button>
                <a class="btn btn-info" href="<?=U('index') ?>" role="button">返回</a>
            </div>
        </div>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-delivery">
    <div class="modal-dialog">
        <div class="modal-content">
            <form onsubmit="return false;" method="POST" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">商品发货</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="express">快递公司</label>
                        <select name="express" id="express" class="form-control" required>
                            <option value="顺丰快递" selected>顺丰快递</option>
                            <option value="申通快递">申通快递</option>
                            <option value="中通快递">中通快递</option>
                            <option value="圆通快递">圆通快递</option>
                            <option value="邮政EMS">邮政EMS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="express_code">快递单号</label>
                        <input type="text" class="form-control" name="express_code" id="express_code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="order_id" value="<?=$orderInfo['order_id'] ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" onclick="delivery_comfirm()">确认发货</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require __DIR__.'/../Layout/_script.php' ?>
<script>
/* 确认发货 */
function delivery_comfirm()
{
    if($('#express_code').val().length < 5){ return false;}
    var data = $('#modal-delivery form').serializeArray();
    $.post("<?=U('delivery') ?>",data,function(e){
        if(e[0]){
            layer.msg(e[1],{icon:1,time:2000},function(){
                location.href = "<?=U('index') ?>";
            });
        }else{
            layer.alert(e[1],{skin:"layui-layer-lan"});
        }
    });
}
</script>
</body>
</html>