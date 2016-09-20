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
        if(IS_GET && 'search' == I('get.action')){
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
        $order_id = I('get.order_id');
        $this->display();
    }
/**
 * 发货单列表 未发货的订单
 * @return [type] [description]
 */
    public function deliveryList()
    {
        $this->assign([
            'data' => D('Order')->getDeliveryAll(),
        ]);
        $this->display();
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