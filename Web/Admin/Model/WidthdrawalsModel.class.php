<?php
namespace Admin\Model;
/**
 * 提现申请记录
 */
class WidthdrawalsModel extends \Think\Model
{
/**
 * 申请记录
 * @param  array  $where [description]
 * @return array        [description]
 */
    public function getAll(array $where=[])
    {
        return $this->alias('w')
                    ->join('piaowu_user u ON w.user_id=u.id')
                    ->where($where)
                    ->order('w.create_at desc')
                    ->select();
    }
/**
 * 处理成功
 * @param  string $id [description]
 * @return [type]     [description]
 */
    public function handleSuccess(string $id)
    {
        return $this->where(['id'=>$id])->save(['status'=>1]);
    }
/**
 * 处理失败
 * @param  string $id     ID
 * @param  string $remark 备注信息
 * @return string         [description]
 */
    public function handleError(string $id,string $remark='')
    {
        $data = ['status'=>2];
        if($remark){
            $data['remark'] = $remark;
        }
        return $this->where(['id'=>$id])->save($data);
    }
}