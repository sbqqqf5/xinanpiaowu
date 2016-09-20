<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
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
                <li class="active">商品规格设置</li>
            </ol>
            </div>
        </div>
        <div class="" style="margin-bottom:20px;">
            <button class="btn btn-primary" onclick="$('#modal-property-add form')[0].reset();$('#modal-property-add').modal('show')">添加商品规格</button>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="100">#</th>
                    <th class="text-center">所属商品类别</th>
                    <th class="text-center">规格名称</th>
                    <th class="text-center" width="150">排序值</th>
                    <th class="text-center">可选值</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td><?=$v['cate'] ?></td>
                    <td><?=$v['name'] ?></td>
                    <td><input type="text" name="sorted[]" class="form-control input-sm " value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$v['id'] ?>)"></td>
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
                    <h4 class="modal-title">添加商品规格</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">注意：每种商品类别最多添加两种规格！</div>
                            <div class="form-group">
                                <label for="inputType_id" class="col-sm-3 control-label">所属商品类别</label>
                                <div class="col-sm-9">
                                    <select name="type_id" id="inputType_id" class="form-control">
                                        <option value="0">请选择</option>
                                        <?php foreach ($cates as $cate): ?>
                                            <option value="<?=$cate['id'] ?>"><?=$cate['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">规格名称</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="inputName" class="form-control"  required="required" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSorted" class="col-sm-3 control-label">排序值</label>
                                <div class="col-sm-9">
                                    <input type="number" name="sorted" id="inputSorted" class="form-control"  required>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="3">
                            <div class="form-group">
                                <label for="textareaVal" class="col-sm-3 control-label">可选值列表</label>
                                <div class="col-sm-9">
                                    <textarea name="value" id="textareaVal" class="form-control" rows="3"></textarea>
                                    <p class="help-block">每行输入一个值</p>
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
});
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
                $modal.find('#inputType_id>option[value='+e['type_id']+']').prop('selected',true);
                $modal.find('#inputName').val(e['name']) ;
                $modal.find('#inputSorted').val(e['sorted']);
                $modal.find('#id').val(e['id'])  ;
                $modal.find('#textareaVal').val(e['value']);

            $modal.modal('show');
        });
    }
    /* 更新排序 */
function update_sorted(obj,id)
{
    var value = $(obj).val();
    if(value > 65535 || value < -65536){
        layer.alert('排序值不能超过65536',{skin:"layui-layer-lan"});
        $(obj).parent().addClass('has-error');
        return false;
    }
    if($(obj).parent().hasClass('has-error')){
        $(obj).parent().removeClass('has-error');
    }
    $.post("<?=U('productProperty') ?>",{"action":"sorted","id":id,"value":value});
}
</script>
</body>
</html>