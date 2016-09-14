<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <link rel="stylesheet" href="/Public/admin/bootstrap_fileinput/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/admin/wangeditor/dist/css/wangEditor.min.css">
    <?=W('Widget/datepickerCss') ?>
    <style type="text/css">
        .datetimepicker,.datetimepicker-help-block{padding-left: 15px !important;}
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
                <li><a href="<?=U('index') ?>">商品列表</a></li>
                <li class="active">添加商品</li>
            </ol>
            </div>
        </div>
        
        <form action="<?=U('add') ?>" method="POST" role="form" class="form-horizontal">
            <legend>添加门票</legend>
        
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="title" class="form-control" required="required">
                </div>
            </div>

            <div class="form-group">
                <label for="is_order" class="col-sm-2 control-label">是否预订</label>
                <div class="col-sm-10 checkbox">
                    <label>
                        <input type="checkbox" name="is_order" id="is_order" value="1" >
                        预订
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="is_home" class="col-sm-2 control-label">是否显示在首页</label>
                <div class="col-sm-10 checkbox">
                    <label>
                        <input type="checkbox" name="is_home" id="is_home" value="1">
                        显示
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSorted" class="col-sm-2 control-label">排序值</label>
                <div class="col-sm-10">
                    <input type="number" name="sorted" id="inputSorted" class="form-control" required placeholder="值越大，排列越前">
                </div>
            </div>
            <div class="form-group">
                <label for="deposit" class="col-sm-2 control-label">预订订金</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" name="deposit" id="deposit" class="form-control">
                        <div class="input-group-addon">&yen;</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="distribute_price" class="col-sm-2 control-label">分享提成</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" name="distribute_price" id="distribute_price" class="form-control">
                        <div class="input-group-addon">&yen;</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="venues" class="col-sm-2 control-label">场馆</label>
                <div class="col-sm-10">
                    <input type="text" name="venues" id="venues" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputColumn" class="col-sm-2 control-label">栏目</label>
                <div class="col-sm-2">
                    <select name="column" id="inputColumn" class="form-control" required="required">
                    <?php foreach($columns as $column): ?>
                        <option value="<?=$column['id'] ?>"><?=$column['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">城市</label>
                <div class="col-sm-2">
                    <select name="city" id="city" class="form-control" required="required">
                    <?php foreach($cities as $city): ?>
                        <option value="<?=$city['id'] ?>"><?=$city['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCate" class="col-sm-2 control-label">类型</label>
                <div class="col-sm-2">
                    <select name="cate" id="inputCate" class="form-control" required="required">
                        <?php foreach ($cates as $cate): ?>
                            <option value="<?=$cate['id'] ?>"><?=$cate['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">价格</label>
                <div class="form-group">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon">位置</div>
                            <input type="text" name="view_location[]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon">价格</div>
                            <input type="number" name="price[]" class="form-control" required>
                            <div class="input-group-addon">&yen;</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon">会员价</div>
                            <input type="number" name="vip_price[]" class="form-control" required>
                            <div class="input-group-addon">&yen;</div>
                        </div>
                    </div>
                </div>

                <!-- 价格  添加块 -->
                <!-- <label  class="col-sm-2"></label>
                <div class="form-group">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon">位置</div>
                            <input type="text" name="view_location[]" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon">价格</div>
                            <input type="number" name="price[]" class="form-control" required>
                            <div class="input-group-addon">&yen;</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-addon">会员价</div>
                            <input type="number" name="vip_price[]" class="form-control" required>
                            <div class="input-group-addon">&yen;</div>
                        </div>
                    </div>
                </div> --><!-- ./价格  添加块 -->

                <p class="help-block col-sm-offset-2 datetimepicker-help-block">
                    <button type="button" class="btn btn-sm btn-primary" onclick="price_block_add(this)">添加一行</button>
                    <button type="button" class="btn btn-sm btn-default" onclick="price_block_delete(this)">删除上一行</button>
                </p>
            </div>

            <div class="form-group">
                <label for="time-1" class="col-sm-2 control-label">演出时间</label>
                <div class="input-group date datetimepicker col-sm-3" data-date-format="yyyy-mm-dd hh:ii" data-link-field="time-1" >
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="time-1" name="performance_time[]" >

                <p class="help-block datetimepicker-help-block col-sm-offset-2">
                    <button type="button" class="btn btn-primary btn-sm" onclick="time_block_add(this)">添加一个时间</button>
                    <button type="button" class="btn btn-sm btn-default" onclick="time_block_delete(this)">删除上一行</button>
                </p>
            </div>

            <div class="form-group">
                <label for="inventory" class="col-sm-2 control-label">库存</label>
                <div class="col-sm-10">
                    <input type="text" name="inventory" id="inventory" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="performance_duration" class="col-sm-2 control-label">演出时长</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" name="performance_duration" id="performance_duration" class="form-control" value="" required>
                        <div class="input-group-addon">小时</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="entry_time" class="col-sm-2 control-label">入场时间</label>
                <div class="col-sm-10">
                    <input type="text" name="entry_time" id="entry_time" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="limit_explain" class="col-sm-2 control-label">限购说明</label>
                <div class="col-sm-10">
                    <input type="text" name="limit_explain" id="limit_explain" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="child_explain" class="col-sm-2 control-label">儿童入场说明</label>
                <div class="col-sm-10">
                    <input type="text" name="child_explain" id="child_explain" class="form-control" required >
                </div>
            </div>

            <div class="form-group">
                <label for="should_known" class="col-sm-2 control-label">购票须知</label>
                <div class="col-sm-10">
                    <textarea name="should_known" id="should_known" class="form-control" rows="8" required="required"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="home_thumb" class="col-sm-2 control-label">首页缩略图</label>
                <div class="col-sm-10">
                    <input type="file" name="" id="home_thumb" accept="image/*">
                    <input type="hidden" name="home_thumb">
                </div>
            </div>
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">列表缩略图</label>
                <div class="col-sm-10">
                    <input type="file" id="thumb" accept="image/*">
                    <input type="hidden" name="thumb">
                </div>
            </div>

            <div class="form-group">
                <label for="detail" class="col-sm-2 control-label">商品详情</label>
                <div class="col-sm-10">
                    <textarea name="detail" id="detail" style="height:400px"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary col-sm-offset-2">保存</button>
        </form>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput.min.js"></script>
<script src="/Public/admin/bootstrap_fileinput/js/fileinput_locale_zh.js"></script>
<?=W('Widget/datepickerSCRIPT') ?>
<script src="/Public/admin/wangeditor/dist/js/wangEditor.min.js"></script>
<script>
/* datetimepick init */
    function datatimepicker_init()
    {
        $('.input-group.datetimepicker').datetimepicker({
            'language' : 'zh-CN',
            'weekStart' : 1,
            'startDate' : '<?=date('Y-m-d') ?>',
            'autoclose' : true,
            'todayBtn' : 'link',
            'minView'  : 'hour',
            'todayHighlight' : true,
        });
    }
    datatimepicker_init();

    var time_block_count = 1;
    /* 开始时间 添加输入块 */
    function time_block_add(obj)
    {
        time_block_count++;
        var ele = '<div class="input-group date datetimepicker col-sm-offset-2 col-sm-3" data-date-format="yyyy-mm-dd hh:ii" data-link-field="time-'+time_block_count+'">\
                    <input class="form-control" size="16" type="text" value="" readonly>\
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>\
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>\
                </div>\
                <input type="hidden" id="time-'+time_block_count+'" name="performance_time[]" >';
        $(obj).parent().before(ele);
        datatimepicker_init();
    }
    /* 开始时间 删除输入块 */
    function time_block_delete(obj)
    {
        if(time_block_count==1){return;}
        time_block_count--;
        $(obj).parent().prev().remove();
        $(obj).parent().prev().remove();
        $('.datetimepicker.dropdown-menu:last').remove();
    }

    /* 添加 价格输入组 */
    var price_block_count = 1;
    function price_block_add(obj)
    {
        price_block_count ++ ;
        var ele = '<label  class="col-sm-2"></label>\
                <div class="form-group">\
                    <div class="col-sm-3">\
                        <div class="input-group">\
                            <div class="input-group-addon">位置</div>\
                            <input type="text" name="view_location[]" class="form-control" required>\
                        </div>\
                    </div>\
                    <div class="col-sm-3">\
                        <div class="input-group">\
                            <div class="input-group-addon">价格</div>\
                            <input type="number" name="price[]" class="form-control" required>\
                            <div class="input-group-addon">&yen;</div>\
                        </div>\
                    </div>\
                    <div class="col-sm-3">\
                        <div class="input-group">\
                            <div class="input-group-addon">会员价</div>\
                            <input type="number" name="vip_price[]" class="form-control" required>\
                            <div class="input-group-addon">&yen;</div>\
                        </div>\
                    </div>\
                </div>';
            $(obj).parent().before(ele);
    }
    /* 删除 价格输入组 */
    function price_block_delete(obj)
    {
        if(price_block_count == 1){return false;}
        price_block_count -- ;
        $(obj).parent().prev().remove();
        $(obj).parent().prev().remove();
    }

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
        maxFileCount : 1,
    });
    //上传后的回调
    control.on('fileuploaded',function(event,data,previewId,index){
        $('input:hidden[name='+ctrlName+']').val(data.response);
    });
}
file_input_init('home_thumb',"<?=U('ajaxUploadTicketHomeThumb') ?>");
file_input_init('thumb',"<?=U('ajaxUploadTicketThumb') ?>");

 <?=W('Widget/wangEditor',[['id'=>'detail']]) ?>
          // 获取编辑器区域完整html代码
    var html = editor.$txt.html();
</script>
</body>
</html>