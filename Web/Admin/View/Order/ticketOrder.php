<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
    <style type="text/css">
        /*#form-search input{width:80px;}*/
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
                <li class="active">退货单列表</li>
            </ol>
            </div>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">订单编号</th>
                    <th class="text-center">门票名称</th>
                    <th class="text-center">所在城市</th>
                    <th class="text-center">申请日期</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>门票/一般</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                </tr>
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
        processing:false,//处理状态 默认false
        stateSave:false,//关闭本地存储，默认true
        columnDefs:[
            //{"visible":false,"targets":0}，//控制列的隐藏显示
            {"orderable":false,"targets":[-1]} // 不参与排序的列
        ],
   });

    $(document).ajaxError(function(){
        layer.alert('发生错误，请刷新重试',{skin:"layui-layer-lan"});
    });
});
</script>
</body>
</html>