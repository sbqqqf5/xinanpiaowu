<?php
namespace Admin\Model;

use Think\Model;

class TicketColumnModel extends Model
{
    protected $_validate = [
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
 * 获取一个  pics,cates 编码成 array
 * @param  string $id ID
 * @return [type]     [description]
 */
    public function getOne($id)
    {
        $basic = $this->field(true)->find($id);
        $basic['pics'] = json_decode($basic['pics'],true);
        $basic['cates'] = json_decode($basic['cates'],true);
        return $basic;
    }
/**
 * 添加栏目
 * @param  array $data [description]
 * @return [type]       [description]
 */
    public function columnAdd($data)
    {
        $data['cates'] = $data['cates']?json_encode($data['cates'],JSON_UNESCAPED_SLASHES):null;
        $data['pics'] = $data['pics']?json_encode($data['pics'],JSON_UNESCAPED_SLASHES):null;
        if(!$data['pics']){unset($data['pics']);}
        $ct = $this->create($data);
        if($ct){
            if($data['id']){
                $ans = $this->save();
            }else{
                $ans = $this->add();
            }
            $result = $ans!==false?[true,true]:[false,$this->getError()];
        }else{
            $result = $this->getError()?[false,$this->getError()]:[false,'操作失败'];
        }
        return $result;
    }

    /**
 * 删除一个
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function deleteOne($id)
    {

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
 * 更新介绍
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function updateIntro(array $data)
    {
        if($this->create($data) && ( false !== $this->save())){
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

/**
 * 获取所有使用中的类别
 * @return [type] [description]
 */
    public function getUsedCates()
    {
        $arr_properties = $this->where('cates is not null')->field('cates')->select();
        $data = [];
        foreach($arr_properties as $v){
            foreach(json_decode($v['cates'],true) as $value){
                $data[] = $value;
            }
        }
        return array_unique($data);
    }
}