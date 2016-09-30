<?php
namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        if(session('admin_user') === null ){
            $this->redirect('/Login');
        }
    }
    /**
     * 登出
     * @return 重定向
     */
    public function logout()
    {
        session('admin_user', null);
        $this->redirect('/Login');
    }
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
    /**
     * 微信退款
     * @param  string $out_refund_no 退款单号
     * @param  string $order_num     商户订单号
     * @param  int    $total_fee     订单金额 单位：分
     * @return array                [return_code, return_msg]
     */
    protected function wechatRefund(string $out_refund_no, string $order_num, int $total_fee)
    {
        $import = import('Vendor.WxPay.lib.WxPay#Api', '', '.php');
        $WxPayApi = new \WxPayApi();
        $inputObj = new \WxPayRefund();

        $inputObj->SetOut_refund_no($out_refund_no);// 退款单号
        $inputObj->SetOut_trade_no($order_num); // 商户订单号
        $inputObj->SetTotal_fee($total_fee); // 订单金额 100分
        $inputObj->SetRefund_fee($total_fee); // 退款金额 100 分
        $inputObj->SetOp_user_id(WECAHT_MCHID); // 商户号

        $xml    = $WxPayApi::refund($inputObj, 10); // 请求退款
        return $inputObj->FromXml($xml);
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

    public function getExpressCode()
    {
        $num = '3314542172660';
        $key = C('EXPRESS_KEY');
        $code = get_express_code($num, $key);

        // $order = express_info_order($code, $num);
        $order = express_query($code, $num);
        dump($order);
    }

    public function postTocallback()
    {
        $url = 'test5.fengniaozhiku.com/expresscallback2';
        $data = '{"status":"ok"}';
        // $header = 'Content-type: text/xml';
        $ch = curl_init(); //初始化curl 
        curl_setopt($ch, CURLOPT_URL, $url);//设置链接 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息 
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//设置HTTP头 
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//POST数据 
        $response = curl_exec($ch);//接收返回信息 
        if(curl_errno($ch)){//出错则显示错误信息 
        print curl_error($ch); 
        } 
        curl_close($ch); //关闭curl链接 
        echo $response;//显示返回信息
    }
}