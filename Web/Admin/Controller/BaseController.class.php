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
/**
 * 发送短信
 * @param  string $content 消息内容
 * @param  string $phone   手机号
 * @return bool
 */
    protected function _sendMsg($content,$phone)
    {
        $msg = iconv( "UTF-8", "gb2312" , $content);

        $url = "http://yzm.mb345.com/ws/BatchSend2.aspx?CorpID=CDLK00073&Pwd=ss1103@&Mobile={$phone}&Content={$msg}&SendTime=&cell=";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        curl_close($ch);
        if($output>0){
            return true;
        }else{
            return false;
        }
    }
/**********测试   添加一条订单************/
    protected function addOrder()
    {
        $add = ['order_sn'=>'11111', 'order_type'=>2, 'user_id'=>1, 'consignee'=>'阿妹', 
            'address'=>'详细地址', 'phone'=>'13412333212', 'goods_price'=>100];
        $model->add($add);
    }
/********测试 添加一个用户 ****************/
    protected function addUser()
    {
        $add = [];
        M('user')->add($add);
    }

    protected function addOrderGoods()
    {
        $data = ['order_id'=>1, 'goods_type'=>2, 'goods_num'=>1, 'goods_id'=>8, 
                'spec_key_name'=>'2_0+3_0', 'goods_price'=>80, 'vip_goods_price'=>70];
        M('OrderGoods')->add($data);
    }
}