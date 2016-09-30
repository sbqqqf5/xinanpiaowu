<?php
namespace Admin\Controller;

use Think\Controller;

class OrderController extends BaseController
{
/**
 * 订单列表
 * @return [type] [description]
 */
    public function index()
    {
        $model = D('Order');
        $where = [];
        if(IS_GET && 'search' == I('get.action')){ // 筛选
            if($begin = I('get.begin')){
                $where['create_at'] = ['EGT', $begin];
            }
            if($end = I('get.end')){
                $where['create_at'] = ['ELT', $end];
            }
            if(($orderType = I('get.order_type')) >= 0){
                $where['order_type'] = $orderType;
            }
            if(($payStatus = I('get.pay_status')) >= 0){
                $where['pay_status'] = $payStatus;
            }
            if(($deliveryStatus = I('get.delivery_status')) >= 0){
                $where['delivery_status'] = $deliveryStatus;
            }
            if(($orderStatus = I('get.order_status')) >= 0){
                $where['order_status'] = $orderStatus;
            }
        }

        $this->assign([
            'data'           => $model->getAll($where),
            'orderStatus'    => $model::$orderStatus, // 订单状态
            'deliveryStatus' => $model::$deliveryStatus, // 发货状态
            'orderType'      => $model::$orderType, // 订单类别
            'payStatus'      => $model::$payStatus, // 支付状态
        ]);
        $this->display();
    }
/**
 * 订单列表操作
 * @return [type] [description]
 */
    public function orderHandle()
    {
        $model = D('Order');
        if(IS_POST){
            $action = I('post.action');
            if('delete' == $action){// 删除订单
                $this->ajaxReturn( $model->deleteOrder(I('post.order_id')) );
            }
        }
    }
/**
 * 查看订单详情
 * @return view 
 */
    public function orderDetail()
    {
        $order_id   = I('get.order_id');
        $modelOrder = D('Order');
        $orderInfo  = $modelOrder->getOne($order_id);
        $userInfo   = D('User')->getOneUseInOrderDetail($orderInfo['user_id']);
        $goodsInfo  = D('OrderGoods')->getOneByOrderId($orderInfo['order_id'], $orderInfo['order_type']);
        // dump($goodsInfo);
        $key_name = $goodsInfo[0]['spec_key_name'];
        if($key_name){//商品存在规格 
            $properties = D('ProductProperty')->getInfoByKeyName($key_name);
        }else{ // 不存在规格 
            $properties = false;
        }

        $expresses = M('AllowedExpress')->where('status=1')->order('sorted desc')->select();

        $this->assign([
            'orderInfo'       => $orderInfo, // 订单信息
            'userInfo'        => $userInfo, // 用户信息
            'goodsInfo'       => $goodsInfo, // 商品信息
            'goodsProperties' => $properties, // 商品规格 
            'orderStatus'     => $modelOrder::$orderStatus, // 订单状态
            'deliveryStatus'  => $modelOrder::$deliveryStatus, // 发货状态
            'orderType'       => $modelOrder::$orderType, // 订单类别
            'payStatus'       => $modelOrder::$payStatus, // 支付状态
            'expresses'       => $expresses, // 快递公司
        ]);
        $this->display();
    }
/**
 * 发货单列表 未发货的订单
 * @return [type] [description]
 */
    public function deliveryList()
    {
        
        $data = D('Order')->getDeliveryAll($where);
        $this->assign([
            'data' => $data,
        ]);
        $this->display();
    }
/**
 * 订单发货
 * @return ajax array
 */
    public function delivery()
    {
        $ans = D('Order')->actionDelivery($_POST);
        
        // 订阅快递信息
        $expressName = $_POST['express'];
        $expressCode = M('AllowedExpress')->where(['name'=>$expressName])->getField('code');
        // express_info_order($expressCode,$_POST['express_code']); 

        $this->ajaxReturn($ans);
    }
/**
 * 退货列表
 * @return [type] [description]
 */
    public function returnList()
    {
        $modal = D('ReturnGoods');
        $data = $modal->getAll();
        if(IS_POST){
            $action = I('post.action');
            $id     = I('post.id');
            if('delete' == $action){
                $this->ajaxReturn($modal->deleteOne($id));
            }
        }

        $this->assign([
            'data'   => $data,
            'status' => $modal::$status,
        ]);
        $this->display();
    }
/**
 * 退换货详情
 * @return view 
 */
    public function returnGoodsDetail()
    {
        $id = I('get.id');
        $modal = D('ReturnGoods');
        if(IS_POST){
            $this->ajaxReturn($modal->updateOne(I('post.')));
        }
        $detail = $modal->getReturnGoodsDetail($id);
        $this->assign([
            'detail' => $detail,
            'status' => $modal::$status,
        ]);
        $this->display();
    }
/**
 * 退款 退积分给用户 
 * @return [type] [description]
 */
    public function handleRefund()
    {
        if(IS_POST){
            $modal     = D('RefundLog');
            $user_id   = I('post.user_id');
            $order_id  = I('post.order_id'); // 订单ID
            $order_num = I('post.order_num'); // 订单编号
            $orderInfo = M('Order')->field('order_id,order_sn,use_integral,order_amount')->find($order_id);
            $_POST['integral'] = $orderInfo['use_integral'];
            $_POST['money']    = $orderInfo['money'];

            // 写表 
            $insert = $modal->addOne($_POST);
            if($insert[0]){
                if($orderInfo['money']){// 微信退款
                    $money = intval($orderInfo['money'])*100; 
                    // 退款
                    $refundInfo = $this->wechatRefund($insert[1], $order_num, $money);
                    $this->ajaxReturn([true, $refundInfo['return_msg']]);
                }else{
                    
                    $this->ajaxReturn([true, $insert[1]]);
                }
            }else{
                $this->ajaxReturn([false, $insert[1]]);
            }
        }
    }
}