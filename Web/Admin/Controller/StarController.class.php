<?php
namespace Admin\Controller;

use Think\Controller;

class StarController extends BaseController
{

/**
 * 明星周边-产品分类-列表
 * @return [type] [description]
 */
    public function cateList()
    {
        $modal = D('star_product_cate');
        $this->assign([
            'data' => $modal->getAll(),
            'secondCateName' => $modal->getSecondName(),
            'properties' => D('ProductProperty')->getProperties(),
        ]);
        $this->display();
    }
/**
 * 添加分类
 */
    public function addCate()
    {
        // dump($_POST);die;
        $ans = D('star_product_cate')->addOne($_POST);
        if($ans[0]){
            $this->success('操作成功');exit;
        } 
        else{
            $info = $ans[1]?$ans[1]:'操作失败，请重试';
            $this->error($info);exit;
        }
    }
/**
 * 操作分类
 * @return [type] [description]
 */
    public function cateHandle()
    {
        $modal = D('StarProductCate');
        if(IS_POST && $id = I('post.id')){
            $action = I('post.action');
            if("sorted" == $action){
                //更新排序
                $modal->updateSorted($id,I('post.value'));
                $this->ajaxReturn(null);
            }
            if('del' == $action){
                $ans = $modal->deleteOne($id);
                $this->ajaxReturn($ans);
            }
        }
        if(IS_GET && $id = I('get.id'))
        {
            $info = $modal->getOne($id);
            $this->ajaxReturn($info);
        }
    }
/**
 * 商品属性
 * @return [type] [description]
 */
    public function productProperty()
    {
        $this->assign([
            'data' => D('productProperty')->getAll(),
        ]);
        $this->display();
    }
/**
 * 添加商品规格属性
 * @return [type] [description]
 */
    public function propertyAdd()
    {
        if(D('ProductProperty')->addOne(I('post.'))){
            $this->success('操作成功');
        }else{
            $this->error('操作失败，请重试');
        }
    }
/**
 * 处理商品规格属性
 * @return [type] [description]
 */
    public function propertyHandle()
    {
        $modal = D('ProductProperty');
        if(IS_GET && $id = I('get.id')){
            $this->ajaxReturn($modal->getOne($id));
        }
        if(IS_POST && $id = I('post.id')){
            $handle = $modal->delOne($id);
            $this->ajaxReturn($handle);
        }
    }
/**
 * 明星品牌
 * @return [type] [description]
 */
    public function starList()
    {
        session('admin_star_banner',null);
        $this->assign([
            'data' => D('StarBrand')->getAll(),
        ]);
        $this->display();
    }
/**
 * 明星品牌 添加  更新
 * @return [type] [description]
 */
    public function starAdd()
    {
        if(session('admin_star_banner')){
            $_POST['pics'] = session('admin_star_banner');
        }
        $result = D('StarBrand')->addOne($_POST);
        if($result[0]){
            session('admin_star_banner',null);
            $this->success('保存成功');exit;
        }else{
            session('admin_star_banner',null);
            $error = $result[1]?$result[1]:'操作失败';
            $this->error($error);exit;
        }
    }

    public function starBrandHandle()
    {
        $modal = D('StarBrand');
        if(IS_POST && $id = I('post.id')){
            $action = I('post.action');
            if('sorted' == $action){
                $modal->updateSorted($id,I('post.value'));
                exit;
            }elseif('start' == $action or 'stop' == $action){
                $modal->updateStatus($_POST);
                exit;
            }elseif('name' == $action){
                $ans = $modal->updateName($_POST);
                $this->ajaxReturn($ans);
            }elseif('del' == $action){
                $ans = $modal->delete($id);
                $this->ajaxReturn($ans);
            }
        }
        if(IS_GET && $id = I('get.id')){
            $this->ajaxReturn( $modal->getOne($id) );
        }
    }
/**
 * 上传明星品牌缩略图
 * @return [type] [description]
 */
    public function ajaxStarBrandUpload()
    {
        $result = $this->ajaxFileUpload('starbrand/');
        exit($result);
    }
/**
 * 上传明星专区 banner 图 
 * @var array session('admin_star_banner');
 * @return [type] [description]
 */
    public function ajaxStarBanner()
    {
        $result = $this->ajaxFileUpload('starbanner/');
        if($result){
            $pics = session('admin_star_banner')?session('admin_star_banner'):[];
            $pics[] = $result;
            session('admin_star_banner',$pics);
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }
/**
 * 重置明星专区 banner 的 session
 * @return [type] [description]
 */
    public function resetSessionBanner()
    {
        session('admin_star_banner',null);
    }
}