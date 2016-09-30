<?php
namespace Admin\Controller;

class ActivityController extends BaseController
{
    const REFUND_TOTAL_FEN = 100; // 退款金额  设置为 100分 （ 1元）
    /**
     * 进行中的活动
     * @return void
     */
    public function index()
    {
        $model = D('Activity');
        $where['end_time'] = ['EGT', date('Y-m-d H:i:s')]; // 未结束

        if(IS_POST){
            $action = I('post.action');
            $id     = I('post.id');
            if('delete' == $action){
                $this->ajaxReturn($model->deleteOne($id));
            }
        }
        $data = $model->getAll($where);
        $this->assign([
            'data' => $data,
        ]);
        $this->display();
    }
    /**
     * 查看活动详情 已参加的用户
     * @return [type] [description]
     */
    public function view()
    {
        $id = I('get.id');
        $activityInfo = D('Activity')->getOne($id);
        $memberInfo   = D('ActivityJoin')->getAllByActivity($id);
        $this->assign([
            'detail'  => $activityInfo,
            'members' => $memberInfo,
        ]);
        $this->display();
    }
    /** 设置中奖 */
    public function winning()
    {
        if(IS_POST && $action = I('post.action')){
            $result = false;
            if('one' == $action){
                $result = M('ActivityJoin')->save(['id'=>I('post.id'), 'bingo'=>1]);
            }elseif('all' == $action){
                $result = M('ActivityJoin')
                        ->where(['id'=>['IN',I('post.id','','intval')]])
                        ->save(['bingo'=>1]);
            }
            $this->ajaxReturn($result);
        }
    }
    /**
     * 已过期的活动
     * @return void 
     */
    public function expired()
    {
        $model = D('Activity');
        $data = $model->getExpired();
        $this->assign([
            'data' => $data,
        ]);
        $this->display();
    }
    /** 添加活动 */
    public function add()
    {
        $model = D('Activity');
        if(IS_POST){
            $handle = $model->addOne(I('post.'));
            $this->ajaxReturn($handle);
        }

        $goodsType = D('StarProductCate')->getSecondAllAndFormat();
        $this->assign([
            'ticketType' => D('TicketColumn')->getActivity(),
            'goodsType'  => json_encode($goodsType, JSON_UNESCAPED_UNICODE),
        ]);
        $this->display();
    }
    /** 添加活动 查询商品名 */
    public function queryInfo()
    {
        $type = I('get.type');
        $cateId = I('get.cate');
        if($type == 1){//查询票务商品
            $query = D('Ticket')->getActivityDataByCate($cateId);
            $this->ajaxReturn($query);
        }elseif($type == 2){//查询周边商品
            $query = D('StarGoods')->getActivityDataByColumn($cateId);
            $this->ajaxReturn($query);
        }else{
            $this->ajaxReturn();
        }
    }
    /**
     * 退款
     * @return [type] [description]
     */
    public function refund()
    {
        if(IS_POST){
            $id = I('post.id');
            if(!D('Activity')->isRefund($id)){ // 当前还未退款
                // 更新退款单号 返回 [id, order_num, out_refund_no]
                // $refundData = D('ActivityJoin')->setOutRefundNo($id);
                // className  WxPayApi
                $import   = import('Vendor.WxPay.lib.WxPay#Api', '', '.php');
                $WxPayApi = new \WxPayApi();
                $inputObj = new \WxPayRefund();
                // 设置退款参数 循环退款
                for($i=0; $i<count($refundData); $i++){
                    $inputObj->SetOut_refund_no($refundData[$i]['out_refund_no']);// 退款单号
                    $inputObj->SetOut_trade_no($refundData[$i]['order_num']); // 商户订单号
                    $inputObj->SetTotal_fee(self::REFUND_TOTAL_FEN); // 订单金额 100分
                    $inputObj->SetRefund_fee(self::REFUND_TOTAL_FEN); // 退款金额 100 分
                    $inputObj->SetOp_user_id(WECAHT_MCHID); // 商户号

                    $WxPayApi::refund($inputObj, 10); // 请求退款
                }
                $this->ajaxReturn($WxPayApi);
            }
        }
    }
}

