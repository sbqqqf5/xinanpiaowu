<?php
namespace Admin\Model;
use Think\Model;

class RechargeModel extends Model
{
/**
 * 查找所有充值记录
 * @param  array  $where 查询条件
 * @return array        [description]
 */
    public function getAll(array $where=[])
    {
        return $this->alias('r')
                    ->join('piaowu_user u ON r.user_id = u.id')
                    ->field('r.*,u.phone, u.nickname')
                    ->where($where)
                    ->where(['is_admin_delete'=>0])
                    ->order('r.create_at desc')
                    ->select();
    }
/**
 * 获取所有会员的ID 
 * @return array 索引数组
 */
    public function getAllMemberId()
    {
        $where['end_date'] = ['EGT',date('Y-m-d')];
        $data = $this->distinct(true)->where($where)->field('id')->select();
        $array_ids = [];
        foreach($data as $v){
            $array_ids[] = $v['id'];
        }
        // $array_ids = array_unique($array_ids);
        return $array_ids;
    }
/**
 * 管理员删除一条记录 软删除 is_admin_delete 置 1
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function deleteOne(string $id)
    {
        return $this->save(['id'=>$id, 'is_admin_delete'=>1]);
    }
}