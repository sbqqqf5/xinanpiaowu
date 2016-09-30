<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        td .label{cursor:pointer;}
        thead tr{background-color:#00ca79;color:#fff;}
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
                    <a href="javascript:;">网站管理</a>
                </li>
                <li class="active">快递公司管理</li>
            </ol>
            </div>
        </div>
        
        <div style="margin-bottom:20px;">
            <button type="button" class="btn btn-primary" onclick="item_add()">添加快递公司</button>
        </div>

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">快递名称</th>
                    <th class="text-center">快递公司代码</th>
                    <th class="text-center">排序值</th>
                    <th class="text-center" width="130">状态</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['name'] ?></td>
                    <td class="text-center"><?=$v['code'] ?></td>
                    <td class="text-center"><input type="text" class="form-control input-sm" value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,'<?=$v['code'] ?>')"></td>
                    <td class="text-center">
                        <?php if($v['status']): ?>
                            <span class="label label-success" onclick="item_stop(this,'<?=$v['code'] ?>')">显示</span>
                        <?php else: ?>
                            <span class="label label-default" onclick="item_start(this,'<?=$v['code'] ?>')">不显示</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center td-manage">
                        <!-- <a href="javascript:;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-info='<?=json_encode($v) ?>' onclick="item_update(this)"></span>
                        </a> -->
                        <a href="javascript:;">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="item_delete(this,'<?=$v['code'] ?>')"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('express') ?>" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑快递公司</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">快递名</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="inputName" class="form-control" value="" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCode" class="col-sm-3 control-label">快递公司代码</label>
                        <div class="col-sm-9">
                            <input type="text" name="code" id="inputCode" class="form-control" value="" required="required">
                            <p class="help-block">每个快递具有唯一的快递公司代码，请查询文档后填写正确</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSorted" class="col-sm-3 control-label">排序值</label>
                        <div class="col-sm-9">
                            <input type="number" name="sorted" id="inputSorted" class="form-control" value=""  min="1" max="127" step="1" required="required" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="add">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?=W('Widget/deleteModal',[['id'=>'item-delete']]) ?>
<?php require __DIR__.'/../Layout/_script.php' ?>
<script type="text/javascript">
    function item_add()
    {
        $('#modal').modal('show');
    }
/* 更新排序 */
function update_sorted(obj,id)
{
    var value = $(obj).val();
    if(value > 127 || value < -128){
        layer.alert('排序值不能超过127',{skin:"layui-layer-lan"});
        $(obj).parent().addClass('has-error');
        return false;
    }
    if($(obj).parent().hasClass('has-error')){
        $(obj).parent().removeClass('has-error');
    }
    $.post("<?=U('express') ?>",{"action":"sorted","code":id,"sorted":value});
}
/* 状态 启用 */
function item_start(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('express') ?>",{"action":"status","code":id,"status":1},function(e){
        var new_ele = '<span class="label label-success" onclick="item_stop(this,\''+id+'\')">显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

/* 状态 禁用 */
function item_stop(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('express') ?>",{"action":"status","code":id,"status":0},function(e){
        var new_ele = '<span class="label label-default" onclick="item_start(this,\''+id+'\')">不显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}
/** 编辑 */
function item_update(obj,code)
{
    var info = $(obj).attr('data-info');
    info = JSON.parse(info)
    var $modal = $('#modal');
    $modal.find('#inputName').val(info.name);
    $modal.find('#inputCode').val(info.code);
    $modal.find('#inputSorted').val(info.sorted);
    $modal.find('input[name=action]').val('update');
    $modal.modal('show');
}
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
    $.post("<?=U('express') ?>",{"code":cur_id, 'action':'delete'},function(e){
        $('#'+modal_id).modal('hide');
        if(e){
            $cur_tr.remove();
        }else{
            layer.alert('删除失败，请重试',{skin:"layui-layer-lan"});
        }
    });
}
</script>
</body>
</html>