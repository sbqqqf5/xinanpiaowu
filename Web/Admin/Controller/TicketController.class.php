<?php
namespace Admin\Controller;
use Think\Controller;
class TicketController extends BaseController
{
/**
 * 票务商品列表
 * @return [type] [description]
 */
    public function index()
    {
        $modal = D('Ticket');
        if(IS_POST && $id = I('post.id')){
            $action = I('post.action');
            if('start' == $action || 'stop' == $action){
                $modal->updateStatus(I('post.'));
            }
            if('del' == $action){
                $modal->where(['id'=>$id])->setField('is_delete',1);
                $this->ajaxReturn(1);
            }
            if('sorted' == $action){
                $modal->updateSorted($_POST);
                $this->ajaxReturn(1);
            }
        }
        $where = null;
        if(IS_GET && 'search' == I('get.action')){
            if($cate = I('get.cate')){
                $where['t.cate'] = $cate;
            }
            if($city = I('get.city')){
                $where['t.city'] = $city;
            }
            if($columns = I('get.columns')){
                $where['t.columns'] = $columns;
            }
        }
        $data = $modal->getAll($where);
        $this->assign([
            'data'    => $data,
            'cities'  => D('TicketCity')->getAll(),
            'cates'   => D('TicketCate')->getAll(),
            'columns' => D('TicketColumn')->getAll(),
        ]);
        $this->display();
    }
/**
 * 添加票务商品
 * @return 
 */
    public function add()
    {
        if(IS_POST){
            $add = D('Ticket')->ticketAdd($_POST);
            if($add[0]){
                $this->success($add[1],'index');exit;
            }else{
                $this->error($add[1]);exit;
            }
        }
        $this->assign([
            'cities'  => D('TicketCity')->getAll(),
            'cates'   => D('TicketCate')->getAll(),
            'columns' => D('TicketColumn')->getAll(),
        ]);
        $this->display();
    }
/**
 * 门票查看
 * @return [type] [description]
 */
    public function ticketView()
    {
        $id = I('get.id');
        $detail = D('Ticket')->findOne($id);
        $this->assign([
            'detail' => $detail,
        ]);
        $this->display();
    }
/**
 * 门票编辑
 * @return [type] [description]
 */
    public function ticketEdit()
    {
        $id = I('get.id');
        $modal = D('Ticket');
        $detail = $modal->findOne($id);
        if(IS_POST){
            $update = $modal->updateOne($_POST);
            if($update[0]){
                $this->success($update[1],'index');exit;
            }else{
                $this->error($update[1]);exit;
            }
        }
        $this->assign([
            'detail'  => $detail,
            'cities'  => D('TicketCity')->getAll(),
            'cates'   => D('TicketCate')->getAll(),
            'columns' => D('TicketColumn')->getAll(),
        ]);
        $this->display();
    }
/**
 * 栏目管理
 * @return [type] [description]
 */
    public function columnList()
    {
        $modal = D('TicketColumn');

        if(IS_POST){
            $action = I('post.action');
            if('add' == $action){
                $_POST['pics'] = session('admin_column_banner');
                $ans = $modal->columnAdd($_POST);
                if($ans[0]){
                    $this->success('操作成功');exit;
                }else{
                    $this->error($ans[1]);exit;
                }
            }
            if('name' == $action){
                $ans = $modal->updateName($_POST);
                $this->ajaxReturn($ans);
            }
            if('sorted' == $action){
                $ans = $modal->updateSorted($_POST);
                $this->ajaxReturn($ans);
            }
            if('start' == $action || 'stop' == $action){
                $ans = $modal->updateStatus($_POST);
                $this->ajaxReturn($ans);
            }
            if('del' == $action){
                $ans = $modal->deleteOne(I('post.id'));
                $this->ajaxReturn($ans);
            }
            if('intro' == $action){
                $ans = $modal->updateIntro($_POST);
                $this->ajaxReturn($ans);
            }
        }

        if(IS_GET && $id = I('get.id')){
            $info = $modal->getOne($id);
            $this->ajaxReturn($info);
        }

        $data = $modal->getAll();
        session('admin_column_banner')?session('admin_column_banner',null):null;
        $this->assign([
            'data' => $data ,
            'cates' => D('TicketCate')->getTicketCateName(),
        ]);
        $this->display();
    }
/**
 * 票务城市
 * @return [type] [description]
 */
    public function cityList()
    {
        $modal = D('TicketCity');
        if(IS_POST){
            $action = I('post.action');
            if('add' == $action){
                $ans = $modal->cityAdd($_POST);
                if($ans[0]){
                    $this->success('操作成功');exit;
                }else{
                    $this->error($ans[1]);exit;
                }
            }
            if('name' == $action){
                $ans = $modal->updateName($_POST);
                $this->ajaxReturn($ans);
            }
            if('sorted' == $action){
                $ans = $modal->updateSorted($_POST);
                $this->ajaxReturn($ans);
            }
            if('start' == $action || 'stop' == $action){
                $ans = $modal->updateStatus($_POST);
                $this->ajaxReturn($ans);
            }
            if('del' == $action){
                $ans = $modal->deleteOne(I('post.id'));
                $this->ajaxReturn($ans);
            }
        }
        $this->assign('data',$modal->getAll());
        $this->display();
    }
/**
 * 票务分类
 * @return [type] [description]
 */
    public function cateList()
    {
        $modal = D('TicketCate');
        if(IS_POST){
            $action = I('post.action');
            if('add' == $action){
                $ans = $modal->cateAdd($_POST);
                if($ans[0]){
                    $this->success('操作成功');exit;
                }else{
                    $this->error($ans[1]);exit;
                }
            }
            if('name' == $action){
                $ans = $modal->updateName($_POST);
                $this->ajaxReturn($ans);
            }
            if('sorted' == $action){
                $ans = $modal->updateSorted($_POST);
                $this->ajaxReturn($ans);
            }
            if('start' == $action || 'stop' == $action){
                $ans = $modal->updateStatus($_POST);
                $this->ajaxReturn($ans);
            }
            if('del' == $action){
                $ans = $modal->deleteOne(I('post.id'));
                $this->ajaxReturn($ans);
            }
        }
        $this->assign([
            'data' => $modal->getAll(),
        ]);
        $this->display();
    }

/**
 * 上传栏目专区 banner 图 
 * @var array session('admin_column_banner');
 * @return [type] [description]
 */
    public function ajaxColumnBanner()
    {
        $result = $this->ajaxFileUpload('columnbanner/');
        if($result){
            $pics = session('admin_column_banner')?session('admin_column_banner'):[];
            $pics[] = $result;
            session('admin_column_banner',$pics);
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }
/**
 * 重置上传栏目 banner 的 session
 * @return [type] [description]
 */
    public function resetSessionBanner()
    {
        session('admin_column_banner',null);
    }
/**
 * 上传票务商品的 首页缩略图
 * @return string 
 */
    public function ajaxUploadTicketHomeThumb()
    {
        $result = $this->ajaxFileUpload('tickets/');
        if($result){
            $ans = $result;
        }else{
            $ans = 0;
        }
        $this->ajaxReturn($result);
    }
/**
 * 上传票务商品的 一般缩略图
 * @return string 
 */
    public function ajaxUploadTicketThumb()
    {
        $result = $this->ajaxFileUpload('tickets/');
        if($result){
            $ans = $result;
        }else{
            $ans = 0;
        }
        $this->ajaxReturn($ans);
    }
}