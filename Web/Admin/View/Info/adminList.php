<!DOCTYPE html>
<html lang="en">
<head>
    <?php require __DIR__.'/../Layout/_css.php' ?>
    <style type="text/css">
        .td-manage span{cursor:pointer;margin-left:5px;margin-right:5px;}
        .td-manage a{text-decoration: none;}
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
                    <a href="javascript:;">网站管理</a>
                </li>
                <li class="active">管理员列表</li>
            </ol>
            </div>
        </div>
        
        <a class="btn btn-primary" data-toggle="modal" href='#modal-add' style="margin-bottom: 20px;"><i class="fa fa-user-plus" aria-hidden="true"></i> 添加用户</a>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">用户名</th>
                    <th class="text-center">上次登录时间</th>
                    <th class="text-center">上次登录IP</th>
                    <th class="text-center">登录次数</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $v): ?>
                <tr>
                    <td class="text-center"><?=$v['id'] ?></td>
                    <td class="text-center"><?=$v['user'] ?></td>
                    <td class="text-center"><?=date('Y-m-d H:i:s',$v['last_login_time']) ?></td>
                    <td class="text-center"><?=$v['last_login_ip'] ?></td>
                    <td class="text-center"><?=$v['login_times'] ?></td>
                    <td class="td-manage text-center">
                    <a href="javascript:;" onclick="item_edit(this,<?=$v['id'] ?>)">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="修改"></span></a>
                        <?php if($v['id'] != 1): ?>
                            <a href="javascript:;" onclick="item_del(this,<?=$v['id'] ?>)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="删除"></span></a> 
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->

<?=W('Widget/deleteModal',[['id'=>'item-delete']]) ?>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('adminList') ?>" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">修改密码</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <p class="form-control-static"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputOldpassword" class="col-sm-2 control-label">旧密码</label>
                        <div class="col-sm-10">
                            <input type="password" name="oldpassword" id="inputOldpassword" class="form-control" required="required" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">新密码</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" id="inputPassword" class="form-control" required="required" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRepassword" class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-10">
                            <input type="password" name="repassword" id="inputRepassword" class="form-control" required="required">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- ./modal-edit -->

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=U('adminList') ?>" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加用户</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUser" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" name="user" id="inputUser" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inPassword" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" id="inPassword" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputrePassword" class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-10">
                            <input type="password" name="repassword" id="inputrePassword" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__.'/../Layout/_script.php' ?>

<script>
    $(function(){
        $('.td-manage span').tooltip();

        $('#modal-add form').submit(function(event){
            $('#modal-add form input').parent().each(function(){
                if($(this).hasClass('has-error')){
                    event.preventDefault();
                    return false;
                }
            });
        });
        /* user blur */
        $('#inputUser').blur(function(){
            var length = $(this).val().length;
            if(length <= 30 && length >= 3){
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');
            }else{
                $(this).parent().removeClass('has-success');
                $(this).parent().addClass('has-error');
            }
        }); // #inputUser
        $('#inPassword').blur(function(){
            var length = $(this).val().length;
            if(length <= 13 && length >= 6){
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');
            }else{
                $(this).parent().removeClass('has-success');
                $(this).parent().addClass('has-error');
            }
        }); // #inPassword
        $('#inputrePassword').blur(function(){
            var length = $(this).val().length;
            var repassword = $(this).val();
            var password = $('#inPassword').val();
            if(length <= 13 && length >= 6 && repassword==password){
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');
            }else{
                $(this).parent().removeClass('has-success');
                $(this).parent().addClass('has-error');
            }
        }); // #inputrePassword
    });

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
    $.post("<?=U('adminList') ?>",{"id":cur_id,"action":'del'},function(e){
        $('#'+modal_id).modal('hide');
        if(e){
            $cur_tr.remove();
        }else{
            layer.alert('操作失败',{skin:"layui-layer-lan"});
        }
    });
}
/* 编辑 */
function item_edit(obj,id)
{
    $cur_tr = $(obj).parents('tr');
    cur_id  = id;
    $.get("<?=U('adminList') ?>",{"id":cur_id},function(e){
        var $modal = $('#modal-edit');
            $modal.find(':hidden[name="id"]').val(e.id)
            $modal.find('.form-control-static').text(e.user)
        $modal.modal('show');
    });
}
</script>
</body>
</html>