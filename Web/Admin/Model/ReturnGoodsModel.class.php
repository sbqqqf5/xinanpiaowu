<?php
namespace Admin\Model;
use Think\Model\RelationModel;
/**
 * 退换货表
 */
class ReturnGoodsModel extends RelationModel
{
    protected $_link = [
        'User' => [
            'mapping_type' => self::HAS_ONE,
            'mapping_name' => 'user',
            'foreign_key'  => 'id',
            'parent_key'   => 'user_id',
        ],
        'Order' => [
            'mapping_type' => self::HAS_ONE,
            'mapping_name' => 'order',
            'foreign_key'  => 'order_id',
            'parent_key'   => 'order_id',
        ],
    ];
/**
 * 退货列表数据
 * @param  array  $where [description]
 * @return [type]        [description]
 */
    public function getAll(array $where = [])
    {
        // 查询所有门票商品
        $tickets = $this->alias('r')
                        ->join('piaowu_ticket t ON r.goods_id=t.id')
                        ->field('r.id,r.order_id,r.order_sn,r.goods_type,
                            r.goods_id,r.status,r.user_id,r.create_at,
                            t.title goods_name')
                        ->order('r.create_at desc')
                        ->where($where)
                        ->select();
        // 查询所有一般商品
        $goods = $this->alias('r')
                        ->join('piaowu_star_goods g ON r.goods_id=g.id')
                        ->field('r.id,r.order_id,r.order_sn,r.goods_type,
                            r.goods_id,r.status,r.user_id,r.create_at,
                            g.goods_name')
                        ->order('r.create_at desc')
                        ->where($where)
                        ->select();
        return array_merge($tickets,$goods);
    }
}