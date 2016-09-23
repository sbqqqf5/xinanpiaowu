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
            <form action="<?=U('index') ?>" method="get" class="form-inline pull-right" role="form">
            
                <div class="form-group">
                    <label class="sr-only" for="">label</label>
                    <select name="role" class="form-control">
                        <option value="0">全部</option>
                        <option value="1">仅普通</option>
                        <option value="2">仅会员</option>
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
                    <th>姓名</th>
                    <th>电话</th>
                    <th>申请日期</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $v): ?>
                <tr>
                    <td><?=$v['id'] ?></td>
                    <td><?=$v['name'] ?></td>
                    <td><?=$v['phone'] ?></td>
                    <td><?=$v['create_at'] ?></td>
                    <td>
                        <?php if($v['status']==0): ?>
                            <span class="label label-info">未处理</span>
                        <?php elseif($v['status']==1): ?>
                            <span class="label label-success">已同意</span>
                        <?php else: ?>
                            <span class="label label-default">已拒绝</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" onclick="item_agree(<?=$v['id'] ?>)" <?=$v['status']==0?'':'disabled' ?>>同意</button>
                        <button type="button" class="btn btn-warning btn-sm" onclick="item_refuse(<?=$v['id'] ?>)" <?=$v['status']==0?'':'disabled' ?>>拒绝</button>
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

/** 同意申请 */
function item_agree(id){
    layer.confirm('确定要同意该申请吗？',{skin:'layui-layer-lan',icon:3},function(){
        $.post("<?=U('agentApplyList') ?>", {id:id, action:'agree'},function(e){
            location.reload();
        })
    })
}
/** refuse apply */
function item_refuse(id)
{
    layer.confirm('确定要拒绝该申请吗?',
        {skin:'layui-layer-lan',icon:0},
        function(){
            $.post("<?=U('agentApplyList') ?>", {id:id, action:'refuse'},function(e){
                location.reload();
            })
        }
    )
}
</script>

</body>
</html>