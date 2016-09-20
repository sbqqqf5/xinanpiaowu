<?php
namespace Admin\Model;
use Think\Model;

class RechargeModel extends Model
{
/**
 * 查找所有充值记录
 * @param  array  $where 查询条件
 * @return array        [description]
 */
    public function getAll(array $where=[])
    {
        return $this->alias('r')
                    ->join('piaowu_user u ON r.user_id = u.id')
                    ->field('r.*,u.phone as phone')
                    ->where($where)
                    ->order('r.create_at desc')
                    ->select();
    }
/**
 * 获取所有会员的ID 
 * @return array 索引数组
 */
    public function getAllMemberId()
    {
        $where['end_date'] = ['ELT',date('Y-m-d')];
        $data = $this->where($where)->field('id')->select();
        $array_ids = [];
        foreach($data as $v){
            $array_ids[] = $v['id'];
        }
        $array_ids = array_unique($array_ids);
        return $array_ids;
    }
}