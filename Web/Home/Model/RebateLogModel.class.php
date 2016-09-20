<?php
namespace Home\Model;
use Think\Model;
/**
 * 提成记录
 */
class RebateLogModel extends Model
{
/**
 * 获取一个用户的提成记录
 * @param  string $id 分销用户ID
 * @return array     [description]
 */
    public function getLogById(string $id)
    {
        $where = [
            'log.user_id' => $id,
            'log.status'  => ['IN',[2,3]],
        ];
        return $this->alias('log')
                    ->join('piaowu_user u ON log.by_user_id=u.id')
                    ->field('log.money,log.confirm_time,u.nickname')
                    ->where($where)
                    ->select();
    }

/**
 * 获取分销用户的总提成金额  
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function getTotalByUserId(string $id)
    {
        $where = [
            'user_id' => $id,
            'status'  => ['IN',[2,3]],
        ];
        return $this->where($where)->sum('money');
    }
}