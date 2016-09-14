<?php
namespace Admin\Controller;

use Think\Controller;

class InfoController extends BaseController
{
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
}