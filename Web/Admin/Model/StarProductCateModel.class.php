<?php
namespace Admin\Model;

use Think\Model;

class StarProductCateModel extends Model
{
    protected $_validate = [
        ['name','','名称不能重复',1,'unique'],
        ['sorted','-128,127','排序值不能超过127',1,'between'],
    ];
/**
 * 获取所有
 * @return [type] [description]
 */
    public function getAll()
    {
        $basic = $this->field(true)->order('id,sorted desc')->select();
        $data = $this->buildTree($basic);
        return $data;
    }
/**
 * 获取一个 对 property 格式化
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function getOne($id)
    {
        $basic = $this->field(true)->find($id);
        if($basic['property']){
            $basic['property'] = json_decode($basic['property'],true);
        }
        return $basic;
    }
/**
 * 添加一个分类
 * @param [type] $data [description]
 */
    public function addOne($data)
    {
        if($data['property']){
            $data['property'] = json_encode($data['property'],JSON_UNESCAPED_SLASHES);
        }else{
            unset($data['property']);
        }
        $ct = $this->create($data);
        if($ct){
            if($data['id']){
                if(false !== $this->save()){
                    return [true,true];
                }else{
                    return [false,$this->getError()];
                }
            }else{
                if($this->add()){
                    return [true,true];
                }else{
                    return [false,$this->getError()];
                }
            }
        }else{
            return [false,$this->getError()];
        }
        
    }
/**
 * 删除一个分类
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function deleteOne($id)
    {
        //判断是否占用 [wait]
        $this->delete($id);
        return [true,true];
    }
/**
 * 获取一级分类名
 * @return [type] [description]
 */
    public function getSecondName()
    {
        $basic = $this->field('id,name')->where('pid = 0')
                ->order('sorted desc')->select();
        $data = [];
        foreach ($basic as $v) {
            $data[$v['id']] = $v['name'];
        }
        return $data;
    }
/**
 * 获取所有使用中的属性
 * @return [type] [description]
 */
    public function getAllUsedProperties()
    {
        $arr_properties = $this->where('property is not null')->field('property')->select();
        $data = [];
        foreach($arr_properties as $v){
            foreach(json_decode($v['property'],true) as $value){
                $data[] = $value;
            }
        }
        return array_unique($data);
    }
/**
 * 更新排序
 * @param  string $id    ID
 * @param  string $value 排序值
 * @return [type]        [description]
 */
    public function updateSorted($id,$value)
    {
        $data = ['id'=>$id,'sorted'=>$value];
        if($this->create($data) && $this->save()){
            return [true,true];
        }else{
            return [false,$this->getError()];
        }
    }

/**
* 所有子类
* 
* @param type $arr
* @param type $id 
* @return type
*/
    public function findChild(&$arr, $id) {
        $childs = array ();
        foreach ( $arr as $v ) {
            if (isset ( $v ['pid'] )) {
                $pid = $v ['pid'];
            }
            if ($pid == $id) {
                $childs [] = $v;
            }
        }
        return $childs;
    }
/**
* 找到给定父类I的所有子类
* 
* @param type $rows            
* @param type $root_id         
* @return type
*/
    public function buildTree($rows, $root_id = 0) {
        $childs = $this->findChild ( $rows, $root_id );
        if (empty ( $childs )) {
            return null;
        }
        foreach ( $childs as $k => $v ) {
            if (isset ( $v ['id'] )) {
                $id = $v ['id'];
            }
            $rescurTree = $this->buildTree ( $rows, $id );
            if (null != $rescurTree) {
                $childs [$k] ['children'] = $rescurTree;
            }
        }
        return $childs;
    }
}