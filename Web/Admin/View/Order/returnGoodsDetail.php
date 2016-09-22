<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .detail-imgs>img{max-width:150px; cursor:pointer;}
        .info{width:200px;}
        .table tr:nth-child(odd){background-color:#eaf4f0;}
        .table tr:nth-child(even){background-color:#d2eee3;}
        .table tr>td:nth-child(1){width:200px;}
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
                    <a href="javascript:;">订单管理</a>
                </li>
                <li>
                    <a href="<?=U('returnList') ?>">退货单列表</a>
                </li>
                <li class="active">退货详情</li>
            </ol>
            </div>
        </div>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>注意：</strong> 将<span class="label label-info">状态</span>设置为 <span class="label label-success">已同意</span>后，用户方可发货。
        </div>
       <table class="table table-hover">
           <tbody>
               <tr>
                   <td>订单编号</td>
                   <td><a href="<?=U('orderDetail', ['order_id'=>$detail['order_id']]) ?>"><?=$detail['order_sn'] ?></a></td>
               </tr>
               <tr>
                   <td>用户</td>
                   <td><?=$detail['nickname'].'&nbsp; (电话： '.$detail['phone'].' )' ?></td>
               </tr>
               <tr>
                   <td>申请日期</td>
                   <td><?=$detail['create_at'] ?></td>
               </tr>
               <tr>
                   <td>商品名称</td>
                   <td><?=$detail['goods_name'] ?></td>
               </tr>
               <tr>
                   <td>退款原因</td>
                   <td><?=$detail['reason'] ?></td>
               </tr>
               <tr>
                   <td>退款描述</td>
                   <td><textarea class="form-control" rows="3" style="width:300px;"><?=$detail['description'] ?></textarea></td>
               </tr>
               <tr>
                   <td>用户上传图片</td>
                   <td class="detail-imgs">
                       <?php if(!empty($detail['imgs'])):foreach($detail['imgs'] as $img): ?>
                        <img src="<?=$img ?>" class="img-rounded" alt="图像不存在了">
                       <?php endforeach;endif; ?>
                       <img src="/Public/admin/assets/img/slideshow/1.jpg" alt="" class="img-rounded">
                   </td>
               </tr>
               <tr>
                   <td>用户发货状态</td>
                   <td>
                       <?php if($detail['user_delivery']): ?>
                        快递单号：<?=$detail['express_code'] ?> &nbsp;&nbsp;&nbsp;&nbsp;发货时间： <?=date('Y-m-d H:i:s', $detail['express_time']) ?>
                       <?php else: ?>
                            <span class="label label-default">未发货</span>
                       <?php endif; ?>
                       <button type="button" class="btn btn-primary btn-sm" id="show-modal-refund" style="margin-left:50px;">退款给用户</button>
                   </td>
               </tr>
               <tr>
                   <td>状态</td>
                   <td>
                       <select name="status" id="inputStatus" class="form-control" style="width:100px;">
                       <?php foreach($status as $k=>$s): ?>
                           <option value="<?=$k ?>" <?=$k==$detail['status']?'selected':'' ?>><?=$s ?></option>
                       <?php endforeach; ?>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td>处理备注</td>
                   <td>
                       <textarea name="remark" id="inputRemark" class="form-control" rows="3" style="width:300px;"></textarea>
                   </td>
               </tr>
               <tr>
                   <td></td>
                   <td >
                       <button type="button" class="btn btn-primary" style="margin-left:300px;" onclick="save_info()">保存</button>
                   </td>
               </tr>
           </tbody>
       </table>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

 <div class="modal fade" id="modal-refund">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('handleRefund') ?>" method="POST" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">退款给用户</h4>
                </div>
                <div class="modal-body">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>提示：</strong> 请至 <a href="https://pay.weixin.qq.com/index.php/core/home/login?return_url=%2F" target="_blank">微信商户平台</a> 退款。
                </div>
                     <div class="form-group">
                        <label for="money">退还金额</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="money" name="money" value="0">
                            <div class="input-group-addon">&yen;</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="integral">退还积分</label>
                        <input type="number" class="form-control" id="integral" name="integral" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" value="<?=$detail['user_id'] ?>">
                    <input type="hidden" name="order_id" value="<?=$detail['order_id'] ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">确认</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__.'/../Layout/_script.php' ?>
<script type="text/javascript">

    // 用户上传的图像 点击弹出
    $('.detail-imgs img').on('click',function(){
        var imgSrc = $(this).attr('src');
        var imgEle = '<img src="'+imgSrc+'" style="max-width:600px;">';
        layer.open({
            type: 1,
            title: false,
            area: '600px',
            shadeClose: true,
            content: imgEle
        });
    });
    /* 显示退款 modal  */
    $('#show-modal-refund').on('click',function(){
        $('#modal-refund').modal('show')
    });
    /*  确认退款   */
    $('#modal-refund form :submit').on('click',function(event){
        event.preventDefault();
        var data = $('#modal-refund form').serializeArray();
        $.post('<?=U('handleRefund') ?>', data, function(e){
            console.log(e);
            if(e[0]){
                layer.msg(e[1],function(){
                    $('#modal-refund').modal('hide');
                });
            }else{
                layer.alert(e[1],{skin:'layui-layer-lan'});
            }
        });
    });
// 保存
function save_info()
{
    var status = $('#inputStatus').val();
    if(status == 0){
      layer.alert('状态选择无效',{skin:'layui-layer-lan'});return;
    }
    var remark = $('#inputRemark').val(); 
    var id     = <?=$detail['id'] ?>;
    var data = {status:status, remark:remark, id:id};
    $.post("<?=U('returnGoodsDetail') ?>", data, function(e){
      if(e[0]){
        layer.msg(e[1],{icon:1,time:2000},function(){
          location.href = "<?=U('returnList') ?>";
        });
      }else{
        layer.alert(e[1],{skin:'layui-layer-lan'});
      }
    })
}
</script>
</body>
</html>