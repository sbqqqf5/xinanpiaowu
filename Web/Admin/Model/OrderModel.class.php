<?php
namespace Admin\Model;
use Think\Model\RelationModel;

class OrderModel extends RelationModel
{
    /**
     * 订单状态
     * @var array
     */
    public static $orderStatus = [1=>'未处理', 2=>'已发货', 3=>'已取消', 4=>'已完成'];
    /**
     * 发货状态
     * @var array
     */
    public static $deliveryStatus = [0=>'未发货', 1=>'已发货'];
    /**
     * 订单类别
     * @var array
     */
    public static $orderType = [1=>'门票', 2=>'商品'];
    /**
     * 支付状态
     * @var array
     */
    public static $payStatus = [0=>'未支付', 1=>'已支付'];

    protected $_link = [
        'User' => [
            'mapping_type' => self::HAS_ONE,
            'mapping_name' => 'user',
            'foreigh_key'  => 'user_id',
            'parent_key'   => 'user_id',
        ],
    ];
/**
 * 获取所有订单的基本信息
 * @param  array  $where [description]
 * @return [type]        [description]
 */
    public function getAll(array $where = [])
    {
        $field = ['order_id', 'order_sn', 'order_type', 'order_status', 'delivery_status', 
                    'pay_status', 'consignee', 'phone', 'goods_price', 'create_at'];
        $data = $this->field($field)
                     ->where($where)
                     ->where('is_admin_delete=0')
                     ->order('create_at desc')
                     ->select();
        return $data;
    }
/**
 * 未发货的订单
 * @param  array  $where [description]
 * @return [type]        [description]
 */
    public function getDeliveryAll(array $where = [])
    {
        $field = ['order_sn, create_at, consignee, phone, pay_time, goods_price, 
                    order_amount, use_desposit, use_integral'];
        $basic = $this->field($field)
                    ->where($where)
                    ->where(['delivery_status'=>0])
                    ->select();
        return $basic;
    }
/**
 * 删除订单 仅已取消 已完成的订单才可被删除
 * 删除方式 软删除 is_admin_delete 置为 1
 * @param  string $order_id 订单ID
 * @return array           [bool, string]
 */
    public function deleteOrder(string $order_id)
    {
        if($this->__isAllowDelete($order_id)){
            if($this->where(['order_id'=>$order_id])->setField('is_admin_delete',1)){
                return [true,'删除成功'];
            }else{
                return [false,'删除失败，请重试'];
            }
        }else{
            return [false,'该订单不可被删除'];
        }
    }
/**
 * 判断订单是否可被删除 已取消 已完成的订单才可被删除
 * @param  string $order_id 订单ID
 * @return bool           true 可以删除
 */
    private function __isAllowDelete(string $order_id)
    {
        $allow_order_status = [3,4]; // 已取消， 已完成 才可被删除
        $status = $this->where(['order_id'=>$order_id])->getField('order_status');
        return in_array(intval($status), $allow_order_status);
    }
}