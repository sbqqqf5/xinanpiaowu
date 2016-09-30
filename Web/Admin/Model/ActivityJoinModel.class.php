<?php
namespace Admin\Model;
use Think\Model;
/** 参加活动表 */
class ActivityJoinModel extends Model
{
    /**
     * @var id
     * @var activity_id
     * @var user_id
     * @var order_num       支付订单号
     * @var exchange_code   兑换码
     * @var pay_status      支付状态 1-已支付
     * @var create_at timestamp 创建时间
     * @var pay_time  int   支付时间
     * @var bingo           1-中奖
     */
    
    /**
     * 查询活动的交易记录
     * @param  string $activity_id [description]
     * @return [type]              [description]
     */
    public function getAllByActivity(string $activity_id)
    {
        $where = ['a.activity_id'=>$activity_id, 'a.pay_status'=>1];
        return $this->alias('a')
                    ->join('piaowu_user u ON a.user_id=u.id')
                    ->field('a.*, u.nickname, u.phone')
                    ->where($where)
                    ->select();
    }
    /**
     * 生成退款单号 
     * @param string $id [description]
     * @return array  处理后的数据
     */
    public function setOutRefundNo(string $id)
    {
        // 要处理的退款单个数
        $count = $this->where(['activity_id'=>$id])->count();
        // 生成的退款单号
        $outRefundNoArray = self::makeOutRefundNo(intval($count));
        // 要更新数据的主键ID
        $data = $this->where(['activity_id'=>$id])->field('id, order_num')->select();
        foreach($data as $key=>&$v){
            $this->where(['id'=>$v['id']])->save(['out_refund_no'=>$outRefundNoArray[$key]]);
            $v['out_refund_no'] = $outRefundNoArray[$key];
        }
        return $data;
    }
    /**
     * 活动ID 查询订单号 退款用
     * @param  string $activity_id [description]
     * @return array              [description]
     */
    public function getAllOrderNum(string $activity_id)
    {
        $basic = $this->where(['activity_id'=>$activity_id])->field('order_num')->select();
        $data = [];
        foreach($basic as $k=>$v){
            $data[$k] = $v['order_num'];
        }
        return $data;
    }
    /**
     * 生成指定长度的数组 存在退款单号
     * @param  int    $count 生成的数据个数
     * @return array        [description]
     */
    private static function makeOutRefundNo(int $count)
    {
        $data = [];
        $number = 0;
        for($i=0; $i<$count; $i++){
            $number = self::produceRandomNo();
            if(in_array($number, $data)){
                $i --;
                continue;
            }else{
                $data[] = $number;
            }
        }
        return $data;
    }
    /**
     * 生成随机数
     * @return string   30位
     */
    private static function produceRandomNo()
    {
        return date('YmdHis').time().mt_rand(100000, 999999);

    }
}