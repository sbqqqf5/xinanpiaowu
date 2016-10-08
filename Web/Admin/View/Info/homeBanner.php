<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <link rel="stylesheet" href="/Public/admin/bootstrap_fileinput/css/fileinput.min.css">
    <?=W('Widget/dataTablesCss') ?>
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
                    <a href="javascript:;">网站管理</a>
                </li>
                <li class="active">首页轮播图</li>
            </ol>
            </div>
        </div>

        <button type="button" class="btn btn-primary" style="margin-bottom:20px" onclick="$('#modal-add form')[0].reset();$('#modal-add').modal('show')">添加</button>
        
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">图片</th>
                    <th class="text-center">链接</th>
                    <th class="text-center">排序</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $k=>$v): ?>
                <tr>
                    <td class="text-center"><?=$k+1 ?></td>
                    <td class="text-center"><img src="<?=$v['img'] ?>" class="img-rounded" width="50" onclick="show_thumb(this.src)"></td>
                    <td class="text-center"><?=$v['link'] ?></td>
                    <td class="text-center">
                        <input type="text" name="sorted[]" class="form-control input-sm " value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$v['id'] ?>)">
                    </td>
                    <td class="text-center">
                        <?php if($v['status']): ?>
                            <span class="label label-success" onclick="item_stop(this,<?=$v['id'] ?>)">显示</span>
                        <?php else: ?>
                            <span class="label label-default" onclick="item_start(this,<?=$v['id'] ?>)">不显示</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="javascript:;">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除" onclick="item_del(this,<?=$v['id'] ?>)"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('homeBanner') ?>" method="post" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="form-group-origin-img" style="display:none;">
                        <label for="" class="col-sm-2 control-label">原图</label>
                        <div class="col-sm-10" id="edit-div-pics">
                            <img src="" class="img-rounded">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-pics" class="col-sm-2 control-label">图像</label>
                        <div class="col-sm-10">
                            <input type="file" name="edit-pics[]" id="input-file" class="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">超链接</label>
                        <div class="col-sm-10">
                            <input type="text" name="link" id="inputLink" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSorted" class="col-sm-2 control-label">排序值</label>
                        <div class="col-sm-10">
                            <input type="number" name="sorted" id="inputSorted" class="form-control" value="50" min="0" max="127" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="img" value="">
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?=W('Widget/deleteModal',[['id'=>'item-delete']]) ?>
<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput.min.js"></script>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput_locale_zh.js"></script>
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
             {"orderable":false,"targets":[-1]} // 不参与排序的列
         ],
    });
})
/** 上传控件初始化 */
function initFileInput(ctrlName, uploadUrl) 
{
    var control = $('#' + ctrlName);
    control.fileinput({
        language: 'zh', //设置语言
        uploadUrl: uploadUrl, //上传的地址
        allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀
        showUpload: true, //是否显示上传按钮
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary btn-sm", //按钮样式             
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>", 
    });
    control.on('fileuploaded',function(event,data,previewId,index){
        var imgpath = data.response;
        $('input:hidden[name=img]').val(imgpath);
    });
}
initFileInput('input-file',"<?=U('ajaxHomeBanner') ?>");

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
    $.post("<?=U('homeBanner') ?>",{"action":"sorted","id":id,"sorted":value});
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
    $.post("<?=U('homeBanner') ?>",{"id":cur_id,"action":'del'},function(e){
        $('#'+modal_id).modal('hide');
        if(e){
            $cur_tr.remove();
        }else{
            layer.alert('删除失败',{skin:"layui-layer-lan"});
        }
    });
}
/* 状态 启用 */
function item_start(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('homeBanner') ?>",{"action":"status","id":id,"value":1},function(e){
        var new_ele = '<span class="label label-success" onclick="item_stop(this,'+id+')">显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

/* 状态 禁用 */
function item_stop(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('homeBanner') ?>",{"action":"status","id":id,"value":0},function(e){
        var new_ele = '<span class="label label-default" onclick="item_start(this,'+id+')">不显示</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}
/** 查看大图 */
function show_thumb(img)
{
    layer.open({
        type:1,
        title:false,
        content:'<img src="'+img+'" width="700">',
        area:'700px',
    })
}
</script>
</body>
</html>