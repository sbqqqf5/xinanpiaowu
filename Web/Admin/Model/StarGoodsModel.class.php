<?php
namespace Admin\Model;

use Think\Model;

class StarGoods extends Model
{
/**
 * 添加一个商品
 * @param array $data [description]
 */
    public function addOne(array $data)
    {
        $data['pics'] = json_encode($data['pics'],JSON_UNESCAPED_SLASHES);
        if($this->create($data) && $id = $this->add()){
            return [true,$id];
        }else{
            $info = $this->getError()?$this->getError():'操作失败';
            return [false,$info];
        }
    }
}