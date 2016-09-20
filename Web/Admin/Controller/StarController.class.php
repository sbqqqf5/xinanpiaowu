<?php
namespace Admin\Controller;

use Think\Controller;

class StarController extends BaseController
{
/**
 * 商品列表 
 * @return [type] [description]
 */
    public function index()
    {

        $modal = D('StarGoods');
        $where = [];
        if(IS_GET && 'search' == I('get.action')){
            if($column_id = I('get.columns')){$where['column_id'] = $column_id;}
            if($cate_id = I('get.cate')){$where['cate_id'] = $cate_id;}
            if($payment_way = I('get.payment_way')){$where['payment_way'] = $payment_way;}
        }
        if(IS_POST && I('post.handle')=='status'){ // 状态处理 上架 新品 推荐 热卖
            $handle = $modal->handleStatus($_POST);
            $this->ajaxReturn($handle);
        }
        if(IS_POST && 'sorted' == I('post.action')){//更新排序
            $this->ajaxReturn( $modal->updateSorted($_POST) );
        }
        if(IS_POST && 'delete' == I('post.action')){//删除
            $this->ajaxReturn( $modal->deleteOne(I('post.id')) );
        }
        $data = $modal->getAllBasic($where);
        $columns = D('StarBrand')->getIDAndName();
        // dump($data);
        $this->assign([
            'cates'       => D('StarProductCate')->getParents(),
            'columns'     => D('StarBrand')->getIDAndName(),
            'secondCates' => D('StarProductCate')->getSecondAllAndFormat(),
            'paymentWay'  => $modal::$paymentWay,
            'data'        => $data,
        ]);
        $this->display();
    }
/**
 * 添加商品
 * @return void
 */
    public function addProduct()
    {
        /*if(IS_POST){
            if(I('post.step')==1 && $cate = I('post.cate')){
                //获取商品分类下的 商品属性
                $cateInfo = D('StarProductCate')->getOne($cate);
                $whereProperty['id'] = ['in',$cateInfo['property']];
                $fieldsInfo = D('ProductProperty')->getAll($whereProperty);
                $this->assign('fieldsInfo',$fieldsInfo);

                dump($fieldsInfo);
                dump(D('StarProductCate')->getOne($cate));
                $this->assign('cate',D('StarProductCate')->getOne($cate));
            }
        }*/
        if(IS_GET && $id = I('get.id')){
            $detail = D('StarGoods')->getOneBasic($id);
            $detailCates = D('StarProductCate')->getOneSecondCatesByPid($detail['cate_pid']);
            $this->assign([
                'detail'      => $detail,
                'detailCates' => $detailCates,
            ]);
        }
        if(IS_GET && $cate_id = I('get.cate_id')){
            //选择分类的二级联动数据
            $cates = D('StarProductCate')->getSecondCates($cate_id);
            $this->ajaxReturn($cates);
        }
        $this->assign([
            'cates'   => D('StarProductCate')->getParents(),
            'columns' => D('StarBrand')->getAll(),
        ]);
        $this->display();
    }
/**
 * 添加商品 录入价格
 * @return null
 */
    public function addProductStep2()
    {
        if(IS_POST && !isset($_POST['id'])){
            //添加
            $ans = D('StarGoods')->addOne($_POST);
            if($ans[0]){
                $fieldsInfo = D('ProductProperty')->getPropertiesByCate(I('post.cate_id'));
                $this->assign([
                    'fieldsInfo' => $fieldsInfo,
                    'goods_id'   => $ans,
                ]);
            }else{
                $this->error($ans[1]);exit;
            }
        }
        if(IS_POST && $id=I('post.id')){
            //更新
            if('pass' == I('post.action')){
                //跳过基本信息 更新价格
                $priceInfo  = D('StarGoodsPrice')->getOneByGoodsId($id);
                $fieldsInfo = D('ProductProperty')->getPropertiesByCate(I('post.cate_id'));
                $this->assign([
                    'fieldsInfo' => $fieldsInfo,
                    'goods_id'   => $id,
                    'priceInfo'  => $priceInfo,
                ]);
            }else{
                $update = D('StarGoods')->updateOne($_POST);
                if($update[0]){
                    //更新成功
                    $priceInfo  = D('StarGoodsPrice')->getOneByGoodsId($id);
                    $fieldsInfo = D('ProductProperty')->getPropertiesByCate(I('post.cate_id'));
                    $this->assign([
                        'fieldsInfo' => $fieldsInfo,
                        'goods_id'   => $id,
                        'priceInfo'  => $priceInfo,
                    ]);
                }else{
                    $this->error($update[1]);exit;
                }
            }
        }

        /*$priceInfo  = D('StarGoodsPrice')->getOneByGoodsId(8);
        $fieldsInfo = D('ProductProperty')->getPropertiesByCate(4);
        dump($priceInfo);
        dump($fieldsInfo);
        $this->assign('priceInfo',$priceInfo);
        $this->assign('fieldsInfo',$fieldsInfo);
        $this->assign('goods_id',8);*/

        $this->display();
    }
/**
 * 添加商品 保存价格
 */
    public function addProductStep3()
    {
        $ans = D('StarGoodsPrice')->addOne($_POST);
        if($ans){
            $this->success('添加成功','index');
        }else{
            $this->error('操作失败');
        }
    }

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
        ]);
        $this->display();
    }
/**
 * 添加分类
 */
    public function addCate()
    {
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
        if(IS_POST && $id = I('post.id')){
            $action = I('post.action');
            if('sorted' == $action){
                //更新排序
                D('productProperty')->updateSorted($_POST);
                $this->ajaxReturn(1);
            }
        }
        $this->assign([
            'data'  => D('productProperty')->getAll(),
            'cates' => D('StarProductCate')->getSecnodAll(),
        ]);
        $this->display();
    }
/**
 * 添加商品规格属性
 * @return [type] [description]
 */
    public function propertyAdd()
    {
        $ans = D('ProductProperty')->addOne(I('post.'));
        if($ans[0]){
            $this->success($ans[1]);
        }else{
            $this->error($ans[1]);
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
 * 明星专区商品 预览图
 * @return [type] [description]
 */
    public function ajaxUploadGoodsPics()
    {
        $result = $this->ajaxFileUpload('goods/');
        $this->ajaxReturn($result);
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