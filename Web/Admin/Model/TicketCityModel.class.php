<?php
namespace Admin\Model;

use Think\Model;

class TicketCityModel extends Model
{
    protected $_validate = [
        ['name','1,10','名称长度不合法',0,'length'],
        ['name','','名称不能重复',0,'unique'],
        ['sorted','-128,127','排序值不能超过127',0,'between'],
    ];
/**
 * 获取所有
 * @return [type] [description]
 */
    public function getAll()
    {
        return $this->field(true)->select();
    }
/**
 * 添加栏目
 * @param  array $data [description]
 * @return [type]       [description]
 */
    public function cityAdd($data)
    {
        if($this->create() && $this->add()){
            return [true,true];
        }else{
            $info = $this->getError()?$this->getError():'操作失败';
            return [false,$info];
        }
    }

    /**
 * 删除一个
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function deleteOne($id)
    {
        //是否被占用 [wait]
        $ans = $this->delete($id);
        return [true,true];
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
    public function updateSorted($data)
    {
        if($this->create($data) && $this->save()){
            return [true,true];
        }else{
            return [false,$this->getError()];
        }
    }
}