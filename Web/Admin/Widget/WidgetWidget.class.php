<?php
namespace Admin\Widget;

use Think\Controller;

class WidgetWidget extends Controller
{
/**
 * datetimepicker widget
 * @param  array $param ['id','label','formar']
 * @return [type]        [description]
 */
    public function datepicker($param)
    {
        $id          = $param['id'];
        $label       = $param['label'];
        $date_format = isset($param['format'])?$param['format']:'yyyy-mm-dd hh:ii';
        $datepicker = '<div class="form-group">
                <label for="'.$id.'" class="col-sm-2 control-label">'.$label.'</label>
                <div class="input-group date '.$id.' col-sm-3" data-date-format="'.$date_format.'" data-link-field="'.$id.'">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="'.$id.'" value="" /><br/>
            </div>';
        return $datepicker;
    }
/**
 * datetimepicker css
 * @return [type] [description]
 */
    public function datepickerCSS()
    {
        $css = '<link rel="stylesheet" type="text/css" href="/Public/admin/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css">';
        return $css;
    }
/**
 * datetimepicker scripts 
 * @return [type] [description]
 */
    public function datepickerSCRIPT()
    {
        $script =  '<script src="/Public/admin/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/Public/admin/bootstrap-datepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>';
        return $script;
    }
/**
 * datetimepicker js 初始化
 * @param  array $param ['startDate','endDate','minView']
 * @return [type]        [description]
 */
    public function datepickerJS($param)
    {
        $startDate = isset($param['startDate'])?"'startDate' : '".$param['startDate']."',":null;
        $endDate = isset($param['endDate'])?"'endDate' : '".$param['endDate']."',":null;
        $minView = isset($param['minView'])?(is_string($param['minView'])?"'".$param['minView']."'":$param['minView']):'\'hour\'';

        $js = "$('".$param['selector']."').datetimepicker({
            'language' : 'zh-CN',
            'weekStart' : 1,
            ".$startDate."
            ".$endDate."
            'autoclose' : true,
            'todayBtn' : 'link',
            'minView'  : ".$minView.",
            'todayHighlight' : true,
        });";
        return $js;
    }
/**
 * wangEditor js config
 * @param  string $editor_id 实例化的 ID
 * @return [type]            [description]
 */
    public function wangEditor($param)
    {
        $editor_id = $param['id'];
        $js = "wangEditor.config.printLog = false;
                var editor = new wangEditor('".$editor_id."')
                editor.config.uploadImgUrl = '/Public/admin/wangeditor/upload.php';

                editor.config.uploadHeaders = {
                    'Accept' : 'text/x-json'
                };

                editor.config.hideLinkImg = true;

                editor.onchange = function () {
                    
                };

                 // 其中的 wangEditor.config.menus 可获取默认情况下的菜单配置
                 editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
                     if (item === 'insertcode') return null; 
                     if (item === 'fullscreen') return null; 
                     if (item === 'video') return;
                     if (item === 'location') return;
                     if (item === 'source') return;
                     if (item == 'link') return;
                     if (item == 'unlink') return;
                     return item;
                 });

                editor.create()";
            return $js;
    }
/**
 * 确认删除 modal 
 * @param  array $param [description]
 * @return [type]        [description]
 */
    public function deleteModal($param)
    {
        $id = $param['id'];
        $content = '<div class="modal fade " id="'.$id.'">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">警告</h4>
                    </div>
                    <div class="modal-body">
                        确定要删除吗？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="fn_confirm_delete(\''.$id.'\')">删除</button>
                    </div>
                </div>
            </div>
        </div> <!-- /modal #item-delete -->';
        return $content;
    }
/**
 * datatables bootstrap script
 * @return [type] [description]
 */
    public function dataTablesScript()
    {
        $script = '<script src="http://cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="http://cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>';
        return $script;
    }
/**
 * datatables bootstrap css
 * @return [type] [description]
 */
    public function dataTablesCss()
    {
        $css = '<link rel="stylesheet" href="http://cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css">';
        return $css;
    }
}