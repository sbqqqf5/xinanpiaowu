<?php

namespace Admin\Model;
use Think\Model;

class StarGoodsPriceModel extends Model
{
    public function addOne(array $info)
    {
        $goods_id  = $info['goods_id'];
        $key_value = $info['key_value'];
        $count     = count($key_value);
        $insetData = [];
        for($i=0;$i<$count;$i++){
            $insetData[] = [
                'goods_id'  => $goods_id,
                'key_value' => $key_value[$i],
                'key_name'  => $info['key_name'][$key_value[$i]],
                'price'     => $info['price'][$key_value[$i]],
                'vip_price' => $info['vip_price'][$key_value[$i]],
                'inventory' => $info['inventory'][$key_value[$i]],
            ];
        }
        $this->where(['goods_id'=>$goods_id])->delete();
        if($this->addAll($insetData)){
            return true;
        }else{
            return false;
        }
    }
/**
 * 获取一件商品的价格
 * @param  string $goods_id [description]
 * @return [type]           [description]
 */
    public function getOneByGoodsId(string $goods_id)
    {
        $basic = $this->where(['goods_id'=>$goods_id])->field(true)->select();
        $data = [];
        foreach($basic as $v){
            $data[$v['key_value']] = $v;
        }
        return $data;
    }
}