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
        $this->assign([
            'orderInfo'       => $orderInfo, // 订单信息
            'userInfo'        => $userInfo, // 用户信息
            'goodsInfo'       => $goodsInfo, // 商品信息
            'goodsProperties' => $properties, // 商品规格 
            'orderStatus'     => $modelOrder::$orderStatus, // 订单状态
            'deliveryStatus'  => $modelOrder::$deliveryStatus, // 发货状态
            'orderType'       => $modelOrder::$orderType, // 订单类别
            'payStatus'       => $modelOrder::$payStatus, // 支付状态
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
        $this->ajaxReturn($ans);
    }
/**
 * 退货列表
 * @return [type] [description]
 */
    public function returnList()
    {
        $this->assign([
            'data' => D('ReturnGoods')->getAll(),
        ]);
        $this->display();
    }
}