<?php
namespace Admin\Model;
use Think\Model;
class ActivityModel extends Model
{
    /**
     * @var id
     * @var goods_type      1-门票商品  2-一般商品
     * @var good_id         一般商品的ID
     * @var begin_time      活动开始时间
     * @var end_time        活动结束时间 
     * @var count_limit     最大参与数量
     * @var person_limit    每人限购数量
     * @var sales_count     已出售数量
     * @var force_stop      1-强制结束
     * @var refund          1-已退款
     * @var is_admin_delete 1-后台软删除
     * @var create_at       创建时间
     */

    const GOODS_TYPE_TICKET  = 1; // 活动商品类别：门票
    const GOODS_TYPE_GENERAL = 2; // 活动商品类别： 一般商品

    protected $patchValidate = true;
    protected $_validate = [
        ['goods_type', '1,2', '未选择商品类别', 1, 'in'],
        ['begin_time', 'require', '未输入活动开始时间', 1],
        ['end_time', 'require', '未输入活动结束时间', 1],
        ['count_limit', [1,100000], '最大参与数量不能超过100 000', 1, 'between'],
        ['person_limit', [1,255], '每人限购数量不能超过255', 1, 'between'],
    ];
    /**
     * 获取所有活动
     * @param  array  $where 筛选条件
     * @return [type]        [description]
     */
    public function getAll(array $where = [])
    {
        $where['a.is_admin_delete'] = 0;
        $ticket_activity = $this->alias('a')
                      ->join('piaowu_ticket t ON a.goods_id=t.id')
                      ->field('a.*,t.title goods_name')
                      ->where($where)
                      ->where(['a.goods_type'=>self::GOODS_TYPE_TICKET])
                      ->select();
        $goods_activity = $this->alias('a')
                               ->join('piaowu_star_goods g ON a.goods_id=g.id')
                               ->field('a.*, g.goods_name goods_name')
                               ->where($where)
                               ->where(['a.goods_type'=>self::GOODS_TYPE_GENERAL])
                               ->select();
        return  array_merge($ticket_activity, $goods_activity);
    }
    /** 查询已结束的活动 */
    public function getExpired()
    {
        $where = '(a.end_time <= "'.date('Y-m-d H:i:s').'" OR a.force_stop = 1) AND a.is_admin_delete=0';
        $ticket_activity = $this->alias('a')
                                ->join('piaowu_ticket t ON a.goods_id=t.id')
                                ->field('a.*, t.title goods_name')
                                ->where($where)
                                ->where(['a.goods_type'=>self::GOODS_TYPE_TICKET])
                                ->select();
        $goods_activity = $this->alias('a')
                               ->join('piaowu_star_goods g ON a.goods_id=g.id')
                               ->field('a.*, g.goods_name goods_name')
                               ->where($where)
                               ->where(['a.goods_type'=>self::GOODS_TYPE_GENERAL])
                               ->select();
        return array_merge($ticket_activity, $goods_activity);
    }

    /** 添加一个活动 */
    public function addOne(array $data)
    {
        if($this->create($data)){
            if($this->add()){
                return [true, '添加活动成功'];
            }else{
                return [false, '添加活动失败，请稍候再试'];
            }
        }else{
            $info = $this->getError()? $this->getError(): '数据有误，添加失败';
            return [false, $info];
        }
    }
/** 删除一个活动 软删除 */
    public function deleteOne(string $id)
    {
        if($this->__accessDelete($id)){
            return $this->save(['id'=>$id, 'is_admin_delete'=>1]);
        }else{
            return false;
        }
    }
    /**
     * 查看活动详情
     * @param  string $id 活动ID
     * @return [type]     [description]
     */
    public function getOne(string $id)
    {
        $type = $this->where(['id'=>$id])->getField('goods_type');
        if($type == self::GOODS_TYPE_TICKET){
            $data = $this->alias('a')
                         ->join('piaowu_ticket t ON a.goods_id=t.id')
                         ->field('a.*, t.title goods_name')
                         ->where(['a.id'=>$id])
                         ->find();
        }else{
            $data = $this->alias('a')
                         ->join('piaowu_star_goods g ON a.goods_id=g.id')
                         ->field('a.*, g.goods_name')
                         ->where(['a.id'=>$id])
                         ->find();
        }
        return $data;
    }
    /**
     * 是否已退款
     * @param  string  $id [description]
     * @return boolean     [description]
     */
    public function isRefund(string $id)
    {
        $refund = $this->where(['id'=>$id])->getField('refund');
        return $refund == 1;
    }
    /**
     * 判断一个活动后台是否可以删除
     * 删除规则  未开始 || 已结束
     * @param  string $id [description]
     * @return bool     [description]
     */
    private function __accessDelete(string $id)
    {
        $info = $this->field('begin_time,end_time,force_stop')->find($id);
        $cur_date = date('Y-m-d H:i:s');
        if($info['force_stop']){
            return true;
        }else{
            $is_begin = strcasecmp($cur_date, $info['begin_time']) > 0;
            $is_end   = strcasecmp($cur_date, $info['end_time']) > 0;
            if(!$is_begin || $is_end){
                // 未开始  || 已结束  可以删除
                return true;
            }else{
                return false;
            }
        }
    }
}