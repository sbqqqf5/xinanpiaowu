
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <link href="http://cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .td-status,.td-manage,th{text-align: center;}
        .breadcrumb{margin-bottom:0;}
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        .btn-group{margin-bottom:10px;}
    </style>
</head>
<body>
<div id="wrapper">
<?php require __DIR__.'/../Layout/_menu.php' ?>
<div id="page-wrapper">
    <div class="alert alert-danger" style="display: none;">
        <button type="button" class="close" aria-hidden="true" onclick="$('.alert-danger').fadeOut()">&times;</button>
        <strong>Title!</strong> <span class="result-info"></span>
    </div>
<div id="page-inner">
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Advance Elements</h1>
    </div>
</div>

            <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
            </div>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="success">
                        <th>标题1</th>
                        <th>标题2</th>
                        <th>标题3</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td class="td-status">
                            <span class="label label-info">状态一</span>
                        </td>
                        <td class="td-manage">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="查看"></span>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" onclick="item_delete(this,1)"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td class="td-status">
                            <span class="label label-success">状态2</span>
                        </td>
                        <td class="td-manage">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="查看"></span>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" onclick="item_delete(this,2)"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                    </tr>
                    <tr>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                    </tr>
                    <tr>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                        <td>content</td>
                    </tr>
                </tbody>
            </table>
    
</div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<div class="modal fade " id="item-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">警告</h4>
            </div>
            <div class="modal-body">
                确定要删除吗？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="fn_confirm_delete('item-delete')">删除</button>
            </div>
        </div>
    </div>
</div> <!-- /modal #item-delete -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="http://cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="http://cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
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
                // bs3-tooltip init
               $('.td-manage span').tooltip();
            });
        var cur_id = false; // 当前操作的ID
        var $cur_tr = false; // 当前操作的表格tr
        // item-delete
        function item_delete(obj,id)
        {
            $('#item-delete').modal();
            cur_id = id;
            $cur_tr = $(obj).parents('tr');
        }
        var fn_confirm_delete = function(modal_id){
            $.post("<?=U('delete') ?>",{"id":cur_id},function(e){
                if(e[0]){
                    $cur_tr.remove();
                    $('#'+modal_id).modal('hide');
                }else{
                    $('#'+modal_id).modal('hide');
                    $('.alert-danger').find('.result-info').text(e[1]);
                    $('.alert-danger').show();
                }
                
            });
        }
    </script>
</body>
</html>


