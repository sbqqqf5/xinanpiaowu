<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .info{width:200px;}
        .table-detail tr:nth-child(odd){background-color:#eaf4f0;}
        .table-detail tr:nth-child(even){background-color:#d2eee3;}
        .table-detail tr>td:nth-child(1){width:200px;}
        .table-data>tbody td{vertical-align: middle !important;}
        .td-status{cursor:default;}
        .checkbox input{top:0;left:30px;}
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
                    <a href="javascript:;">活动管理</a>
                </li>
                <li class="active">查看活动</li>
            </ol>
            </div>
        </div>

        <table class="table table-bordered table-detail">
            <tbody>
                <tr>
                    <td>ID</td>
                    <td><?=$detail['id'] ?></td>
                </tr>
                <tr>
                    <td>活动商品</td>
                    <td><?=$detail['goods_name'] ?></td>
                </tr>
                <tr>
                    <td>开始时间</td>
                    <td><?=$detail['begin_time'] ?></td>
                </tr>
                <tr>
                    <td>结束时间</td>
                    <td><?=$detail['end_time'] ?></td>
                </tr>
                <tr>
                    <td>单人购买上限</td>
                    <td><?=$detail['person_limit'] ?></td>
                </tr>
                <tr>
                    <td>活动总量</td>
                    <td><?=$detail['count_limit'] ?></td>
                </tr>
                <tr>
                    <td>已出售数量</td>
                    <td><?=$detail['sales_count'] ?></td>
                </tr>
                <tr>
                    <td>进度</td>
                    <td>
                        <div class="progress" style="margin-bottom: 0">
                          <div class="progress-bar" role="progressbar" aria-valuenow="<?=$detail['sales_count'] ?>" aria-valuemin="0" aria-valuemax="<?=$detail['count_limit'] ?>" style="width: <?=round($detail['sales_count']*100/$detail['count_limit']) ?>%;min-width:20px;">
                            <?=round($detail['sales_count']*100/$detail['count_limit']) ?>%
                          </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>活动创建时间</td>
                    <td><?=$detail['create_at'] ?></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-hover table-data table-condensed">
            <thead>
                <tr class="info">
                    <th class="text-center"></th>
                    <th class="text-center">#</th>
                    <th class="text-center">微信昵称</th>
                    <th class="text-center">电话</th>
                    <th class="text-center">购买订单号</th>
                    <th class="text-center">兑换码</th>
                    <th class="text-center">支付时间</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($members as $k=>$v): ?>
                <tr>
                    <td class="text-center">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="<?=$v['id'] ?>">
                            </label>
                        </div>
                    </td>
                    <td class="text-center"><?=$k+1 ?></td>
                    <td class="text-center"><?=$v['nickname'] ?></td>
                    <td class="text-center"><?=$v['phone'] ?></td>
                    <td class="text-center"><?=$v['order_num'] ?></td>
                    <td class="text-center"><?=$v['exchange_code'] ?></td>
                    <td class="text-center"><?=date('Y-m-d H:i:s', $v['pay_time']) ?></td>
                    <td class="text-center td-status">
                    <?php if($v['bingo']): ?>
                        <span class="label label-success">中奖啦</span>
                    <?php else: ?>
                        <span class="label label-default">未中奖</span>
                    <?php endif; ?>
                    </td>
                    <td class="text-center td-manage">
                        <a class="btn btn-primary btn-sm" href="javascript:;" role="button" onclick="item_start(this, <?=$v['id'] ?>)" <?=$v['bingo']?'disabled':'' ?>>设为中奖</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php if($_GET['action'] != 'end'): ?>
        <button type="button" class="btn btn-primary" onclick="random_check()">随机选中</button>
        <button type="button" class="btn btn-danger" onclick="item_start_all()">选中项设为中奖</button>
    <?php else: ?>
        <button type="button" class="btn btn-danger" onclick="refund()" <?=(($detail['count_limit']-$detail['sales_count'])<=0)||$detail['refund']?'disabled':'' ?>>退款给用户</button>
    <?php endif; ?>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<script>
<?php if($_GET['action'] == 'end'): ?>
$('.table .td-manage a').attr('disabled','disabled');
<?php endif; ?>
var random_check_count = 3; // 随机选中的个数
/** 随机选中 */
function random_check()
{
    var count = $('.table-data :checkbox').length;
    var index = 0; // 随机生成下标索引
    for(var i = 0; i < random_check_count; i ++){
        index = parseInt(Math.random()*count);
        $('.table-data :checkbox').eq(index).prop('checked', true);
    }

}
/** 部分中奖提交 */
function item_start_all()
{
    var count = $('.table-data :checkbox:checked').length;
    if(count < 1) {
        layer.msg('未选中任何人',{time:2000,shift:1});
        return false;
     }else{
        var index = layer.confirm('确定要让选中的 '+count+' 人中奖吗？', function(){
            var user_id_array = new Array();
            $('.table-data :checkbox:checked').each(function(e){
                user_id_array[e] = $(this).val();
            })
            $.post("<?=U('winning') ?>", {action:"all", id:user_id_array}, function(e){
                if(e){
                    layer.msg('设置成功', {time:2000}, function(){
                        location.reload();
                    })
                }else{
                     layer.alert('发生错误，请稍候再试',{skin:"layui-layer-lan"})
                }
                layer.close(index)
            })
        })
    }
}
/** 单个中奖 */
function item_start(obj, id)
{
    var index = layer.confirm('确定让该用户中奖吗？', function(){
        $.post("<?=U('winning') ?>", {action:"one", id:id}, function(e){
            if(e){
                $(obj).attr('disabled', 'disabled')
                $(obj).parent().siblings('.td-status').html('<span class="label label-success">中奖啦</span>');
            }else{
                layer.alert('发生错误，请稍候再试',{skin:"layui-layer-lan"})
            }
        })
        layer.close(index)
    })
}
/** 退款 */
function refund()
{
    layer.confirm('确定要退款给用户吗？', function(e){
        $.post("<?=U('refund') ?>",{id:<?=$detail['id'] ?>},function(e){
            console.info(e);return ;
            if(e){
                location.reload();
            }else{
                layer.alert('操作失败',{skin:"layui-layer-lan"})
            }
        })
    })
}

$(document).ajaxError(function(){
    layer.alert('发生错误，请刷新重试',{skin:"layui-layer-lan"});
});
</script>
</body>
</html>