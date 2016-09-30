<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <!-- <link href="/Public/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="/Public/admin/bootstrap_fileinput/css/fileinput.min.css">
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        thead tr{background-color:#00ca79;color:#fff;}
        td .label{cursor:pointer;}
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
                        <a href="javascript:;">商品管理</a>
                    </li>
                    <li>
                        <a href="javascript:;">明星周边商品</a>
                    </li>
                    <li class="active">明星品牌</li>
                </ol>
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <button class="btn btn-primary" onclick="$('#modal-add-star form')[0].reset();$('#modal-add-star').modal('show');">添加明星品牌</button>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="100">属性ID</th>
                    <th class="text-center">明星品牌</th>
                    <th class="text-center">缩略图</th>
                    <th class="text-center" width="100">排序值</th>
                    <th class="text-center">显示为栏目</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td><input type="text" class="form-control input-sm " value="<?=$v['name'] ?>" onblur="update_name(this,<?=$v['id'] ?>)"></td>
                    <td class="text-center">
                        <img src="<?=$v['thumb']?$v['thumb']:'/Public/admin/assets/img/demoUpload.jpg' ?>" class="img-rounded" width="50">
                    </td>
                    <td><input type="text" name="sorted[]" class="form-control input-sm " value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$v['id'] ?>)"></td>
                    <td class="text-center">
                        <?php if($v['status']): ?>
                            <span class="label label-success" onclick="item_stop(this,<?=$v['id'] ?>)">显示</span>
                        <?php else: ?>
                            <span class="label label-default" onclick="item_start(this,<?=$v['id'] ?>)">不显示</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center td-manage">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="编辑" onclick="item_edit(this,<?=$v['id'] ?>)"></span>
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" data-id="<?=$v['id'] ?>" onclick="item_del(this)"></span>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-add-star">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=U('starAdd') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加分类</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 control-label">明星品牌</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="inputName" class="form-control" required="required" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSorted" class="col-sm-2 control-label">排序值</label>
                        <div class="col-sm-10">
                            <input type="text" name="sorted" id="inputSorted" class="form-control" value="1" required="required" placeholder="值越大，显示越前">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 control-label">显示为栏目</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" value="1">
                                    显示
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">缩略图</label>
                        <div class="col-sm-10">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                <div>
                                    <span class="btn btn-file btn-success">
                                        <span class="fileupload-new">选择图片</span>
                                        <span class="fileupload-exists">重新选择</span>
                                        <input type="file" id="thumb_file" name="thumb_file" onchange="handleFiles(this.files,'thumb_file',0,'thumb')">
                                        <input type="hidden" name="thumb" id="thumb" value="">
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">移除</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="input" class="col-sm-2 control-label">图册</label>
                      <div class="col-sm-10">
                          <input type="file" name="pics[]" id="pics" class="file" multiple>
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


<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=U('starAdd') ?>" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">明星品牌</label>
                        <div class="col-sm-10">
                            <p class="form-control-static" id="edit-name"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="thumb" class="col-sm-2 control-label">缩略图</label>
                        <div class="col-sm-10">
                            <img src="/Public/admin/assets/img/demoUpload.jpg" id="edit-thumb" class="img-rounded" width="80" onclick="$('#edit-thumb-file').click()">
                            <input type="hidden" name="thumb" id="edit-thumb-hidden">
                            <input type="file" name="file" id="edit-thumb-file" style="display:none;" onchange="handleFiles(this.files,'edit-thumb-file','edit-thumb','edit-thumb-hidden')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">原图册</label>
                        <div class="col-sm-10" id="edit-div-pics">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pics" class="col-sm-2 control-label">图册</label>
                        <div class="col-sm-10">
                            <input type="file" name="pics[]" id="edit-pics" class="file" multiple>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <input type="reset" value="重置" class="btn btn-default">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__.'/../Layout/_script.php' ?>
