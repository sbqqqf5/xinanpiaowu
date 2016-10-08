<?php
namespace Admin\Controller;

use Think\Controller;

class InfoController extends BaseController
{
    /**
     * 首页轮播图
     * @return [type] [description]
     */
    public function homeBanner()
    {
        $model = D("HomeBanner");
        if(IS_POST){
            $action = I('post.action');
            $id     = I('post.id');
            if('del' == $action && $id){//删除一条内容
                $this->ajaxReturn($model->delete($id));
            }
            if('sorted' == $action && $id){//更新排序值 
                $this->ajaxReturn($model->updateSorted(I('post.')));
            }
            if('status' == $action && $id){
                $this->ajaxReturn($model->updateStatus(I('post.')));
            }
            if('add' == $action){
                $add = $model->addOne(I('post.'));
                if($add[0]){
                    $this->success('添加成功', 'homeBanner');exit;
                }else{
                    $this->error($add[1]);exit;
                }
            }
        }

        $this->assign([
            'data' => $model->getAll(),
        ]);
        $this->display();
    }
/**
 * 上传首页 Banner 图
 * @return [type] [description]
 */
    public function ajaxHomeBanner()
    {
        $result = $this->ajaxFileUpload('homebanner/');
        if($result){
            $ans = $result;
        }else{
            $ans = 0;
        }
        $this->ajaxReturn($ans);
    }
/**
 * 充值会员价格 赠送积分
 * @return [type] [description]
 */
    public function vipPrice()
    {
        $modal = D('BasicVipprice');
        if(IS_POST){
            $modal->infoUpdate($_POST);
        }
        $this->assign('data',$modal->getAll());
        $this->display();
    }
/**
 * 预售票提示信息
 * @return [type] [description]
 */
    public function preSale()
    {
        $modal = D('BasicInfo');
        if(IS_POST && $content = I('post.content')){
            $modal->updatePreSale($content);
        }
        $this->assign('data',$modal->getPreSale());
        $this->display();
    }
/**
 * 个人中心推广图 注册后
 * @return [type] [description]
 */
    public function promotion()
    {
        $modal = D('BasicInfo');
        if(IS_POST && $content = I('post.content')){
            $modal->updatePromotionPic($content);
        }
        $pic = $modal->getPromotionPic();
        $this->assign('data',$pic);
        $this->display();
    }
/**
 * 推广图 上传
 * @return [type] [description]
 */
    public function promotionUpload()
    {
        $filename = $this->ajaxFileUpload('promotion/');
        exit($filename);
    }
/**
 * seo rights 信息更新
 * @return [type] [description]
 */
    public function seoAndRight()
    {
        $modal = D('BasicInfo');
        if(IS_POST){
            $ans = $modal->updateSeoAndRights(I('post.'));
        }
        $data = $modal->getSeoAndRights();
        $this->assign([
            'data' => $data,
        ]);
        $this->display();
    }
/**
 * 管理员列表
 * @return [type] [description]
 */
    public function adminList()
    {
        $modal = D('admin');
        if(IS_GET && $id = I('get.id'))
        {
            $info = $modal->field('id,user')->find($id);
            $this->ajaxReturn($info);
        }
        if(IS_POST)
        {
            $id = I('post.id');
            if($id){
                if('del' == I('post.action')){
                    //删除用户
                    $modal->delete($id);
                    $this->ajaxReturn(true);
                }else{
                     //修改密码
                    $update = $modal->updatePassword($_POST);
                    if($update[0]){
                        $this->success($update[1]);exit;
                    }else{
                        $this->error($update[1]);exit;
                    }
                }
            }else{
                //添加用户
                $add = $modal->addOne($_POST);
                if($add[0]){
                    $this->success($add[1]);exit;
                }else{
                    $this->error($add[1]);exit;
                }
            }
        }

        $this->assign('data',$modal->field('password',true)->select());
        $this->display();
    }
    /** 快递公司 */
    public function express()
    {
        $model = M('AllowedExpress');

        if(IS_POST){
            $code = I('post.code');
            $action = I('post.action');
            if('add' == $action){
                $add = $model->add(I('post.'));
                if($add){
                    $this->success('操作成功', 'express');exit;
                }else{
                    $this->error('操作失败，请重试');exit;
                }
            }
            if('update' == $action){
                $add =$model->save(I('post.'));
                if($add){
                    $this->success('操作成功', 'express');exit;
                }else{
                    $this->error('操作失败，请重试');exit;
                }
            }
            if('delete' == $action){
                $this->ajaxReturn($model->delete($code));
            }
            if('status' == $action){//更新状态
                $this->ajaxReturn($model->save(['code'=>I('post.code'),'status'=>I('post.status')]));
            }
            if('sorted' == $action){//更新排序值
                $this->ajaxReturn($model->save(['code'=>I('post.code'),'sorted'=>I('post.sorted')]));
            }
        }else{
            $data = $model->field(true)->select();
            $this->assign('data', $data);
            $this->display();
        }
    }
}