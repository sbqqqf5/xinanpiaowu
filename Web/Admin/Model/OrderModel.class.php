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
 * 获取一条订单基本信息
 * @param  string $order_id [description]
 * @return array           [description]
 */
    public function getOne(string $order_id)
    {
        $field = ['user_id', 'order_id', 'order_sn', 'order_type', 'order_status', 
                'delivery_status', 'province', 'city', 'district', 'address', 
                'order_amount', 'pay_status', 'consignee', 'phone', 'goods_price', 'create_at', 
                'pay_time', 'use_desposit', 'use_integral', 'integral_money'];
        return $this->field($field)->where(['order_id'=>$order_id])->find();
    }
/**
 * 未发货的订单 
 * @return [type]        [description]
 */
    public function getDeliveryAll()
    {
        $where = [
            'delivery_status' => 0, // 未发货
            'order_status'    => 1, // 订单未处理
            'is_admin_delete' => 0, // 管理员未删除
            'pay_status'      => 1 // 已支付
        ]; // 未发货条件
        $field = ['order_id', 'order_sn, create_at, consignee, phone, pay_time, 
                goods_price, order_amount, use_desposit, use_integral'];
        $basic = $this->field($field)
                    ->where($where)
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
 * 执行发货
 * @param  array  $data ['order_id','express','express_code']
 * @return array       [bool, string]
 */
    public function actionDelivery(array $data)
    {
        // order 表更新的数据
        $dataForOrder = array_merge($data, [
            'delivery_status' => 1,
            'receive_type'    => 1,
            'delivery_time'   => time(),
        ]);
        // order_goods 表更新数据
        $dataForOrderGoods  = ['is_send'=>1];
        $whereForOrderGoods = ['order_id'=>$data['order_id']];

        $this->startTrans();
        try{
            $this->data($dataForOrder)->save();
            M('OrderGoods')->where($whereForOrderGoods)->setField($dataForOrderGoods);
            $this->commit();
            $return = [true,'操作成功'];
        }catch(\Exception $e){
            $this->rollback();
            $info = $this->getError()?$this->getError():'操作失败,请稍候再试！';
            $return = [false,$info];
        }
        return $return;
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