<!-- <script src="/Public/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>  -->
<script src="/Public/admin/bootstrap_fileinput/js/fileinput.min.js"></script>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput_locale_zh.js"></script>
<script src="/Public/admin/assets/js/ajaxfileupload.js"></script>
<script>
//初始化fileinput控件（第一次初始化）
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
initFileInput('pics',"<?=U('ajaxStarBanner') ?>");
initFileInput('edit-pics',"<?=U('ajaxStarBanner') ?>");

/* 上传缩略图 */
//onchange="handleFiles(this.files)"
function handleFiles(files,fileID,picID,hiddenID){
    console.log(picID)
    var file = files[0];  //从文件对象中获取到第一个
    if(!file){return;}
    var reader = new FileReader(); 
    var index = layer.load(); 
    reader.onload = (function(img){
        return function(e){
            if(picID){
                $("#"+picID).attr('src', e.target.result );  
            }
        };
    })(file);
    reader.readAsDataURL(file);
    $.ajaxFileUpload({
        url : "<?=U('ajaxStarBrandUpload') ?>",
        type : 'post',
        secureuri : false,
        fileElementId : fileID,
        dataTpye: 'json',
        error : function(e){
            layer.close(index);
            layer.alert('缩略图上传失败！');
        },
        success : function(ans){
            layer.close(index);
            if(ans == 0){
                layer.alert('上传失败',{skin:"layui-layer-lan"});
            }else{
                var imgpath = $(ans).text();
                $('#'+hiddenID).val(imgpath);
            }
        },
    });
};

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
    $.post("<?=U('starBrandHandle') ?>",{"action":"sorted","id":id,"value":value});
}
/* 更新名称 */
function update_name(obj,id)
{
    var value = $(obj).val();
    if($(obj).parent().hasClass('has-error')){
        $(obj).parent().removeClass('has-error');
    }
    $.post("<?=U('starBrandHandle') ?>",{"action":"name","name":value,"id":id},function(e){
        if(!e){
            $(obj).parent().addClass('has-error');
        }
    });
}
/* 状态 启用 */
function item_start(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('starBrandHandle') ?>",{"action":"start","id":id},function(e){
        var new_ele = '<span class="label label-success" onclick="item_stop(this,'+id+')">显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

/* 状态 禁用 */
function item_stop(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('starBrandHandle') ?>",{"action":"stop","id":id},function(e){
        var new_ele = '<span class="label label-default" onclick="item_start(this,'+id+')">不显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

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
    $.post("<?=U('starBrandHandle') ?>",{"id":cur_id,"action":'del'},function(e){
        $('#'+modal_id).modal('hide');
        if(e){
            $cur_tr.remove();
        }else{
            layer.alert('操作失败',{skin:"layui-layer-lan"});
        }
    });
}

/* 编辑 */
function item_edit(obj,id)
{
    $cur_tr = $(obj).parents('tr');
    cur_id  = id;
    $.get("<?=U('starBrandHandle') ?>",{"id":cur_id},function(e){
        var $modal = $('#modal-edit');
            $modal.find(':hidden[name="id"]').val(e.id)
            $modal.find('#edit-name').text(e.name)
            if(e.thumb){
                $modal.find('#edit-thumb').attr('src',e.thumb)
                $modal.find('#edit-thumb-hidden').val(e.thumb)
            }
            var imgs_ele = '';
            for(var i in e.pics){
                imgs_ele += '<img src="'+e['pics'][i]+'" id="edit-thumb" class="img-rounded" width="80">\
                <input type="hidden" name="pics[]" value="'+e['pics'][i]+'">';
            }
            $modal.find('#edit-div-pics').empty();
            $modal.find('#edit-div-pics').append(imgs_ele);
        
        $modal.modal('show');
    });
}

/* 隐藏modal 重置 session */
$('#modal-add-star').on('hide.bs.modal',function(){
    $.post("<?=U('resetSessionBanner') ?>");
});
$('#modal-edit').on('hide.bs.modal',function(){
    $.post("<?=U('resetSessionBanner') ?>");
});
$(function(){
    $('.td-manage .glyphicon').tooltip();

    $(document).ajaxError(function(){
        layer.alert('发生错误，请刷新重试',{skin:"layui-layer-lan"});
    });
});
</script>
</body>
</html>