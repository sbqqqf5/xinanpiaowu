<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
    <?=W('Widget/datepickerCSS') ?>
    <style>
        #form-search input{width:80px;}
        .td-status span{-moz-user-select: none;-webkit-user-select: none;user-select:none;}
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        .td-manage a{text-decoration: none;}
        .table thead tr{background-color:#00ca79;color:#fff;}
        td .label{cursor:pointer;}
        .mg-b-20{margin-bottom:20px;}
        table>tbody>tr>td{vertical-align: middle !important ;}
        form #begin,form #end{width:110px;font-size:12px;padding:5px;}
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
                    <a href="javascript:;">订单管理</a>
                </li>
                <li class="active">订单列表</li>
            </ol>
            </div>
        </div>
        
        <div style="margin-bottom:20px;float:right;">
            <form action="<?=U('index') ?>" method="get" class="form-inline" role="form" id="form-search">
                <div class="form-group">
                    <label for="" class="control-label">下单时间</label>
                    <input type="text" class="form-control" name="begin" id="begin" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="end" id="end" data-date-format="yyyy-mm-dd">
                </div>
                <div class="form-group">
                    <label for="" class="sr-only">门票\商品</label>
                    <select name="order_type"  class="form-control">
                        <option value="-1">门票\商品</option>
                        <?php foreach($orderType as $k=>$v): ?>
                        <option value="<?=$k ?>"><?=$v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="sr-only">支付状态</label>
                    <select name="pay_status"  class="form-control">
                        <option value="-1">支付状态</option>
                        <?php foreach($payStatus as $key=>$v): ?>
                        <option value="<?=$key ?>"><?=$v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="sr-only">发货状态</label>
                    <select name="delivery_status"  class="form-control">
                        <option value="-1">发货状态</option>
                        <?php foreach($deliveryStatus as $key=>$v): ?>
                        <option value="<?=$key ?>"><?=$v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="sr-only">订单状态</label>
                    <select name="order_status"  class="form-control">
                        <option value="-1">订单状态</option>
                        <?php foreach($orderStatus as $key=>$v): ?>
                        <option value="<?=$key ?>"><?=$v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="action" value="search">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;筛选</button>
            </form>
        </div>

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">订单编号</th>
                    <th class="text-center">商品类型</th>
                    <th class="text-center">收货人</th>
                    <th class="text-center">应付金额</th>
                    <th class="text-center">支付状态</th>
                    <th class="text-center">订单状态</th>
                    <th class="text-center">发货状态</th>
                    <th class="text-center">下单时间</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $k=>$v): ?>
                <tr>
                    <td><?=$v['order_sn'] ?></td>
                    <td class="text-center"><?=$orderType[$v['order_type']] ?></td>
                    <td><?=$v['consignee'].':'.$v['phone'] ?></td>
                    <td class="text-center"><?=$v['goods_price'] ?></td>
                    <td class="text-center">
                    <?=
                    $v['pay_status']==0?
                    '<span class="label label-default">未支付</span>'
                    :'<span class="label label-success">已支付</span>'
                     ?>
                    </td>
                    <td class="text-center"><?=$orderStatus[$v['order_status']] ?></td>
                    <td class="text-center"><?=$deliveryStatus[$v['delivery_status']] ?></td>
                    <td><?=substr($v['create_at'], 0, -3) ?></td>
                    <td class="text-center td-manage">
                    <a href="<?=U('orderDetail',['order_id'=>$v['order_id']]) ?>">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                    <a href="javascript:;">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="item_delete(this, <?=$v['order_id'] ?>)"></span>
                    </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?=W('Widget/deleteModal',[['id'=>'item-delete']]) ?>

<?php require __DIR__.'/../Layout/_script.php' ?>
<?=W('Widget/dataTablesScript') ?>
<?=W('Widget/datepickerSCRIPT') ?>
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
            {"orderable":false,"targets":[-1]} // 不参与排序的列
        ],
   });

    $('.td-manage span').tooltip();

    $(document).ajaxError(function(){
        layer.alert('发生错误，请刷新重试',{skin:"layui-layer-lan"});
    });

    $('#begin').datetimepicker({
        language : 'zh-CN',
        weekStart : 1,
        startDate : '2016-1-1',
        endDate : '<?=date('Y-m-d',strtotime('+1 day')) ?>',
        todayBtn : 'link',
        minView : 2,
        todayHighlight : true,
        autoclose : true
    });
    $('#end').datetimepicker({
        language : 'zh-CN',
        weekStart : 1,
        startDate : '2016-1-1',
        endDate : '<?=date('Y-m-d',strtotime('+1 day')) ?>',
        todayBtn : 'link',
        minView : 2,
        todayHighlight : true,
        autoclose : true
    });


});

var cur_id = 0;
var $cur_tr = '';
function item_delete(obj,id)
{
    cur_id = id;
    $cur_tr = $(obj).parents('tr');
    $('#item-delete').modal();
}
/* 确定删除 */
function fn_confirm_delete(modal_id)
{
    $.post("<?=U('orderHandle') ?>",{"order_id":cur_id, 'action':'delete'},function(e){
        $('#'+modal_id).modal('hide');
        if(e[0]){
            $cur_tr.remove();
        }else{
            layer.alert(e[1],{skin:"layui-layer-lan"});
        }
    });
}
</script>
</body>
</html>