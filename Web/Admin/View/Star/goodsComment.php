<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/dataTablesCss') ?>
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
                <li class="active">商品评价</li>
            </ol>
            </div>
        </div>
        <table class="table table-hover table-bordered" ">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">用户昵称</th>
                    <th class="text-center">商品</th>
                    <th class="text-center">规格</th>
                    <th class="text-center">评论</th>
                    <th class="text-center">时间</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">查看</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $k=>$v): ?>
                <tr>
                    <td class="text-center"><?=$k+1 ?></td>
                    <td class="text-center"><?=$v['user_nickname'] ?></td>
                    <td class="text-center"><?=$v['goods_name'] ?></td>
                    <td class="text-center">
                    <?php foreach($v['key_value'] as $value): 
                        echo $value['name'],':',$value['value'],'&nbsp;&nbsp;';
                    endforeach; ?>
                    </td>
                    <td class="text-center"><?=mb_substr($v['content'], 0,20) ?></td>
                    <td class="text-center"><?=$v['create_at'] ?></td>
                    <td class="text-center">
                        <?=$v['status']==1?'<span class="label label-success">显示中</span>':'<span class="label label-default">已屏蔽</span>' ?>
                    </td>
                    <td class="text-center">
                        <a href="javascript:;" onclick="item_detail(<?=$v['id'] ?>)">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('goodsCommentView') ?>" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">评论详情</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nickname" class="col-sm-2 control-label">用户昵称</label>
                        <div class="col-sm-10">
                            <p class="form-control-static nickname"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goods_name" class="col-sm-2 control-label">商品名</label>
                        <div class="col-sm-10">
                            <p class="form-control-static goods_name"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create_at" class="col-sm-2 control-label">发布时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static create_at"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-sm-2 control-label">评分</label>
                        <div class="col-sm-10">
                            <input type="number" name="score" id="inputScore" class="form-control" value="" min="1" max="5" step="1" required="required" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPics" class="col-sm-2 control-label">图片</label>
                        <div class="col-sm-10 pics">
                            <!-- <img src="" class="img-rounded" width="100"> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textareaContent" class="col-sm-2 control-label">内容</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="textareaContent" class="form-control" rows="3" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">状态</label>
                        <div class="col-sm-3">
                            <select name="status" id="inputStatus" class="form-control" required="required">
                                <option value="1">显示</option>
                                <option value="2">屏蔽</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">修改</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
/** 评论详情查看 修改 */
function item_detail(id)
{
    var $modal = $('#modal-detail');
    $.get("<?=U('goodsCommentView') ?>",{id:id},function(e){
        console.info(e)
        $modal.find('.nickname').text(e.user_nickname);
        var goods_name = e.goods_name + '  [ ';
        for(var i=0; i < e.key_value.length; i++){
            goods_name += e.key_value[i].name + ' : ' + e.key_value[i].value + '  ';
        }
        goods_name += ' ]';
        $modal.find('.goods_name').text(goods_name);
        $modal.find('.create_at').text(e.create_at);
        $modal.find('#inputScore').val(e.score);
        if(e.pics){
            var pics = '';
            for(var i=0; i < e.pics.length; i++){
                pics += '<img src="'+e.pics[i]+'" class="img-rounded" width="100">';
            }
            $modal.find('.pics').append(pics);
        }
        $modal.find('#textareaContent').val(e.content);
        // $modal.find('#inputStatus option').prop('selected',false);
        $modal.find('#inputStatus option[value='+e.status+']').prop('selected',true);
        $modal.find('[name=id]').val(id);
        $modal.modal('show')
    })
}
</script>
</body>
</html>