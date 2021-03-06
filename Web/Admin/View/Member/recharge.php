<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;color:red;}
        thead tr{background-color:#00ca79;color:#fff;}
        td .label{cursor:pointer;}
        table>tbody>tr>td{vertical-align: middle !important ;}
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
                <li class="active">充值记录</li>
            </ol>
            </div>
        </div>
        <table class="table table-hover table-bordered" ">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">用户</th>
                    <th class="text-center">充值单号</th>
                    <th class="text-center">充值金额</th>
                    <th class="text-center">充值时长</th>
                    <th class="text-center">开始日期</th>
                    <th class="text-center">结束日期</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td class="text-center"><?=$v['nickname'].'&nbsp;&nbsp'.$v['phone'] ?></td>
                    <td class="text-center"><?=$v['order_sn'] ?></td>
                    <td class="text-center"><?=$v['money'] ?></td>
                    <td class="text-center">
                        <?=$v['last_time']==1?'<span class="label label-success">月</span>':'<span class="label label-danger">年</span>' ?>
                    </td>
                    <td class="text-center"><?=$v['begin_date'] ?></td>
                    <td class="text-center"><?=$v['end_date'] ?></td>
                    <td class="text-center td-manage">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" title="删除记录" data-toggle="tooltip" data-placement="bottom" onclick="item_delete(this,<?=$v['id'] ?>)"></span>
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
    $.post("<?=U('recharge') ?>",{"id":cur_id,"action":'delete'},function(e){
        $('#'+modal_id).modal('hide');
        if(e){
            $cur_tr.remove();
        }else{
            layer.alert('操作失败',{skin:"layui-layer-lan"});
        }
    });
}
</script>
</body>
</html>