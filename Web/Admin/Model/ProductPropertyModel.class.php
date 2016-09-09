<?php
namespace Admin\Model;

use Think\Model;

class ProductPropertyModel extends Model
{
    const TYPE_INPUT    = 1; // 单行文本
    const TYPE_TEXTAREA = 2; // 多行文本
    const TYPE_SELECT   = 3; // 列表选择
    const TYPE_COLOR    = 4; // 颜色选择

    protected $_validate = [
        ['name','','名称已存在',0,'unique'],
    ];
/**
 * 添加
 * @param [type] $data [description]
 */
    public function addOne($data)
    {
        if($data['type'] == self::TYPE_SELECT && !$data['value']){
            return false;
        }
        if($data['value']){
            $data['value'] = explode("\r\n",$data['value']);
            $data['value'] = array_values(array_filter($data['value']));
            $data['value'] = json_encode($data['value'],JSON_UNESCAPED_SLASHES);
        }else{
            unset($data['value']);
        }
        $ct = $this->create($data);
        if($data['id']){
            if($ct && $this->save()){
                return true;
            }else{
                return false;
            }
        }else{
            if($ct && $this->add()){
                return true;
            }else{
                return false;
            }
        }
    }
/**
 * 获取所有
 * @return [type] [description]
 */
    public function getAll()
    {
        $basic = $this->field(true)->select();
        foreach($basic as &$v){
            $v['value'] = $v['value']?implode(',',json_decode($v['value'],true)):null;
            switch($v['type']){
                case self::TYPE_INPUT : $v['type'] = '单行文本';break;
                case self::TYPE_TEXTAREA : $v['type'] = '多行文本';break;
                case self::TYPE_SELECT : $v['type'] = '列表选择';break;
                case self::TYPE_COLOR : $v['type'] = '颜色选择';break;
            }
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
 * 获取所有属性名
 * @return [type] [description]
 */
    public function getProperties()
    {
        return $this->field('id,name')->select();
    }
/**
 * 删除一个属性
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function delOne($id)
    {
        $isUsed = $this->_propertyUsed($id);
        if($isUsed){
            return [false,'该属性被占用，不可删除'];
        }else{
            $this->delete($id);
            return [true,'删除成功'];
        }
    }

/**
 * 某个属性是否被使用
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    protected function _propertyUsed($id)
    {
        $propertyUsed = D('StarProductCate')->getAllUsedProperties();
        if(in_array($id,$propertyUsed)){
            return true;
        }else{
            return false;
        }
    }
}