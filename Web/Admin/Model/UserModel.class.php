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
    public function getAll(array $where)
    {
        $data = $this->where($where)->field(true)->select();
        $members_id = D('Recharge')->getAllMemberId(); // 所有会员ID
        foreach($data as $v){
            if(in_array($v['id'],$members_id)){
                $data['is_member'] = 1;
            }else{
                $data['is_member'] = 0;
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
}