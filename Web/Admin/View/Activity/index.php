<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
    <style type="text/css">
        .td-status span{-moz-user-select: none;-webkit-user-select: none;user-select:none;}
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        .td-manage a{text-decoration: none;}
        .table thead tr{background-color:#00ca79;color:#fff;}
        td .label{cursor:pointer;}
        .mg-b-20{margin-bottom:20px;}
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
                    <a href="javascript:;">活动管理</a>
                </li>
                <li class="active">进行中的活动</li>
            </ol>
            </div>
        </div>
        
        <a class="btn btn-primary" href="<?=U('add') ?>" role="button" style="margin-bottom:20px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加活动</a>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center" style="max-width:200px">活动商品</th>
                    <th class="text-center">开始时间</th>
                    <th class="text-center">结束时间</th>
                    <th class="text-center">进度</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $k=>$v): ?>
                <tr>
                    <td class="text-center"><?=$k+1 ?></td>
                    <td class="text-center"><?=$v['goods_name'] ?></td>
                    <td class="text-center"><?=$v['begin_time'] ?></td>
                    <td class="text-center"><?=$v['end_time'] ?></td>
                    <td class="text-center">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="<?=$v['sales_count'] ?>" aria-valuemin="0" aria-valuemax="<?=$v['count_limit'] ?>" style="width: <?=round($v['sales_count']*100/$v['count_limit']) ?>%;min-width:20px;">
                            <?=round($v['sales_count']*100/$v['count_limit']) ?>%
                          </div>
                        </div>
                            <span>总量：<?=$v['count_limit'] ?>&nbsp;&nbsp;剩余：<?=$v['count_limit']-$v['sales_count'] ?></span>
                    </td>
                    <td class="text-center">
                        <?php if($v['sales_count']<$v['count_limit']): ?>
                            <span class="label label-success">进行中</span>
                        <?php else: ?>
                            <span class="label label-danger">已售罄</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center td-manage">
                        <a href="<?=U('view',['id'=>$v['id']]) ?>">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="查看" data-toggle="toggle" data-placement="bottom"></span>
                        </a>
                        <a href="javascript:;" onclick="item_delete(this, <?=$v['id'] ?>)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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
    })

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
    $.post("<?=U('index') ?>",{"id":cur_id,"action":'delete'},function(e){
        $('#'+modal_id).modal('hide');
        if(e){
            $cur_tr.remove();
        }else{
            layer.alert('删除失败',{skin:"layui-layer-lan"});
        }
    });
}
</script>
</body>
</html>