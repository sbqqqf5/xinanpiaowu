<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        .td-manage a{text-decoration: none;}
        thead tr{background-color:#00ca79;color:#fff;}
        td .label{cursor:pointer;}
        .mg-b-20{margin-bottom:20px;}
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
                <li class="active">商品列表</li>
            </ol>
            </div>
        </div>

        <div class="mg-b-20 clearfix">
            <a class="btn btn-primary" href="<?=U('addProduct') ?>" role="button">添加商品</a>
            <form action="<?=U('index') ?>" method="get" class="form-inline pull-right" role="form">
            
                <div class="form-group">
                    <label class="sr-only" for="">label</label>
                    <select name="city" class="form-control">
                        <option value="0">选择城市</option>
                        <?php foreach($cities as $city): ?>
                        <option value="<?=$city['id'] ?>"><?=$city['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="sr-only"></label>
                    <select name="columns" id="inputColumns" class="form-control">
                        <option value="0">选择栏目</option>
                        <?php foreach($columns as $column): ?>
                        <option value="<?=$column['id'] ?>"><?=$column['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="sr-only"></label>
                    <select name="cate" id="inputCate" class="form-control">
                        <option value="0">选择类别</option>
                        <?php foreach($cates as $cate): ?>
                        <option value="<?=$cate['id'] ?>"><?=$cate['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="action" value="search">
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>

        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">名称</th>
                <th class="text-center">预定</th>
                <th class="text-center">城市</th>
                <th class="text-center">场馆</th>
                <th class="text-center">栏目</th>
                <th class="text-center">分类</th>
                <th class="text-center">库存</th>
                <th class="text-center">排序值</th>
                <th class="text-center">显示在首页</th>
                <th class="text-center">当前状态</th>
                <th class="text-center" width="85">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $k=>$v): ?>
            <tr>
                <td class="text-center"><?=$k+1 ?></td>
                <td><?=$v['title'] ?></td>
                <td class="text-center"><?=$v['is_order']?'<span class="label label-success">预定中</span>':'<span class="label label-default">非预定</span>' ?></td>
                <td><?=$v['city_name'] ?></td>
                <td><?=$v['venues'] ?></td>
                <td><?=$v['column_name'] ?></td>
                <td><?=$v['cate_name'] ?></td>
                <td class="text-center inventory"><?=$v['inventory'] ?></td>
                <td class="text-center">
                    <input type="text" name="sorted[]" class="form-control input-sm " value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$v['id'] ?>)" style="width:90px">
                </td>
                <td class="text-center">
                    <?php if($v['is_home']): ?>
                        <span class="label label-success">显示</span>
                    <?php else: ?>
                        <span class="label label-default">不显示</span>
                    <?php endif; ?>
                </td>
                <td class="td-status text-center">
                <?php if($v['status']): ?>
                    <span class="label label-success" onclick="item_stop(this,<?=$v['id'] ?>)">销售中</span>
                <?php else: ?>
                    <span class="label label-default" onclick="item_start(this,<?=$v['id'] ?>)">已下架</span>
                <?php endif; ?>
                </td>
                <td class="td-manage">
                    <a href="<?=U('ticketView',['id'=>$v['id']]) ?>">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="查看"></span>
                    </a>
                    <a href="<?=U('ticketEdit',['id'=>$v['id']]) ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" ata-toggle="tooltip" data-placement="bottom" title="编辑"></span>
                    </a>
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

<?=W('Widget/deleteModal',[['id'=>'item-delete']]) ?>


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
                {"orderable":false,"targets":[-1]} // 不参与排序的列
            ],
       });

        $('.td-manage span').tooltip();

});

/* 状态 上架 */
function item_start(obj,id)
{
    var $td = $(obj).parent();
    var inventory = $(obj).parent().prevAll('.inventory').text();
    if(parseInt(inventory) == 0){layer.alert('库存不足，不能上架',{skin:"layui-layer-lan"});return false;}
    $.post("<?=U('index') ?>",{"action":"start","id":id},function(e){
        var new_ele = '<span class="label label-success" onclick="item_stop(this,'+id+')">销售中</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}

/* 状态 下架 */
function item_stop(obj,id)
{
    var $td = $(obj).parent();
    $.post("<?=U('index') ?>",{"action":"stop","id":id},function(e){
        var new_ele = '<span class="label label-default" onclick="item_start(this,'+id+')">已下架</span>';
        $(obj).remove();
        $td.append(new_ele);
    });
}
var cur_id = 0;
var $cur_tr = '';
function item_del(obj,id)
{
    cur_id = id;
    $cur_tr = $(obj).parents('tr');
    $('#item-delete').modal();
}
/* 确定删除 */
function fn_confirm_delete(modal_id)
{
    $.post("<?=U('index') ?>",{"id":cur_id,"action":'del'},function(e){
        $('#'+modal_id).modal('hide');
        if(e){
            $cur_tr.remove();
        }else{
            layer.alert('操作失败',{skin:"layui-layer-lan"});
        }
    });
}
/* 更新排序 */
function update_sorted(obj,id)
{
    var value = $(obj).val();
    $.post("<?=U('index') ?>",{"action":"sorted","id":id,"sorted":value});
}
</script>
</body>
</html>