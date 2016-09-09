<?php
namespace Admin\Model;

use Think\Model;

class StarBrandModel extends Model
{
    protected $_validate = [
        ['name','','名称不能重复',0,'unique'],
        ['sorted','-128,127','排序值不能超过127',0,'between'],
    ];

/**
 * 添加 更新
 * @param [type] $data [description]
 */
    public function addOne($data)
    {
        $data['pics'] = $data['pics']?json_encode($data['pics'],JSON_UNESCAPED_SLASHES):null;
        $ct = $this->create($data);
        if($ct){
            if($data['id']){
                $add = $this->save();
            }else{
                $add = $this->add();
            }
            $result = $add!==false?[true,true]:[false,$this->getError()];
            return $result;
        }else{
            return [false,$this->getError()];
        }
    }
/**
 * 获取一个 pics 编码成 json
 * @param  string $id ID
 * @return [type]     [description]
 */
    public function getOne($id)
    {
        $basic = $this->field(true)->find($id);
        $basic['pics'] = json_decode($basic['pics'],true);
        return $basic;
    }
/**
 * 查找所有 排除图集
 * @return [type] [description]
 */
    public function getAll()
    {
        return $this->field('pics',true)->select();
    }

/**
 * 删除一个
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function deleteOne($id)
    {
        //是否被占用 [wait]
        return $this->delete($id);
    }
/**
 * 更新状态 start--显示为栏目 stop--不显示为栏目
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function updateStatus(array $data)
    {
        if('start' == $data['action']){
            return $this->where(['id'=>$data['id']])->setField('status',1);
        }elseif('stop' == $data['action']){
            return $this->where(['id'=>$data['id']])->setField('status',0);
        }
    }
/**
 * 更新名字
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function updateName(array $data)
    {
        if($this->create($data) && (false !== $this->save())){
            return true;
        }else{
            return false;
        }
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
}