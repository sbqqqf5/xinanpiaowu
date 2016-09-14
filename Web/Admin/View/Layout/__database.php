<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Disgner</title>   
        <!-- Bootstrap -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="http://cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <style type="text/css">
           body{margin:20px 30px;}
           .td-id,.td-status,.td-manage{text-align:center;}
        </style>
    </head>
    <body>
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="info">
                <th>ID</th>
                <th>标题</th>
                <th>职位</th>
                <th>发布公司</th>
                <th>发布时间</th>
                <th>当前状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <volist name="data" id="d">
            <tr>
                <td class="td-id">{$d.id}</td>
                <td>{$d.title}</td>
                <td>{$d.post}</td>
                <td>{$d.comp_post_name}</td>
                <td>{$d.time|date="Y-m-d",###}</td>
                <td class="td-status">
                    <eq name="d.status" value="1">
                        <span class="label label-success">发布中</span>
                    <else/>
                        <span class="label label-default">未发布</span>
                    </eq>
                </td>
                <td class="td-manage"><a href="{:U('recruitList',['action'=>'del','id'=>$d['id']])}">删除</a></td>
            </tr>
        </volist>
 
           
        </tbody>
    </table>
      
<!-- <div class="button"><button type="button" class="btn btn-primary">button</button></div> -->

        <!-- 如果要使用Bootstrap的js插件，必须先调入jQuery -->
        <script src="http://cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
        <!-- 包括所有bootstrap的js插件或者可以根据需要使用的js插件调用　-->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
        <!-- <script src="jquery.dataTables.min.js"></script> -->
        <script src="http://cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="http://cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

        <script type="text/javascript">
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
                        {"orderable":false,"targets":[-1]} // 不参与排序的列
                    ],
               });


            });
        </script>
    </body>
</html>