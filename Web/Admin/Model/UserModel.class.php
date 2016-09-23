<?php

namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
/**
 * 获取所有用户
 * @param  array  $where [description]
 * @return [type]        [description]
 */
    public function getAll(array $where=[])
    {
        $data = $this->where($where)->field(true)->select();
        $members_id = D('Recharge')->getAllMemberId(); // 所有会员ID
        foreach($data as &$v){
            if(in_array($v['id'],$members_id)){
                $v['is_member'] = 1;
            }else{
                $v['is_member'] = 0;
            }
        }
        return $data;
    }

/**
 * 判断一个用户是否为会员
 * @param  string  $id 用户ID
 * @return boolean     true 为会员
 */
    public function isMember(string $id)
    {
        //结束日期数组
        $endDate = M('recharge')->where(['user_id'=>$id])->field('end_date')->select();
        if($endDate){
            foreach($endDate as $v){
                if( strcasecmp(date('Y-m-d'),$v['end_date']) <= 0 ){
                    return true;
                }
            }
            return false;
        }else{
            return false;
        }
    }
/**
 * 获取用户昵称 电话  订单详情使用
 * @param  string $user_id user_id
 * @return array          ['nickname'=>'', 'phone'=>'']
 */
    public function getOneUseInOrderDetail(string $user_id)
    {
        $field = ['nickname', 'phone'];
        return $this->field($field)->find($user_id);
    }
/**
 * 增加用户积分
 * @param  string $user_id 用户id
 * @param  string $points  积分
 * @return [type]          [description]
 */
    public function pointsInc(string $user_id, string $points)
    {
        return $this->where(['id'=>$user_id])->setInc('points', $points);
    }
/**
 * 查询所有代理商
 * @param  array  $where [description]
 * @return [type]        [description]
 */
    public function getAllAgent(array $where = [])
    {
        $field = true;
        $where['is_distribute'] = 1;
        return $this->alias('u')
                    ->join('piaowu_agent_apply a ON u.id=a.user_id')
                    ->field('u.*, a.name agent_name, a.phone agent_phone')
                    ->where($where)
                    ->select();
    }
/**
 * 停止代理身份
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function stopAgent(string $id)
    {
        return $this->save(['id'=>$id, 'distribute_time'=>time(), 'is_distribute'=>0]);
    }
/**
 * 提升为代理商
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function advanceAgent(string $id)
    {
        return $this->save(['id'=>$id, 'distribute_time'=>time(), 'is_distribute'=>1]);
    }
}