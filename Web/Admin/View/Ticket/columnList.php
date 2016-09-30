<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <link rel="stylesheet" href="/Public/admin/bootstrap_fileinput/css/fileinput.min.css">
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
                <li class="active">票务栏目</li>
            </ol>
            </div>
        </div>
        <div style="margin-bottom:20px;">
            <button class="btn btn-primary" onclick="$('#modal-add-cate form')[0].reset();$('#modal-add-cate').modal('show');">添加栏目</button>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="100">#</th>
                    <th class="text-center" width="150">栏目名称</th>
                    <th class="text-center">栏目介绍</th>
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
                    <td class="text-center">
                        <input type="text" class="form-control input-sm " value="<?=$v['intro'] ?>" onblur="update_intro(this,<?=$v['id'] ?>)">
                    </td>
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
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="编辑" onclick="item_edit(this,<?=$v['id'] ?>)"></span>
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
            <form action="<?=U('columnList') ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加栏目</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 control-label">栏目名称</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="inputName" class="form-control" required="required" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="intro" class="col-sm-2 control-label">栏目介绍</label>
                        <div class="col-sm-10">
                            <input type="text" name="intro" id="intro" class="form-control" required="required" placeholder="一句话介绍">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputSorted" class="col-sm-2 control-label">排序值</label>
                        <div class="col-sm-10">
                            <input type="text" name="sorted" id="inputSorted" class="form-control" value="1" required="required" placeholder="值越大，显示越前">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input" class="col-sm-2 control-label">包含子类</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                             <?php foreach($cates as $cate): ?>
                                    <label>
                                        <input type="checkbox" name="cates[]" value="<?=$cate['id'] ?>">
                                        <?=$cate['name'] ?>
                                    </label>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="pics" class="col-sm-2 control-label">轮播图</label>
                        <div class="col-sm-10">
                            <input type="file" name="pics[]" id="pics" class="file" multiple>
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

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('columnList') ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑栏目</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 control-label">栏目名称</label>
                        <div class="col-sm-10">
                            <p class="form-control-static" id="edit-name"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit-intro" class="col-sm-2 control-label">栏目介绍</label>
                        <div class="col-sm-10">
                            <input type="text" name="intro" id="edit-intro" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input" class="col-sm-2 control-label">包含子类</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                             <?php foreach($cates as $cate): ?>
                                    <label>
                                        <input type="checkbox" name="cates[]" value="<?=$cate['id'] ?>">
                                        <?=$cate['name'] ?>
                                    </label>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 control-label">原图册</label>
                        <div class="col-sm-10" id="edit-div-pics">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit-pics" class="col-sm-2 control-label">轮播图</label>
                        <div class="col-sm-10">
                            <input type="file" name="edit-pics[]" id="edit-pics" class="file" multiple>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?=W('Widget/deleteModal',[['id'=>'item-delete']]) ?>

<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput.min.js"></script>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput_locale_zh.js"></script>

<script>
/* 初始化fileinput控件（第一次初始化） */
function initFileInput(ctrlName, uploadUrl) 
{
    var control = $('#' + ctrlName);
    control.fileinput({
        language: 'zh', //设置语言
        uploadUrl: uploadUrl, //上传的地址
        allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀
        showUpload: true, //是否显示上传按钮
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式             
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>", 
    });
}
initFileInput('pics',"<?=U('ajaxColumnBanner') ?>");
initFileInput('edit-pics',"<?=U('ajaxColumnBanner') ?>");


    /* 更新名称 */
    function update_name(obj,id)
    {
        var value = $(obj).val();
        if(!value){
            $(obj).parent().addClass('has-error');return;
        }
        if($(obj).parent().hasClass('has-error')){
            $(obj).parent().removeClass('has-error');
        }
        $.post("<?=U('columnList') ?>",{"action":"name","name":value,"id":id},function(e){
            if(!e){
                $(obj).parent().addClass('has-error');
            }
        });
    }
/* 更新介绍 */
    function update_intro(obj,id)
    {
        var value = $(obj).val();
        if(!value){
            $(obj).parent().addClass('has-error');return;
        }
        if($(obj).parent().hasClass('has-error')){
            $(obj).parent().removeClass('has-error');
        }
        $.post("<?=U('columnList') ?>",{"action":"intro","intro":value,"id":id},function(e){
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
        $.post("<?=U('columnList') ?>",{"action":"sorted","id":id,"sorted":value});
    }

    /* 删除 */
    var cur_id  = false; // 当前操作的ID
    var $cur_tr = false; // 当前操作的表格tr

    /* 编辑 */
    function item_edit(obj,id)
    {
        $cur_tr = $(obj).parents('tr');
        cur_id  = id;
        $.get("<?=U('columnList') ?>",{"id":cur_id},function(e){
            var $modal = $('#modal-edit');
                $modal.find(':hidden[name="id"]').val(e.id)
                $modal.find('#edit-name').text(e.name)
                $modal.find('#edit-intro').val(e.intro);
                $modal.find(':checkbox').each(function(){$(this).prop('checked',false)});
                for(var i in e.cates){
                    $modal.find(':checkbox[value='+e['cates'][i]+']').prop('checked',true);
                }
                var imgs_ele = '';
                for(var i in e.pics){
                    imgs_ele += '<img src="'+e['pics'][i]+'" class="img-rounded" width="80">\
                    <input type="hidden" name="pics[]" value="'+e['pics'][i]+'">';
                }
                $modal.find('#edit-div-pics').html(imgs_ele);
                // $modal.find('#edit-div-pics').append(imgs_ele);
            
            $modal.modal('show');
        });
    }

    function item_del(obj,id)
    {
        cur_id = id;
        $cur_tr = $(obj).parents('tr');
        $('#item-delete').modal();
    }
    /* 确定删除 */
    function fn_confirm_delete(modal_id)
    {
        $.post("<?=U('columnList') ?>",{"id":cur_id,"action":'del'},function(e){
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
    $.post("<?=U('columnList') ?>",{"action":"start","id":id},function(e){
        var new_ele = '<span class="label label-success" onclick="item_stop(this,'+id+')">显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

/* 状态 禁用 */
function item_stop(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('columnList') ?>",{"action":"stop","id":id},function(e){
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