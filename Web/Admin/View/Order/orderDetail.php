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
                    <a href="javascript:;">订单管理</a>
                </li>
                <li class="active">订单详情</li>
            </ol>
            </div>
        </div>
        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">基本信息</div>
            <!-- Table -->
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>订单ID</th>
                        <th>订单号</th>
                        <th>会员</th>
                        <th>电话</th>
                        <th>应付</th>
                        <th>订单状态</th>
                        <th>下单时间</th>
                        <th>支付时间</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">收货信息</div>        
            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>收货人</th>
                        <th>联系方式</th>
                        <th>地址</th>
                        <th>地址</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">商品信息</div>        
            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>商品</th>
                        <th>规格</th>
                        <th>数量</th>
                        <th>单价（普通）</th>
                        <th>单价（会员）</th>
                        <th>单号小计</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                    </tr>

                    <tr>
                        <td colspan="5" style="text-align: right;">小计：</td>
                        <td>100.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">费用信息</div>        
            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>小计</th>
                        <th>使用订金</th>
                        <th>使用积分</th>
                        <th>积分抵扣</th>
                        <th>应付</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                        <td>Content 1</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">操作</div>        
            <!-- Table -->
            <div class="">
                <button type="button" class="btn btn-success">button</button>
                <a class="btn btn-info" href="<?=U('index') ?>" role="button">返回</a>
            </div>
        </div>
    </div> <!-- /page-inner -->
</div> <!-- /page-wrapper -->
</div> <!-- /wrapper -->
<?php require __DIR__.'/../Layout/_script.php' ?>
</body>
</html>