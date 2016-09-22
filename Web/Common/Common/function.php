<?php
/**
 * 实例化MModel
 * @param  string $tableName [description]
 * @return object            [description]
 */
function mm($tableName){
    $ob = new \Common\Model\MModel($tableName);
    return $ob;
}



/**
 * 时间戮个性化
 * @param  [type] $time [description]
 * @return [type]       [description]
 */
function personalTimeFormat($time){
    $DATE_OB = new \Org\Util\Date;
    $time = date("Y-m-d H:i:s",$time);
    return $DATE_OB->timeDiff($time);
}

/**
 * 初始化分页类
 * @param int  $totalRows  总计录条数
 * @param integer $listRows   每页显示条数 默认20
 * @param integer $rollPage   分页栏显示页数 默认10
 * @param boolean $lastSuffix 最后一页是否显示总页数 默认false不显示
 * @param mixed  $parameter  链接带参数
 * @return Page 对象
 */
function set_page($totalRows, $listRows=20,$rollPage=10,$lastSuffix=false,$parameter=null){
    $Page = new Think\Page($totalRows, $listRows);
    $Page->setConfig('prev','上一页');
    $Page->setConfig('next','下一页');
    $Page->setConfig('first','首页');
    $Page->setConfig('last','尾页');
    $Page->rollPage = $rollPage;  // 分页栏每页显示的页数
    $Page->lastSuffix = $lastSuffix; // 最后一页是否显示总页数
    $Page->parameter = $parameter; // 分页跳转时要带的参数

    return $Page;
}

/**
 * 图片上传，自动获取文件
 * @param  string $rootPath 上传根路径，默认为 ./Uploads/
 * @param  string $path     上传文件保存目录，以 / 结尾
 * @return array           [boolean,string error|info]
 */
function upload_img($path=null,$rootPath = './Uploads/'){
    if(!$path) return array(false,'输入上传路径，以/结尾');
    if(!is_dir($rootPath)) $mkdir = mkdir($rootPath);
    if(isset($mkdir) && !$mkdir) return array(false,'目录创建失败，可能没有权限');
    $config = array(
        'maxSize'  => 1024*1024*10,
        'rootPath' => $rootPath,
        'savePath' => $path,
        'exts'  => 'png,jpg,jpeg,gif,bmp',
    );
    $Upload = new \Think\Upload($config);
    $info = $Upload->upload();
    if(!$info){
        return array(false,$Upload->getError());
    }else{
        $info = array_values($info);
        $imgname = substr($rootPath,1).$info[0]['savepath'].$info[0]['savename'];
        return array(true,$imgname);
    }
}

/**
 * 图片缩放处理 默认等比例缩放
 * @param  string  $file     原文件名
 * @param  int     $width    缩放后的最小宽
 * @param  int     $height   缩放后的最小高
 * @param  string  $savename 保存的文件名
 * @param  integer $config   缩放参数 1-等比（默认） 2-填充 3-居中裁剪 
 * 4-左上角裁剪 5-右下角裁剪 6-固定尺寸缩放
 * @return mixed            object | false
 */
function img_thumb(string $file,int $width,int $height,string $savename=null,$config = 1 ){
    if($file && $width && $height){
        $Image = new \Think\Image();
        $Image->open($file);
        $OB = $Image->thumb($width,$height,$config);
        if($savename) $scop = $Image->save($savename);
        else return $OB;
        if(isset($scop)) return true;
    }else{
        return false;
    }
}

/**
 * 图片上传，手动传入文件
 * @param  [type] $path [description]
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
function upload_img_2($path,$name=null){
    if($path == ''){return '输入上传路径，以/结尾';}
    $config = array(
        'maxSize'   => 1024*1024*5,
        'savePath'  => $path,
        'exts'      => 'png,jpeg,jpg,gif,bmp',
    );
    $upload = new \Think\Upload($config);
    $info = $upload->upload();
    if(!$info){//上传不成功
        return false;
    }else{
        return '/Uploads/'.$info[$name]['savepath'].$info[$name]['savename'] ;
    }
}

function file_upload($path=null,$rootPath = './Uploads/'){
    if(!$path) return array(false,'输入上传路径，以/结尾');
    if(!is_dir($rootPath)) $mkdir = mkdir($rootPath);
    if(isset($mkdir) && !$mkdir) return array(false,'目录创建失败，可能没有权限');
    $config = array(
        'maxSize'  => 1024*1024*10,
        'rootPath' => $rootPath,
        'savePath' => $path,
        'exts'  => 'pdf,txt,doc,docx,ppt,pptx,xls,xlsx,pot,pps,vsd,rtf,wps,jpg,jpeg,png,gif',
    );
    $Upload = new \Think\Upload($config);
    $info = $Upload->upload();
    if(!$info) return array(false,$Upload->getError());
    else{
        return array(true,array_values($info));
    }
}


/**
 * 验证码验证
 * @param  [type] $code [description]
 * @param  string $id   [description]
 * @return [type]       [description]
 */
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * 图片裁剪
 * @param  string $file     图片资源名
 * @param  string $savename 保存名
 * @param  [type] $width    裁剪后宽度
 * @param  [type] $height   裁剪后高
 * @param  [type] $x        x
 * @param  [type] $y        y
 * @return null           null
 */
function img_crop(string $file,string $savename,$width,$height,$x=null,$y=null){
    $OBJ = new \Think\Image();
    $OBJ->open($file);
    // dump($OBJ);die;
    if($x!==null && $y!==null){
        $OBJ->crop($width,$height,$x,$y)->save($savename);
    }else{
        $OBJ->crop($width,$height)->save($savename);
    }
    return null;
}

/**
 * 文件下载
 * @param  string $file 文件名
 * @return [type]       [description]
 */
function download_file($file){
    if(is_file($file)){
        $length = filesize($file);
        // $type = mime_content_type($file);

        /*$finfo = finfo_open(FILEINFO_MIME_TYPE;
        $type = finfo_file($finfo,$file);
        finfo_close($finfo);*/

        $showname =  ltrim(strrchr($file,'/'),'/');
        header("Content-Description: File Transfer");
        // header('Content-type: ' . $type);
        header('Content-type: application/octet-stream' );
        header('Content-Length:' . $length);
         if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) { //for IE
             header('Content-Disposition: attachment; filename="' . rawurlencode($showname) . '"');
         } else {
             header('Content-Disposition: attachment; filename="' . $showname . '"');
         }
         readfile($file);
         exit;
     } else {
         exit('文件已被删除！');
     }
 }


 /********************
*@file - path to file
*/
function force_download($file)
{
    if ((isset($file))&&(file_exists($file))) {
        $basename = pathinfo($file)['basename'];
        header ( "Content-Type:application/force-download" );
        header ( "Content-Type:application/download" );
        header ( "Content-Transfer-Encoding:binary" );
        header("Content-length: ".filesize($file));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $basename . '"');
        readfile($file);
    } else {
        exit( "文件不存在" );
    }
}
/**
 * 生成随机字符串
 * @param  integer $length 字符串长度 默认6位
 * @param  boolean $type   是否加密 默认false
 * @return string          [description]
 */
function random_str($length = 6, $type = FALSE)
{
    $chars = "abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
    $str = "";
    for($i = 0; $i < $length; $i ++) {
        $str .= substr ( $chars, mt_rand ( 0, strlen ( $chars ) - 1 ), 1 );
    }
    if ($type == TRUE) {
        return strtoupper ( md5 ( time () . $str ) );
    } else {
        return $str;
    }
}