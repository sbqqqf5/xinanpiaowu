<?php
/* 商品规格表 id type_id name sorted value */
namespace Admin\Model;

use Think\Model;

class ProductPropertyModel extends Model
{
    protected $_validate = [
        ['type_id','0','未选择类别',0,'notequal'],
        ['name','require','名称未填写'],
        ['value','require','未输入值'],
    ];
/**
 * 添加
 * @param [type] $data [description]
 * @return array [true|false, string]
 */
    public function addOne($data)
    {
        if($data['value']){
            $data['value'] = explode("\r\n",$data['value']);
            $data['value'] = array_values(array_filter($data['value']));
            $data['value'] = json_encode($data['value'],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        }else{
            unset($data['value']);
        }
        $ct = $this->create($data);
        if($this->create($data)){
            if($data['id']){
                $ans = $this->save();
            }else{
                $ans = $this->add();
            }
           $result = $ans !== false?[true,'操作成功']:[false,'操作失败'];
           return $result;
        }else{
            $info = $this->getError()?$this->getError():'操作失败';
            return [false,$info];
        }
    }
/**
 * 获取所有
 * @return [type] [description]
 */
    public function getAll($where = '')
    {
        $basic = $this->alias('p')
                        ->join('piaowu_star_product_cate c ON p.type_id=c.id')
                        ->field('p.*,c.name cate')
                        ->order('p.id,p.sorted desc')
                        ->select();
        foreach($basic as &$v){
            $v['value'] = $v['value']?implode(',',json_decode($v['value'],true)):null;
        }
        return $basic;
    }
/**
 * 获取一个
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function getOne($id)
    {
        $basic = $this->field(true)->find($id);
        $basic['value'] = $basic['value']?implode("\r\n",json_decode($basic['value'],true)):'';
        return $basic;
    }
/**
 * 更新排序值 
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function updateSorted(array $data)
    {
        $updateData = ['id'=>$data['id'],'sorted'=>$data['value']];
        return $this->save($updateData);
    }
/**
 * 获取所有属性名
 * @return [type] [description]
 */
    public function getProperties()
    {
        return $this->field('id,name')->select();
    }
/**
 * 通过分类ID 获取所有属性
 * @param  string  $cate [description]
 * @return [type]        [description]
 */
    public function getPropertiesByCate(string $cate)
    {
        $where['type_id'] = $cate;
        $data = $this->where($where)->field(true)->order('sorted desc')->select();
        foreach($data as &$value){
            $value['value'] = json_decode($value['value'],true);
        }
        return $data;
    }
/**
 * 删除一个属性
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function delOne($id)
    {
        return $this->delete($id);
    }
/**
 * 通过 Key_name 获取name=>value
 * @param  string $key_name key_name
 * @return array           [description]
 */
    public function getInfoByKeyName(string $key_name)
    {
        $isHasPlus = strpos($key_name, '+');
        if($isHasPlus){//含 '+' ，两个属性
            $propertyGourp = explode('+', $key_name);
            $properties[0] = explode('_',$propertyGourp[0]); // 第一个规格项
            $properties[1] = explode('_',$propertyGourp[1]); // 第二个规格项
            $info[0]       = $this->field('name,value')->find($properties[0][0]);
            $info[1]       = $this->field('name,value')->find($properties[1][0]);
            $data          = [];
            $value[0]      = json_decode($info[0]['value'],true);
            $value[1]      = json_decode($info[1]['value'],true);
            $data[0]       = ['name'=>$info[0]['name'], 'value'=>$value[0][$properties[0][1]]];
            $data[1]       = ['name'=>$info[1]['name'], 'value'=>$value[1][$properties[1][1]]];
            return $data;
        }else{//不含'+' 仅一个属性
            list($propertyId, $index) = explode('_',$key_name);
            $info  = $this->field('name,value')->find($propertyId);
            $value = json_decode($info['value'],true); // value 数组值 
            return [['name'=>$info['name'], 'value'=>$value[$index]]];
        }
    }


}