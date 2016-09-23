<?php
namespace Admin\Model;
use Think\Model;
class AgentApplyModel extends Model
{
/**
 * 代理申请记录
 * @param  array  $where [description]
 * @return [type]        [description]
 */
    public function getAll(array $where = [])
    {
        return $this->field(true)->where($where)->order('create_at desc')->select();
    }
/**
 * 同意申请
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function agree(string $id)
    {
        $user_id = $this->where(['id'=>$id])->getField('user_id');
        $this->startTrans();
        try {
            $this->save(['id'=>$id, 'status'=>1]);
            D('User')->advanceAgent($user_id);
            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->rollback();
            return false;
        }
    }
/**
 * 拒绝申请
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function refuse(string $id)
    {
        return $this->save(['id'=>$id, 'status'=>2]);
    }
}