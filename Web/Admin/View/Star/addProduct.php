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
        
        <form action="<?=U('addProductStep2') ?>" method="POST" class="form-horizontal" role="form" id="form-add">
                <div class="form-group">
                    <label for="goods_name" class="col-sm-2 control-label">商品名</label>
                    <div class="col-sm-10">
                        <input type="text" name="goods_name" id="goods_name" class="form-control" required value="<?=$detail['goods_name'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">购买方式</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="payment_way" value="1" <?=!isset($detail)||$detail['payment_way']==1?'checked':'' ?>>
                                一般商品
                            </label>
                            <label>
                                <input type="radio" name="payment_way" value="2" <?=$detail['payment_way']==2?'checked':'' ?>>
                                仅积分购买
                            </label>
                            <label>
                                <input type="radio" name="payment_way" value="3" <?=$detail['payment_way']==3?'checked':'' ?>>
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
                                <input type="checkbox" value="1" name="is_new" id="is_new" <?=!isset($detail)||$detail['is_new']?'checked':'' ?>>
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
                                <input type="checkbox" value="1" name="is_recommend" id="recommend" <?=!isset($detail)||$detail['is_recommend']?'checked':'' ?>>
                                是
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_hot" class="col-sm-2 control-label">是否热卖</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_hot" id="is_hot" <?=!isset($detail)||$detail['is_hot']?'checked':'' ?>>
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
                                    <option value="<?=$cate['id'] ?>" <?=$cate['id']==$detail['cate_pid']?'selected':'' ?>><?=$cate['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-5" style="padding-left:0;">
                            <select name="cate_id" id="input-cate" class="form-control" required="required">
                            <?php if(isset($detail)): ?>
                                <?php foreach($detailCates as $cate): ?>
                                    <option value="0">请选择</option>
                                    <option value="<?=$cate['id'] ?>" <?=$cate['id']==$detail['cate_id']?'selected':'' ?>><?=$cate['name'] ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="0">请选择</option>
                            <?php endif; ?>
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
                                <option value="<?=$column['id'] ?>" <?=$column['id']==$detail['column_id']?'selected':'' ?>><?=$column['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="shop_price" class="col-sm-2 control-label">最低价格</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="shop_price" id="shop_price" class="form-control" required="required" value="<?=$detail['shop_price'] ?>">
                            <div class="input-group-addon">&yen;</div>
                        </div>
                        <p class="help-block">仅做显示，排序时使用</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="commission" class="col-sm-2 control-label">佣金</label>
                    <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" name="commission" id="commission" class="form-control" required value="<?=$detail['commission'] ?>">
                        <div class="input-group-addon">&yen;</div>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputKeywords" class="col-sm-2 control-label">关键词</label>
                    <div class="col-sm-10">
                        <input type="text" name="keywords" id="inputKeywords" class="form-control" value="<?=$detail['keywords'] ?>">
                        <p class="help-block">多个关键词以空格分隔</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textareaProperty" class="col-sm-2 control-label">材质</label>
                    <div class="col-sm-10">
                        <textarea name="property" id="textareaProperty" class="form-control" rows="3"><?=nl2br($detail['propery']) ?></textarea>
                        <p class="help-block">每行输入一条信息</p>
                    </div>
                </div>
                <?php if(isset($detail)): ?>
                    <div class="form-group">
                    <label for="" class="col-sm-2 control-label">原缩略图</label>
                    <div class="col-sm-10">
                        <?php foreach($detail['thumbs'] as $thumb): ?>
                            <img src="<?=$thumb ?>" class="img-rounded" alt="Image" width="200">
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="thumbs" class="col-sm-2 control-label">缩略图</label>
                    <div class="col-sm-10">
                        <input type="file" name="" id="thumbs" accept="image/*" multiple>
                        <p class="help-block">限1至2张，若有两张，第一张默认显示在首页</p>
                    </div>
                </div>
                <?php if(isset($detail)): ?>
                    <div class="form-group">
                    <label for="" class="col-sm-2 control-label">原图片</label>
                    <div class="col-sm-10">
                        <?php foreach($detail['pics'] as $pics): ?>
                            <img src="<?=$pics ?>" class="img-rounded" alt="Image" width="200">
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="pics" class="col-sm-2 control-label">图片</label>
                    <div class="col-sm-10">
                        <input type="file" name="" id="pics" accept="image/*" multiple>
                    </div>
                </div>
                <div class="form-group">
                    <label for="goods_content" class="col-sm-2 control-label">商品详情</label>
                    <div class="col-sm-10">
                        <textarea name="goods_content" id="goods_content" style="height:400px"><?=$detail['goods_content'] ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                    <?php if(isset($detail)): ?>
                        <input type="hidden" name="id" value="<?=$detail['id'] ?>">
                    <?php endif; ?>
                        <button type="submit" class="btn btn-primary">下一步</button>
                    </div>
                </div>
        </form>
        <?php if(isset($detail)): ?>
                        <form action="<?=U('addProductStep2') ?>" method="post">
                            <input type="hidden" name="id" value="<?=$detail['id'] ?>">
                            <input type="hidden" name="cate_id" value="<?=$detail['cate_id'] ?>">
                            <input type="hidden" name="action" value="pass">
                            <button type="submit" class="btn btn-primary col-sm-offset-3" style="position:relative;top:-49px;">跳过</button>
                        </form>
        <?php endif; ?>

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
        $.get("<?=U('addProduct') ?>",{"cate_id":id},function(e){
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
var pics         = new Array(); // 上传的图片
var thumbs       = new Array();
var pics_count   = {"index":0}; // 上传图片计数
var thumbs_count = {"index":0};
//初始化fileinput控件
function file_input_init(ctrlName, uploadUrl, save_var, save_count) 
{
    var control = $('#' + ctrlName);
    control.fileinput({
        uploadUrl: uploadUrl, //上传的地址
        allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀
        showPreview : true,
        showUpload: true, //是否显示上传按钮
        showCaption: false,//是否显示标题
        initialPreviewShowDelete : false,
        maxFileCount : 5,
    });
    //上传后的回调
    control.on('fileuploaded',function(event,data,previewId,index){
        save_var[save_count.index] = data.response;
        save_count.index+=1;
    });
}
$('#form-add').submit(function(event){
    if(pics_count.index == 0) {layer.alert('未上传图片',{skin:"layui-layer-lan"});return false;}
    if(thumbs_count.index == 0) {layer.alert('未上传缩略图',{skin:"layui-layer-lan"});return false;}
    for(var i in pics){
        $(':submit').before('<input type="hidden" name="pics[]" value="'+pics[i]+'">');
    }
    for(var j in thumbs){
        $(':submit').before('<input type="hidden" name="thumbs[]" value="'+thumbs[j]+'">');
    }
    // return false;
    // event.preventDefault;
});
file_input_init('pics',"<?=U('ajaxUploadGoodsPics') ?>",pics,pics_count);
file_input_init('thumbs',"<?=U('ajaxUploadGoodsPics') ?>",thumbs,thumbs_count);

 <?=W('Widget/wangEditor',[['id'=>'goods_content']]) ?>
</script>
</body>
</html>