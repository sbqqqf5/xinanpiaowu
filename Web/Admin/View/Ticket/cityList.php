<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        thead tr{background-color:#00ca79;color:#fff;}
        td .label{cursor:pointer;}
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
                    <a href="javascript:;">商品管理</a>
                </li>
                <li>
                    <a href="javascript:;">票务商品</a>
                </li>
                <li class="active">票务城市</li>
            </ol>
            </div>
        </div>
        <div style="margin-bottom:20px;">
            <button class="btn btn-primary" onclick="$('#modal-add-cate form')[0].reset();$('#modal-add-cate').modal('show');">添加城市</button>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="100">#</th>
                    <th class="text-center">城市名称</th>
                    <th class="text-center" width="100">排序值</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td class="cate-name"> <input type="text" class="form-control input-sm " value="<?=$v['name'] ?>" onblur="update_name(this,<?=$v['id'] ?>)"> </td>
                    <td><input type="text" name="sorted[]" class="form-control input-sm " value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$v['id'] ?>)">
                    </td>
                    <td class="text-center">
                        <?php if($v['status']): ?>
                            <span class="label label-success" onclick="item_stop(this,<?=$v['id'] ?>)">显示</span>
                        <?php else: ?>
                            <span class="label label-default" onclick="item_start(this,<?=$v['id'] ?>)">不显示</span>
                        <?php endif; ?>
                    </td>
                    <td class="td-manage text-center">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" onclick="item_del(this,<?=$v['id'] ?>)"></span>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-add-cate">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('cityList') ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加城市</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 control-label">城市名称</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="inputName" class="form-control" required="required" >
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputSorted" class="col-sm-2 control-label">排序值:</label>
                        <div class="col-sm-10">
                            <input type="text" name="sorted" id="inputSorted" class="form-control" value="1" required="required" placeholder="值越大，显示越前">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="add">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="reset" value="重置" class="btn btn-default">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?=W('Widget/deleteModal',[['id'=>'item-delete']]) ?>
<?php require __DIR__.'/../Layout/_script.php' ?>

<script>
    /* 更新名称 */
    function update_name(obj,id)
    {
        var value = $(obj).val();
        if($(obj).parent().hasClass('has-error')){
            $(obj).parent().removeClass('has-error');
        }
        $.post("<?=U('cityList') ?>",{"action":"name","name":value,"id":id},function(e){
            if(!e){
                $(obj).parent().addClass('has-error');
            }
        });
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
        $.post("<?=U('cityList') ?>",{"action":"sorted","id":id,"sorted":value});
    }

    /* 删除 */
    var cur_id  = false; // 当前操作的ID
    var $cur_tr = false; // 当前操作的表格tr

    function item_del(obj,id)
    {
        cur_id = id;
        $cur_tr = $(obj).parents('tr');
        $('#item-delete').modal();
    }
    /* 确定删除 */
    function fn_confirm_delete(modal_id)
    {
        $.post("<?=U('cityList') ?>",{"id":cur_id,"action":'del'},function(e){
            $('#'+modal_id).modal('hide');
            if(e[0]){
                $cur_tr.remove();
            }else{
                layer.alert(e[1],{skin:"layui-layer-lan"});
            }
        });
    }
    /* 状态 启用 */
function item_start(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('cityList') ?>",{"action":"start","id":id},function(e){
        var new_ele = '<span class="label label-success" onclick="item_stop(this,'+id+')">显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

/* 状态 禁用 */
function item_stop(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('cityList') ?>",{"action":"stop","id":id},function(e){
        var new_ele = '<span class="label label-default" onclick="item_start(this,'+id+')">不显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

    $(function(){
        $('.td-manage span').tooltip();

    });
</script>
</body>
</html>