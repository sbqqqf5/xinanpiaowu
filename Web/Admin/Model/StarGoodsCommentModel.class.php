<?php
namespace Admin\Model;

use Think\Model;

class StarGoodsCommentModel extends Model
{
    public static $static = [1=>'显示', 2=>'屏蔽'];
    /**
     * 获取所有评论
     * @param  array  $where [description]
     * @return [type]        [description]
     */
    public function getAll(array $where = [])
    {
        $data = $this->alias('c')
                    ->join('piaowu_star_goods g ON c.goods_id=g.id')
                    ->field('c.id, c.user_nickname, c.content, c.status, c.goods_key_name, c.create_at,  g.goods_name')
                    ->where($where)
                    ->select();
        $productProperty = D('ProductProperty');
        foreach($data as &$v){
            $v['key_value'] = $productProperty->getInfoByKeyName($v['goods_key_name']);
        }
        return $data;
    }
/**
 * 获取一个详情
 * @param  string $id 
 * @return [type]     [description]
 */
    public function getOne(string $id)
    {
        $where['c.id'] = $id;
        $data = $this->alias('c')
                    ->join('piaowu_star_goods g ON c.goods_id=g.id')
                    ->field('c.*, g.goods_name')
                    ->where($where)
                    ->find();
        $productProperty = D('ProductProperty');
        $data['key_value'] = $productProperty->getInfoByKeyName($data['goods_key_name']);
        return $data;
    }
/**
 * 修改评论 score content status
 * @param  array  $data [description]
 * @return [type]       [description]
 */
    public function updateOne(array $data)
    {
        $data['score'] = intval($data['score']);
        if($this->field('id,score,content,status')->create($data) && $this->save()){
            return [true, '修改成功'];
        }else{
            return [false, '未修改内容'];
        }
    }
}