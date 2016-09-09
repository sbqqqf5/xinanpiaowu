<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        thead tr{background-color:#00ca79;color:#fff;}
        .cate-name span{color:blue;font-size:20px;margin-right:10px;}
        .child{display:none;}
    </style>
</head>
<body>
<div id="wrapper">
<?php require __DIR__.'/../Layout/_menu.php' ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">明星周边—商品分类</h1>
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary" onclick="$('#modal-add-cate form')[0].reset();$('#modal-add-cate').modal('show');">添加分类</button>
            <button type="button" class="btn btn-info" id="table-toggle" data-status="1">展开/折叠</button>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="100">分类ID</th>
                    <th class="text-center">分类名称</th>
                    <th class="text-center" width="100">排序值</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td class="cate-name">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true" onclick="expand(this,<?=$v['id'] ?>)"></span>
                        <span class="glyphicon glyphicon-minus" aria-hidden="true" style="display:none;" onclick="collapse(this,<?=$v['id'] ?>)"></span><?=$v['name'] ?>
                    </td>
                    <td><input type="text" name="sorted[]" class="form-control input-sm " value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$v['id'] ?>)"></td>
                    <td class="td-manage text-center">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="编辑" onclick="item_edit(this,<?=$v['id'] ?>)"></span>
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" onclick="item_del(this,<?=$v['id'] ?>)"></span>
                    </td>
                </tr>
                <?php foreach ($v['children'] as $child): ?>
                    <tr class="child" data-parent="<?=$v['id'] ?>">
                        <td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$child['id'] ?></td>
                        <td class="cate-name"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$child['name'] ?> </td>
                        <td><input type="text" name="sorted[]" class="form-control input-sm" value="<?=$child['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$child['id'] ?>)"></td>
                        <td class="td-manage text-center">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="编辑" onclick="item_edit(this,<?=$child['id'] ?>)"></span>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" onclick="item_del(this,<?=$child['id'] ?>)"></span>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endforeach ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-add-cate">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('addCate') ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加分类</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputPid" class="col-sm-2 control-label">分类等级</label>
                        <div class="col-sm-10">
                            <select name="pid" id="inputPid" class="form-control">
                                <option value="0">一级分类</option>
                                <?php foreach($secondCateName as $id=>$name): ?>
                                    <option value="<?=$id ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 control-label">分类名</label>
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
                    <div class="form-group row">
                        <label for="inputProperty" class="col-sm-2 control-label">包含属性</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                            <?php foreach($properties as $property): ?>
                                <label>
                                    <input type="checkbox" name="property[]" value="<?=$property['id'] ?>">
                                    <?=$property['name'] ?>
                                </label>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="reset" value="重置" class="btn btn-default">
                    <button type="submit" class="btn btn-primary" onclick="save_cate()">保存</button>
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
    /* 展开 */
    function expand(obj,id)
    {
        $(obj).css('display','none');
        $(obj).siblings('.glyphicon').css('display','inline-block');
        $("[data-parent="+id+"]").fadeIn();
    }
    /* 折叠 */
    function collapse(obj,id)
    {
        $(obj).css('display','none');
        $(obj).siblings('.glyphicon').css('display','inline-block');
        $("[data-parent="+id+"]").fadeOut();
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
        $.post("<?=U('cateHandle') ?>",{"action":"sorted","id":id,"value":value});
    }
    /* 编辑 */
    function item_edit(obj,id)
    {
        var $modal = $('#modal-add-cate');
        $.get("<?=U('cateHandle') ?>",{"id":id},function(e){
            $modal.find('#inputPid option[value='+e['pid']+']').prop('selected',true);
            $modal.find('#inputName').val(e['name']);
            $modal.find('#inputSorted').val(e['sorted']);
            $modal.find(':hidden[name=id]').val(e['id']);
            $modal.find(':checkbox').prop('checked',false);
            if(e['property']){
                for(var i in e['property']){
                    $modal.find(':checkbox[value='+e['property'][i]+']').prop('checked',true);
                }
            }
            $modal.modal('show');
        });
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
        $.post("<?=U('cateHandle') ?>",{"id":cur_id,"action":'del'},function(e){
            $('#'+modal_id).modal('hide');
            if(e[0]){
                $cur_tr.remove();
            }else{
                layer.alert(e[1],{skin:"layui-layer-lan"});
            }
        });
    }

    $(function(){
        $('.td-manage span').tooltip();
        /* 展开/折叠 */
        $('#table-toggle').click(function(){
            var status = $(this).attr('data-status');
            if(status==1){
                //展开
                $('.child').fadeIn();
                $('table .glyphicon-plus').css('display','none');
                $('table .glyphicon-minus').css('display','inline-block');
                $(this).attr('data-status',2);
            }else{
                //折叠
                $('.child').fadeOut();
                $('table .glyphicon-plus').css('display','inline-block');
                $('table .glyphicon-minus').css('display','none');
                $(this).attr('data-status',1);
            }
        });
    });
</script>
</body>
</html>