<?php

namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{

/**
 * 判断一个用户是否为会员
 * @param  string  $id 用户ID
 * @return boolean     true 为会员
 */
    public function isMember(string $id)
    {
        //结束日期数组
        $endDate = M('recharge')->where(['user_id'=>$id])->field('end_date')->select();
        $endTime = 0;
        $curDate = time();
        $flag = false;
        foreach($endDate as $v){
            $endTime = strtotime('+1 day',strtotime($v['end_date']));
            if($curDate < $endTime){
                $flag = true;
                break;
            }
        }
        return $flag;
    }
}