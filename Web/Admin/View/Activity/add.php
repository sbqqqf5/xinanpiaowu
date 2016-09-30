<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <?=W('Widget/datepickerCSS') ?>
    <style type="text/css">
        .form-group .datetimepicker{padding-left: 14px;}
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
                    <a href="javascript:;">活动管理</a>
                </li>
                <li class="active">添加活动</li>
            </ol>
            </div>
        </div>
        
        <form onsubmit="return false;" method="POST" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="inputGoods_type" class="col-sm-2 control-label">活动类别</label>
                <div class="col-sm-5">
                    <select name="goods_type" id="inputGoods_type" class="form-control" required="required" onchange="load_pre_type(this)">
                        <option value="">请选择</option>
                        <option value="1">门票</option>
                        <option value="2">周边商品</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="pre-type" class="col-sm-2 control-label">商品类别</label>
                <div class="col-sm-5">
                    <select id="pre-type" class="form-control" required="required" onchange="load_goods(this)">
                        <option value="">请选择</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputGoods_id" class="col-sm-2 control-label">选择商品</label>
                <div class="col-sm-5">
                    <select name="goods_id" id="inputGoods_id" class="form-control" required="required" >
                        <option value="">请选择</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="begin-time" class="col-sm-2 control-label">开始时间</label>
                <div class="input-group date datetimepicker col-sm-3" data-date-format="yyyy-mm-dd hh:ii" data-link-field="begin-time" >
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="begin-time" name="begin_time" >
            </div>
            <div class="form-group">
                <label for="end-time" class="col-sm-2 control-label">结束时间</label>
                <div class="input-group date datetimepicker end-time col-sm-3" data-date-format="yyyy-mm-dd hh:ii" data-link-field="end-time" >
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="end-time" name="end_time" >
            </div>
            <div class="form-group">
                <label for="inputCount_limit" class="col-sm-2 control-label">活动数量</label>
                <div class="col-sm-5">
                    <input type="number" name="count_limit" id="inputCount_limit" class="form-control" min="10" max="1000000" step="1" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPerson_limit" class="col-sm-2 control-label">每人限购数量</label>
                <div class="col-sm-5">
                    <input type="number" name="person_limit" id="inputPerson_limit" class="form-control"  min="1" max="100" step="1" required="required" value="10">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<?=W('Widget/datepickerSCRIPT') ?>
<script>
<?php 
echo 'var ticket_types = ',$ticketType, ";\n";
echo 'var goods_types  = ',$goodsType, ";\n";
 ?>
 var current_type = 0; // 当前操作的活动类别
 $(function(){
    $('.input-group.datetimepicker').datetimepicker({
        'language' : 'zh-CN',
        'weekStart' : 1,
        'startDate' : '<?=date('Y-m-d') ?>',
        'autoclose' : true,
        'todayBtn' : 'link',
        'minView'  : 'hour',
        'todayHighlight' : true,
    });
    /** 提示结束时间的输入错误 */
    $('.end-time').on('changeDate', function(e){
        var end_time   = $('#end-time').val();
        var begin_time = $('#begin-time').val();
        if(end_time && end_time <= begin_time){
            layer.alert('结束时间选择有误', {icon:0})
        }
    })

    $('form').submit(function(){
        $.post("<?=U('add') ?>", $('form').serializeArray(), function(e){
            console.log(e)
            if(e[0]){
                layer.msg(e[1], {time:2000}, function(){
                    location.href = "<?=U('index') ?>";
                })
            }else{
                if('object' == typeof e[1]){
                    var content = '<div style="padding:30px 50px;color:#fff;background-color:#ff5140">';
                    for(var i in e[1]){
                        content += '<p>'+e[1][i]+'</p>';
                    }
                    content += '</div>';
                    layer.open({
                        type:1,
                        title:false,
                        area: '400px',
                        content:content,
                    })

                }else{
                    layer.alert(e[1]);
                }
            }
        })
    })
 })
 /** 选择大类别 */
function load_pre_type(obj)
{
    var type = $(obj).val();
    switch(type){
        case '1' : load_pre_type_option(ticket_types);current_type = 1;break;
        case '2' : load_pre_type_option(goods_types); current_type = 2;break;
    }
}
/** 加载小类别 */
function load_pre_type_option(obj)
{
    var $selectEle = $('#pre-type');
    var ele = '<option>请选择</option>';
    for(var i in obj){
        ele += '<option value="'+i+'">'+obj[i]+'</option>';
    }
    $selectEle.html(ele);
}
/** 加载商品信息 */
function load_goods(obj)
{
    var cate = $(obj).val();
    if(cate){
        var data = {cate:cate, type:current_type};
        var ele = '<option>请选择</option>';
        $.get("<?=U('queryInfo') ?>", data, function(e){
            if(e){
                for(var i in e){
                    ele += '<option value="'+e[i].id+'">'+e[i].name+'</option>';
                }
                $('#inputGoods_id').html(ele);
            }
        })
    }
}
</script>
</body>
</html>