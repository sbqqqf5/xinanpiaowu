<?php
namespace Admin\Controller;

use Think\Controller;

class MemberController extends BaseController
{
/**
 * 会员列表
 * @return [type] [description]
 */
    public function index()
    {
        
        $this->display();
    }
/**
 * 充值记录
 * @return [type] [description]
 */
    public function recharge()
    {
        if(IS_GET && 'search' == I('get.action')){
            //筛选
            $where = [];
        }
        $this->display();
    }
}