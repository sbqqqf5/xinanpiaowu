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
        $model = D('User');
        $data = $model->getAll();
        if(IS_GET && 'search' == I('get.action')){
            if($is_member = I('get.member')){
                if($is_member == 1){//筛选非会员
                    foreach($data as $k=>$v){
                        if($v['is_member'] ==1){//会员
                            unset($data[$k]);
                        }
                    }
                }
                if($is_member == 2){//筛选会员
                    foreach($data as $k=>$v){
                        if($v['is_member'] == 0){
                            unset($data[$k]);
                        }
                    }
                }
            }
        }
        $this->assign([
            'data' => $data,
        ]);
        $this->display();
    }
/**
 * 充值记录
 * @return [type] [description]
 */
    public function recharge()
    {
        $modal = D('Recharge');
        if(IS_GET && 'search' == I('get.action')){
            //筛选
            $where = [];
        }
        if(IS_POST && $id=I('post.id')){
            if('delete' == I('post.action')){
                $del = $modal->deleteOne($id);
                $this->ajaxReturn($del);
            }
        }
        $data = $modal->getAll($where);
        $this->assign('data',$data);
        $this->display();
    }
/**
 * 代理用户列表
 * @return [type] [description]
 */
    public function agent()
    {
        $modal = D('User');
        $where = [];
        if(IS_POST && $id = I('post.id') ){
            $action = I('post.action');
            if('stop' == $action){
                //停止代理身份
                $stop = $modal->stopAgent($id);
                $this->ajaxReturn($stop);
            }
            if('advance' == $action){
                $advance = $modal->advanceAgent($id);
                $this->ajaxReturn($advance);
            }
            
        }
        $this->assign([
            'data' => $modal->getAllAgent($where),
        ]);
        $this->display();
    }
/**
 * 代理商申请
 * @return [type] [description]
 */
    public function agentApplyList()
    {
        $model = D('AgentApply');
        $where = [];
        if(IS_POST && $id = I('post.id')){
            $action = I('post.action');
            if('agree' == $action){
                $agree = $model->agree($id);
                $this->ajaxReturn($agree);
            }
            if('refuse' == $action){
                $refuse = $model->refuse($id);
                $this->ajaxReturn($refuse);
            }
        }

        $this->assign([
            'data' => $model->getAll($where),
        ]);
        $this->display();
    }
    /**
     * 提现申请
     * @return [type] [description]
     */
    public function withdrawList()
    {
        $model = new \Admin\Model\WithdrawalsModel();
        if(IS_POST && $id = I('post.id')){
            if(1 == I('post.status')){//打款接口
                
            }
            $ans = $model->handle(I('post.'));
        }
        $data = $model->getAll();
        $this->assign([
            'data' => $data,
        ]);

        $this->display();
    }
}