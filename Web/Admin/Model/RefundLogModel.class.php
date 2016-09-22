<?php
namespace Admin\Model;
use Think\Model;

class RefundLogModel extends Model
{
/**
 * 添加一条记录
 * @param array $data [description]
 */
    public function addOne(array $data)
    {
        if(isset($data['money'])){
            //微信付款
            $this->startTrans();
            try {
                $this->add($data); // 本表
                if($data['intgral']){// 退积分
                    D('User')->pointsInc($data['user_id'], $dta['integral']);
                }
                $this->commit();
                return [true, '操作成功'];
            } catch (\Exception $e) {
                $this->rollback();
                return [false,'退款失败，请重试'];
            }
        }else{//仅退积分
            $this->startTrans();
            try{
                $this->add($data); // 本表
                // 用户表 积分增加
                D('User')->pointsInc($data['user_id'], $dta['integral']);
                $this->commit();
                return [true, '操作成功'];
            }catch(\Exception $e){
                $this->rollback();
                return [false,'退还积分失败，请重试'];
            }
        }
    }
}