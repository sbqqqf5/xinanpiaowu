<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <link rel="stylesheet" href="/Public/admin/bootstrap_fileinput/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/admin/wangeditor/dist/css/wangEditor.min.css">
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
                <li>
                    <a href="<?=U('index') ?>">商品列表</a>
                </li>
                <li class="active">添加商品</li>
            </ol>
            </div>
        </div>
        
        <form action="<?=U('addProductStep2') ?>" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">商品名</label>
                    <div class="col-sm-10">
                        <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">购买方式</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="payment_way" value="1" checked="checked">
                                一般商品
                            </label>
                            <label>
                                <input type="radio" name="payment_way" value="2">
                                仅积分购买
                            </label>
                            <label>
                                <input type="radio" name="payment_way" value="3">
                                仅会员购买
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_new" class="col-sm-2 control-label">是否新品</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_new" id="is_new" checked>
                                是
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recommend" class="col-sm-2 control-label">是否推荐</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="recommend" id="recommend" checked>
                                是
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_hot" class="col-sm-2 control-label">是否热卖</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="id_hot" id="id_hot" checked>
                                是
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCate" class="col-sm-2 control-label">商品类别</label>
                    <div class="col-sm-10">
                        <div class="col-sm-5" style="padding-left:0;">
                            <select id="inputCate_parent" class="form-control" required="required">
                                <option value="0">请选择</option>
                                <?php foreach($cates as $cate): ?>
                                    <option value="<?=$cate['id'] ?>"><?=$cate['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-5" style="padding-left:0;">
                            <select name="cate_id" id="input-cate" class="form-control" required="required">
                                <option value="0">请选择</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputColumn_id" class="col-sm-2 control-label">所属品牌</label>
                    <div class="col-sm-2">
                        <select name="column_id" id="inputColumn_id" class="form-control">
                            <option value="0">请选择</option>
                            <?php foreach ($columns as $column): ?>
                                <option value="<?=$column['id'] ?>"><?=$column['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="shop_price" class="col-sm-2 control-label">最低价格</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="shop_price" id="shop_price" class="form-control" required="required">
                            <div class="input-group-addon">&yen;</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="commission" class="col-sm-2 control-label">佣金</label>
                    <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" name="commission" id="commission" class="form-control" required>
                        <div class="input-group-addon">&yen;</div>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputKeywords" class="col-sm-2 control-label">关键词</label>
                    <div class="col-sm-10">
                        <input type="text" name="keywords" id="inputKeywords" class="form-control">
                        <p class="help-block">多个关键词以空格分隔</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pics" class="col-sm-2 control-label">图片</label>
                    <div class="col-sm-10">
                        <input type="file" name="" id="pics" accept="image/*" multiple>
                    </div>
                </div>
                <div class="form-group">
                    <label for="goods_content" class="col-sm-2 control-label">商品详情</label>
                    <div class="col-sm-10">
                        <textarea name="goods_content" id="goods_content" style="height:400px"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">下一步</button>
                    </div>
                </div>
        </form>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput.min.js"></script>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput_locale_zh.js"></script>
<script src="/Public/admin/wangeditor/dist/js/wangEditor.min.js"></script>
<script>
/* 选择分类二级联动 */
$('#inputCate_parent').change(function(){
    var id = $(this).val();
    if(id != 0 ){
        $.get("<?=U('index') ?>",{"cate_id":id},function(e){
            var html = '<option value="0">请选择</option>';
            for(var i in e){
                html += '<option value="'+e[i]['id']+'">'+e[i]['name']+'</option>';
            }
            $('#input-cate').html(html);
        });
    }else{
        $('#input-cate').html('<option value="0">请选择</option>');
    }
});
var pics = new Array(); // 上传的图片
var pics_count = 0; // 上传图片计数
//初始化fileinput控件
function file_input_init(ctrlName, uploadUrl) 
{
    var control = $('#' + ctrlName);
    control.fileinput({
        uploadUrl: uploadUrl, //上传的地址
        allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀
        showPreview : true,
        showUpload: true, //是否显示上传按钮
        showCaption: false,//是否显示标题
        initialPreviewShowDelete : false,
        // maxFileCount : 1,
    });
    //上传后的回调
    control.on('fileuploaded',function(event,data,previewId,index){
        pics[pics_count++] = data.response;
    });
}
$('form').submit(function(){
    for(var i in pics){
        $(':submit').before('<input type="hidden" name="pics[]" value="'+pics[i]+'">');
    }
});
file_input_init('pics',"<?=U('ajaxUploadGoodsPics') ?>");

 <?=W('Widget/wangEditor',[['id'=>'goods_content']]) ?>
</script>
</body>
</html>