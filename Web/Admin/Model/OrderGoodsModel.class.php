<?php
namespace Admin\Model;
use Think\Model;
/**
 * 订单商品表
 * 门票 不添加到购物车  
 * 故一条订单中的商品 只含门票  或 一般商品 中的一种
 */
class OrderGoodsModel extends Model
{
/**
 * 获取一个订单中的所有商品信息
 * @param  string $order_id   订单ID
 * @param  string $order_type 订单类型 1=> 门票 2=> 一般商品
 * @return array           [description]
 */
    public function getOneByOrderId(string $order_id, string $order_type)
    {
        if($order_type == '1'){//该订单仅含门票
            $data = $this->alias('o')
                         ->join('piaowu_ticket t ON o.goods_id=t.id')
                         ->field('o.*,t.title goods_name')
                         ->where(['o.order_id'=>$order_id])
                         ->select();
        }elseif($order_type == '2'){
            $data = $this->alias('o')
                         ->join('piaowu_star_goods g ON o.goods_id=g.id')
                         ->field('o.*,g.goods_name')
                         ->where(['o.order_id'=>$order_id])
                         ->select();
        }else{
            return false;
        }
        return $data;
    }
}