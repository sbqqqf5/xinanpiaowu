<?php
namespace Admin\Model;

use Think\Model;

class BasicVippriceModel extends Model
{
    const CATE_MONTH = 1; // 月
    const CATE_YEAR  = 2; // 年

/**
 * 信息更新
 * @param  array  $data [description]
 * @return array       [description]
 */
    public function infoUpdate(array $data)
    {
        $ct = $this->create($data);
        if($ct && (false !== $this->save())){
            return true;
        }else{
            return false;
        }
    }

    public function getAll()
    {
        return $this->field('id,cate,price,points')
                    ->order('cate asc')
                    ->select();
    }
}