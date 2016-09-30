<?php
namespace Admin\Model;

use Think\Model;

class StarGoodsModel extends Model
{
    public static $paymentWay = [1=>'一般',2=>'仅积分',3=>'仅会员'];

    protected $_validate = [
        ['payment_way',[1,2,3],'购买方式有误',0,'in'],
        ['cate_id','0','商品类别未设置',0,'notequal'],
        ['goods_name','require','商品名称未输入'],
        ['goods_name','','商品名称已存在',0,'unique'],
        ['shop_price','require','最低价格未输入'],
        ['pics','require','未上传图片',1],
        ['goods_content','require','商品详情未输入'],
        ['thumbs','require','缩略图未上传'],
    ];
/**
 * 添加一个商品
 * @param array $data [description]
 */
    public function addOne(array $data)
    {
        if(isset($data['pics'])){
            $data['pics'] = json_encode($data['pics'],JSON_UNESCAPED_SLASHES);
        }
        if(isset($data['thumbs'])){
            $data['thumbs'] = json_encode($data['thumbs'],JSON_UNESCAPED_SLASHES);
        }
        if($this->create($data) && $id = $this->add()){
            return [true,$id];
        }else{
            $info = $this->getError()?$this->getError():'操作失败';
            return [false,$info];
        }
    }
/**
 * 更新
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function updateOne(array $data)
    {
        if(isset($data['pics'])){
            $data['pics'] = json_encode($data['pics'],JSON_UNESCAPED_SLASHES);
        }
        if(isset($data['thumbs'])){
            $data['thumbs'] = json_encode($data['thumbs'],JSON_UNESCAPED_SLASHES);
        }
        if($this->create($data) && $id = $this->save()){
            return [true,$id];
        }else{
            $info = $this->getError()?$this->getError():'操作失败';
            return [false,$info];
        }
    }
/**
 * 获取所有数据的基本信息 （ 不包含 库存 价格 )
 * @param array 筛选条件
 * @return array [description]
 */
    public function getAllBasic(array $where = [])
    {
        $where['is_delete'] = 0;
        return $this->field(true)->where($where)->select();
    }
 /**
  * 获取一条其本信息
  * @param  string $id [description]
  * @return array     [description]
  */
    public function getOneBasic(string $id)
    {
        $data = $this->alias('g')
                ->join('piaowu_star_product_cate c ON g.cate_id = c.id')
                ->field('g.*,c.name cate_name,c.pid cate_pid')
                ->where(['g.id'=>$id])
                ->find();
        $data['thumbs'] = json_decode($data['thumbs'],true);
        $data['pics']   = json_decode($data['pics'],true);
        return $data;
    }
/**
 * 状态处理  上架 推荐 新品 热卖
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function handleStatus(array $data)
    {
        $updateData = ['id'=>$data['id'],$data['action']=>$data['value']];
        return $this->save($updateData);
    }

    /**
 * 更新排序
 * @param  array [ 'id' => '','value' => '']
 * @return [type]        [description]
 */
    public function updateSorted(array $info)
    {
        $data = ['id'=>$info['id'],'sorted'=>$info['sorted']];
        return $this->save($data);
    }
/**
 * 删除  状态置换
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function deleteOne(string $id)
    {
        return $this->save(['id'=>$id,'is_delete'=>1]);
    }
    /**
     * 根据栏目ID 获取数据
     * @param  string $column_id [description]
     * @return [type]            [description]
     */
    public function getActivityDataByColumn(string $column_id)
    {
        return $this->field('id,goods_name name')
                    ->where(['column_id'=>$column_id,'is_delete'=>0])
                    ->select();
    }
}