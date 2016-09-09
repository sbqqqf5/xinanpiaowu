<?php
namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
/**
 * [ajaxFileUpload description]
 * @param  string $path 保存路径，以 / 结尾
 * @return [type]       [description]
 */
    public function ajaxFileUpload($path)
    {
        $info = upload_img($path);
        if($info[0]){
            $result = $info[1];
        }else{
            $result = 0;
        }
        return $result;
    }
}