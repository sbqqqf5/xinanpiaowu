<?php
namespace Admin\Model;
use Think\Model;
class WithdrawalsModel extends Model
{
    public static $status = [0=>'申请中', 1=>'处理成功', 2=>'已拒绝'];
    /**
     * 查询所有非删除的数据
     * @param  array  $where [description]
     * @return [type]        [description]
     */
    public function getAll(array $where = [])
    {
        $where['w.is_admin_delete'] = 0;
        return $this->alias('w')
                    ->join('piaowu_user u ON w.user_id=u.id')
                    ->field('w.*, u.name, u.phone, u.openid')
                    ->where($where)
                    ->order('w.create_at desc')
                    ->select();
    }
/**
 * 处理提现申请
 * @param  array  $data  [id, remark, stauts]
 * @return [type]       [description]
 */
    public function handle(array $data)
    {
        $data['update_at'] = time();
        if($this->create($data) && $this->save()){
            return [true,'操作成功'];
        }else{
            $info = $this->getError()?$this->getError():'操作失败';
            return [false, $info];
        }
    }
}