<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
    <style type="text/css">
        .td-status span{-moz-user-select: none;-webkit-user-select: none;user-select:none;}
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
                    <label for="" class="sr-only"></label>
                    <select name="columns" id="inputColumns" class="form-control">
                        <option value="0">选择栏目</option>
                        <?php foreach($columns as $key=>$v): ?>
                        <option value="<?=$key ?>"><?=$v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="sr-only"></label>
                    <select name="cate" id="inputCate" class="form-control">
                        <option value="0">选择类别</option>
                        <?php foreach($secondCates as $key=>$cate): ?>
                        <option value="<?=$key ?>"><?=$cate ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="">label</label>
                    <select name="payment_way" class="form-control">
                        <option value="0">选择支付方式</option>
                        <option value="1">一般</option>
                        <option value="2">仅积分</option>
                        <option value="3">仅会员</option>
                    </select>
                </div>
                <input type="hidden" name="action" value="search">
                <button type="submit" class="btn btn-primary">筛选</button>
            </form>
        </div>

        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">商品名</th>
                <th class="text-center">栏目</th>
                <th class="text-center">分类</th>
                <th class="text-center">支付方式</th>
                <th class="text-center">佣金</th>
                <th class="text-center">排序值</th>
                <th class="text-center">状态</th>
                <th class="text-center" width="85">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $k=>$v): ?>
            <tr>
                <td class="text-center"><?=$k+1 ?></td>
                <td><?=$v['goods_name'] ?></td>
                <td><?=$columns[$v['column_id']] ?></td>
                <td><?=$secondCates[$v['cate_id']] ?></td>
                <td class="text-center"><span class="label label-<?=$v['payment_way']==1?'success':($v['payment_way']==2?'info':'danger') ?>"><?=$paymentWay[$v['payment_way']] ?></span></td>
                <td><?=$v['commission'] ?></td>
                <td class="text-center">
                    <input type="text" name="sorted[]" class="form-control input-sm" value="<?=$v['sorted'] ?>" required="required" onblur="update_sorted(this,<?=$v['id'] ?>)" style="width:90px">
                </td>
                <td class="td-status text-center">
                    <span class="label label-<?=$v['is_on_sale']==1?'success':'default' ?>" onclick="is_sale(this,<?=$v['id'] ?>)">上架</span>
                    <span class="label label-<?=$v['is_recommend']==1?'success':'default' ?>" onclick="is_recommend(this,<?=$v['id']?>)">推荐</span>
                    <span class="label label-<?=$v['is_new']==1?'success':'default' ?>" onclick="is_new(this,<?=$v['id'] ?>)">新品</span>
                    <span class="label label-<?=$v['is_hot']==1?'success':'default' ?>" onclick="is_hot(this,<?=$v['id'] ?>)">热卖</span>
                </td>
                <td class="td-manage">
                    <!-- <a href="<?=U('ticketView',['id'=>$v['id']]) ?>"> -->
                    <a href="javascript:;">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="查看"></span>
                    </a>
                    <a href="<?=U('addProduct',['id'=>$v['id']]) ?>">
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
                {"orderable":false,"targets":[-1,-2]} // 不参与排序的列
            ],
       });

        $('.td-manage span').tooltip();
        $(document).ajaxError(function(){
            layer.alert('发生错误，请刷新重试',{skin:"layui-layer-lan"});
    });
});

/* 状态 —— 上架 下架  */
function is_sale(obj,id)
{
    var data = {"action":"is_on_sale","id":id,"handle":'status'};
    if($(obj).hasClass('label-success')){
        data.value = 0;
    }else{
        data.value = 1;
    }
    $.post("<?=U('index') ?>",data,function(){
        $(obj).toggleClass('label-success').toggleClass('label-default')
    });
}
/* 状态 —— 推荐  */
function is_recommend(obj,id)
{
    var data = {"action":"is_recommend","id":id,"handle":'status'};
    if($(obj).hasClass('label-success')){
        data.value = 0;
    }else{
        data.value = 1;
    }
    $.post("<?=U('index') ?>",data,function(){
        $(obj).toggleClass('label-success').toggleClass('label-default')
    });
}
/* 状态 —— 新品  */
function is_new(obj,id)
{
    var data = {"action":"is_new","id":id,"handle":'status'};
    if($(obj).hasClass('label-success')){
        data.value = 0;
    }else{
        data.value = 1;
    }
    $.post("<?=U('index') ?>",data,function(){
        $(obj).toggleClass('label-success').toggleClass('label-default')
    });
}
/* 状态 —— 热卖  */
function is_hot(obj,id)
{
    var data = {"action":"is_hot","id":id,"handle":'status'};
    if($(obj).hasClass('label-success')){
        data.value = 0;
    }else{
        data.value = 1;
    }
    $.post("<?=U('index') ?>",data,function(){
        $(obj).toggleClass('label-success').toggleClass('label-default')
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
    $.post("<?=U('index') ?>",{"id":cur_id,"action":'delete'},function(e){
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
    if(value >= 65536){
        layer.alert('排序值不能超过65535',{skin:"layui-layer-lan"});
        $(obj).val(10);
        return false;
    }
    $.post("<?=U('index') ?>",{"action":"sorted","id":id,"sorted":value});
}
</script>
</body>
</html>