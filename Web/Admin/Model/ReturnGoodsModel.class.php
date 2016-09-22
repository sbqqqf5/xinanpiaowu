<?php
namespace Admin\Model;
use Think\Model\RelationModel;
/**
 * 退换货表
 */
class ReturnGoodsModel extends RelationModel
{
    /**
     * 退货状态
     * @var array
     */
    public static $status = [0=>'申请中', 1=>'已同意', 2=>'已拒绝'];
    /**
     * 买家是否发货
     * @var array
     */
    public static $userDelivery = [0=>'未发货', 1=>'已发货'];
    /**
     * 后台状态操作
     * @var array
     */
    public static $finished = [0=>'未完成', 1=>'已完成'];

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
                        ->where(['r.is_admin_delete'=>0,'r.goods_type'=>1])
                        ->select();
        // 查询所有一般商品
        $goods = $this->alias('r')
                        ->join('piaowu_star_goods g ON r.goods_id=g.id')
                        ->field('r.id,r.order_id,r.order_sn,r.goods_type,
                            r.goods_id,r.status,r.user_id,r.create_at,
                            g.goods_name')
                        ->order('r.create_at desc')
                        ->where($where)
                        ->where(['r.is_admin_delete'=>0,'r.goods_type'=>2])
                        ->select();
        return array_merge($tickets,$goods);
    }
/**
 * 退货商品详情
 * @param  string $id 退换单ID
 * @return array     [description]
 */
    public function getReturnGoodsDetail(string $id)
    {
        $goods_type = $this->where(['id'=>$id])->getField('goods_type'); // 退换单商品类别
        if($goods_type == 1){// 退门票
            $detail =  $this->alias('r')
                        ->join('piaowu_ticket t ON r.goods_id=t.id')
                        ->join('piaowu_user u ON r.user_id=u.id')
                        ->field('r.*, t.title goods_name, u.nickname, u.phone')
                        ->where(['r.id'=>$id])
                        ->find();
        }else{// 退商品
            $detail =  $this->alias('r')
                        ->join('piaowu_star_goods g ON r.goods_id=g.id')
                        ->join('piaowu_user u ON r.user_id=u.id')
                        ->field('r.*, g.goods_name, u.nickname, u.phone')
                        ->where(['r.id'=>$id])
                        ->find();
        }
        if(!empty($detail['imgs'])){
            $detail['imgs'] = json_decode($detail['imgs'], true);
        }
        return $detail;
    }
/**
 * 从列表删除一个 软删除  is_admin_delete 置 1
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function deleteOne(string $id)
    {
        $status = $this->where(['id'=>$id])->getField('status');
        if($status){
            $this->save(['is_admin_delete'=>1,'id'=>$id]);
            return [true,'操作成功'];
        }else{
            return [false,'该申请未处理，不可删除'];
        }
    }
/**
 * 更新一个退货信息 包含 status remark
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function updateOne(array $data)
    {
        if(!$data['remark']){unset($data['remark']);}
        $ans = $this->field('status,remark')->save($data);
        if($ans !== false){
            return [true,'操作成功'];
        }else{
            $info = $this->getError()?$this->getError():'操作失败，请重试';
            return [false,$info];
        }
    }
}