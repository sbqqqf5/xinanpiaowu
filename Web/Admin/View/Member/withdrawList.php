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
                    <a href="javascript:;">代理用户管理</a>
                </li>
                <li class="active">提现申请</li>
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
                    <th class="text-center">#</th>
                    <th class="text-center">姓名</th>
                    <th class="text-center">联系电话</th>
                    <th class="text-center">申请金额</th>
                    <th class="text-center">申请时间</th>
                    <th class="text-center">当前状态</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $v): ?>
                <tr data-openid="<?=$v['openid'] ?>">
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td class="text-center"><?=$v['name'] ?></td>
                    <td class="text-center"><?=$v['phone'] ?></td>
                    <td class="text-center"><?=$v['money'] ?></td>
                    <td class="text-center"><?=$v['create_at'] ?></td>
                    <td class="text-center">
                        <?php if($v['status']==0): ?>
                            <span class="label label-danger">申请中</span>
                        <?php elseif($v['status'] == 1): ?>
                            <span class="label label-success">处理成功</span>
                        <?php else: ?>
                            <span class="label label-default">已拒绝</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-primary" onclick="modal_show(this,<?=$v['id'] ?>,'<?=$v['name'] ?>','<?=$v['money'] ?>')">处理</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-handle">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('withdrawList') ?>" method="POST" class="form-horizontal" role="form">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">提现操作</h4>
                </div>
                <div class="modal-body">
                        <div class="alert alert-info">
                            <strong>信息：</strong> 打款前请确保账户有足够金额 <a href="https://pay.weixin.qq.com/index.php/core/cashmanage">点击此处去充值</a>
                        </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-10">
                            <p class="form-control-static name"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="moeny" class="col-sm-2 control-label">提现金额</label>
                        <div class="col-sm-10">
                            <p class="form-control-static money"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">状态</label>
                        <div class="col-sm-3">
                            <select name="status" id="inputStatus" class="form-control" >
                                <option value="1">完成</option>
                                <option value="2">拒绝</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textareaRemark" class="col-sm-2 control-label">备注</label>
                        <div class="col-sm-10">
                            <textarea name="remark" id="textareaRemark" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
/** 模态框操作 */
function modal_show(obj,id,name,money)
{
    $modal = $('#modal-handle');
    $modal.find('.name').text(name);
    $modal.find('.money').text(money+' 元');
    $modal.find('input[name=id]').val(id)
    $modal.modal('show');
}
</script>
</body>
</html>