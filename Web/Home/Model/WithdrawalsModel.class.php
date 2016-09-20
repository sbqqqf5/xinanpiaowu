<?php
namespace Home\Model;
use Think\Model;
/**
 * 申请提成记录表
 */
class WithdrawalsModel extends Model
{
/**
 * 获取用户 的提成记录
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function getLogByUserId(string $id)
    {
        return $this->where(['user_id'=>$id])
                    ->field('money,create_at,update')
                    ->select();
    }
/**
 * 获取用户 的已提成金额
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function getTotalByUserId(string $id)
    {
        $where = [
            'user_id' => $id,
            'status'  => ['IN',[0,1]],
        ];
        return $this->where($where)->sum('moeny');
    }
}