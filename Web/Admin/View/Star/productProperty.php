<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        thead tr{background-color:#00ca79;color:#fff;}
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
                    <a href="javascript:;">明星周边商品</a>
                </li>
                <li class="active">商品属性设置</li>
            </ol>
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary" onclick="$('#modal-property-add form')[0].reset();$('#modal-property-add').modal('show')">添加商品属性</button>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="100">属性ID</th>
                    <th class="text-center">属性名</th>
                    <th class="text-center">属性类别</th>
                    <th class="text-center">属性值</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td><?=$v['name'] ?></td>
                    <td><?=$v['type'] ?></td>
                    <td><?=$v['value'] ?></td>
                    <td class="text-center td-manage">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="编辑" data-id="<?=$v['id'] ?>" onclick="item_edit(this)"></span>
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" data-id="<?=$v['id'] ?>" onclick="item_del(this)"></span>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-property-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('propertyAdd') ?>" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加商品属性</h4>
                </div>
                <div class="modal-body">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">属性名</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="inputName" class="form-control"  required="required" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="col-sm-3 control-label">录入方式</label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" value="1" checked="checked">
                                                单行文本
                                        </label>
                                        <label>
                                            <input type="radio" name="type" value="2">
                                                多行文本
                                        </label>
                                        <label>
                                            <input type="radio" name="type" value="3">
                                                列表选择
                                        </label>
                                        <label>
                                            <input type="radio" name="type" value="4">
                                                颜色选择
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textareaVal" class="col-sm-3 control-label">可选值列表</label>
                                <div class="col-sm-9">
                                    <textarea name="value" id="textareaVal" class="form-control" rows="3"></textarea>
                                    <p class="help-block">列表选择有效，每行输入一个值</p>
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="reset" value="重置" class="btn btn-default">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
<script>
    $('.td-manage span').tooltip();
    /* 删除 */
    var cur_id  = false; // 当前操作的ID
    var $cur_tr = false; // 当前操作的表格tr

    function item_del(obj)
    {
        cur_id = $(obj).attr('data-id');
        $cur_tr = $(obj).parents('tr');
        $('#item-delete').modal();
    }
    /* 确定删除 */
    function fn_confirm_delete(modal_id)
    {
        $.post("<?=U('propertyHandle') ?>",{"id":cur_id,"action":'del'},function(e){
            $('#'+modal_id).modal('hide');
            if(e[0]){
                $cur_tr.remove();
            }else{
                layer.alert(e[1],{skin:"layui-layer-lan"});
            }
        });
    }

    /* 编辑 */
    function item_edit(obj)
    {
        $cur_tr = $(obj).parents('tr');
        cur_id  = $(obj).attr('data-id');
        $.get("<?=U('propertyHandle') ?>",{"id":cur_id},function(e){
            var $modal = $('#modal-property-add');
                $modal.find('#inputName').val(e['name']) ;
                $modal.find('#id').val(e['id'])  ;
                $modal.find(':radio').eq(e['type']-1).prop('checked',true);
                $modal.find('#textareaVal').val(e['value']);

            $modal.modal('show');
        });
    }
</script>
</body>
</html>