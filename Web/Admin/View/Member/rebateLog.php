<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        thead tr{background-color:#00ca79;color:#fff; }
        thead tr th{text-align:center;}
        td .label{cursor:pointer;}
        table>tbody>tr>td{vertical-align: middle !important ;text-align:center;}
        .mg-b-20{margin-bottom:20px;}
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
                    <a href="javascript:;">用户管理</a>
                </li>
                <li class="active">用户列表</li>
            </ol>
            </div>
        </div>

        <div class="mg-b-20 clearfix">
            <form action="<?=U('rebateLog') ?>" method="get" class="form-inline pull-right" role="form">
                <div class="form-group">
                    <label for="inputOrder_sn" class="sr-only control-label">Order_sn:</label>
                    <input type="text" name="order_sn" class="form-control" placeholder="输入订单号">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="">label</label>
                    <select name="status" class="form-control">
                        <option>当前状态</option>
                        <?php foreach($status as $k=>$v): ?>
                        <option value="<?=$k ?>"><?=$v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="action" value="search">
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>

        <table class="table table-hover table-bordered" ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>订单号</th>
                    <th>订单金额</th>
                    <th>收益金额</th>
                    <th>收益人</th>
                    <th>购买人</th>
                    <th>当前状态</th>
                    <th>记录时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $k=>$v): ?>
                <tr>
                    <td class="text-center"><?=$k+1 ?></td>
                    <td class="text-center"><a href="<?=U('Order/orderDetail',['order_id'=>$v['order_id']]) ?>"><?=$v['order_sn'] ?></a></td>
                    <td class="text-center"><?=$v['goods_price'] ?></td>
                    <td class="text-center"><?=$v['money'] ?></td>
                    <td class="text-center"><?=$v['distribute_user']['name'] ?></td>
                    <td class="text-center"><?=$v['buy_user']['nickname'] ?></td>
                    <td class="text-center td-status">
                    <?php if($v['status'] < 2): ?>
                        <span class="label label-default"><?=$status[$v['status']] ?></span>
                    <?php elseif($v['status'] = 2): ?>
                        <span class="label label-warning"><?=$status[$v['status']] ?></span>
                    <?php elseif($v['status'] = 3): ?>
                        <span class="label label-success"><?=$status[$v['status']] ?></span>
                    <?php else: ?>
                        <span class="label label-info"><?=$status[$v['status']] ?></span>
                    <?php endif; ?>
                    </td>
                    <td class="text-center"><?=$v['create_at'] ?></td>
                    <td class="text-center td-manage">
                        <button type="button" class="btn btn-primary btn-sm" onclick="item_confirm(this,<?=$v['id'] ?>,<?=$v['status'] ?>)">确认
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="item_delete(this,<?=$v['id'] ?>,<?=$v['status'] ?>)">删除
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<?=W('Widget/dataTablesScript') ?>
<script>
    $(function(){
        $('.table').dataTable({
            language: {
                "sProcessing": "处理中...",
                "sLengthMenu": "显示 _MENU_ 项结果",
                "sZeroRecords": "没有匹配结果",
                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix": "",
                "sSearch": "搜索:",
                "sUrl": "",
                "sEmptyTable": "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "上页",
                    "sNext": "下页",
                    "sLast": "末页"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            },
            processing:true,//处理状态 默认false
            stateSave:false,//关闭本地存储，默认true
            columnDefs:[
                //{"visible":false,"targets":0}，//控制列的隐藏显示
                {"orderable":false,"targets":[-1,-2]} // 不参与排序的列
            ],
       });

        $('.td-manage span').tooltip();
        $(document).ajaxError(function(){
            layer.alert('发生错误，请刷新重试',{skin:"layui-layer-lan"});
    });
});
/** 确认记录有效 */
function item_confirm(obj,id,status)
{
    if(status != 2){
        layer.alert('用户收货后方可确认记录有效！');return false;
    }else{
        layer.confirm('确定要使该条记录生效吗？',function(){
            $.post("<?=U('rebateLogHandle') ?>",{action:'confirm',id:id},function(){
                if(e !== false){
                    if(e){
                        layer.msg('操作成功',{icon:6,time:2000},function(){
                            $(obj).parent().siblings('.td-status').html('<span class="label label-success">已完成</span>');
                        })
                    }else{
                        layer.alert('操作失败',{icon:5});
                    }
                }else{
                    layer.alert('用户收货后方可确认记录有效！',{icon:5});
                }
            })
        })
    }
}
/** 删除记录 */
function item_delete(obj,id,status)
{
    if(status != 4){
        layer.alert('订单进行中，不可删除！');return false;
    }else{
        layer.confirm('确定要删除吗？', function(){
            $.post("<?=U('rebateLogHandle') ?>",{id:id,action:"delete"},function(e){
                if(e !== false){
                    layer.msg('删除成功',{icon:6,time:2000}, function(){
                        $(obj).parents('tr').fadeOut();
                    });
                }else{
                    layer.alert('只有已取消的订单才可被删除！');
                }
            })
        });
    }
}

</script>
</body>
</html>