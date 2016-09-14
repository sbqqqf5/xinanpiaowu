<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
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
                <li class="active">推广说明图</li>
            </ol>
            </div>
        </div>
        
        <form action="<?=U('promotion') ?>" method="POST" role="form">
            <legend>个人中心——推广说明图片</legend>
        
            <div class="form-group">
                <img src="<?=$data ?>" alt="图片不存在，点击上传" class="img-rounded" id="img" width="600" onclick="$('#file').click()" style="cursor:pointer">
                <input type="hidden" name="content" value="" id="input">
                <input type="file" name="file" id="file" onchange="handleFiles(this.files,'file','img','input')" style="display:none;">
                <p class="help-block">点击图片重新上传</p>
            </div>     
            
        
            <button type="submit" class="btn btn-primary">更新</button>
        </form>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
<script src="/Public/admin/assets/js/ajaxfileupload.js"></script>
<script>
    /* 上传缩略图 */
//onchange="handleFiles(this.files)"
function handleFiles(files,fileID,picID,hiddenID){
    console.log(picID)
    var file = files[0];  //从文件对象中获取到第一个
    if(!file){return;}
    var reader = new FileReader(); 
    var index = layer.load(); 
    reader.onload = (function(img){
        return function(e){
            if(picID){
                $("#"+picID).attr('src', e.target.result );  
            }
        };
    })(file);
    reader.readAsDataURL(file);
    $.ajaxFileUpload({
        url : "<?=U('promotionUpload') ?>",
        type : 'post',
        secureuri : false,
        fileElementId : fileID,
        dataTpye: 'json',
        error : function(e){
            layer.close(index);
            layer.alert('缩略图上传失败！');
        },
        success : function(ans){
            layer.close(index);
            if(ans == 0){
                layer.alert('上传失败',{skin:"layui-layer-lan"});
            }else{
                var imgpath = $(ans).text();
                $('#'+hiddenID).val(imgpath);
            }
        },
    });
};
</script>
</body>
</html>