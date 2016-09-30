<?php
namespace Admin\Model;
use Think\Model\RelationModel;
/**
 * 分成记录表
 */
class RebateLogModel extends RelationModel
{
    /** @var $status 记录状态 */
    public static $status = [0=>'未付款', 1=>'已付款', 2=>'已收货', 3=>'已完成', 4=>'已取消'];
    protected $_link = [
        'Member' => [
            'mapping_type'   => self::HAS_ONE,
            'class_name'     => 'User',
            'mapping_name'   => 'distribute_user',
            'foreign_key'    => 'id',
            'mapping_key'    => 'user_id',
            'mapping_fields' => 'name',
        ],
        'User' => [
            'mapping_type'   => self::HAS_ONE,
            'mapping_name'   => 'buy_user',
            'foreign_key'    => 'id',
            'mapping_key'    => 'by_user_id',
            'mapping_fields' => 'nickname',
        ],
    ];
/**
 * 分销提成记录
 * @param  array  $where [description]
 * @return [type]        [description]
 */
    public function getAll(array $where)
    {
        $where['is_admin_delete'] = 0;
        return $this->relation(true)
                    ->field(true)
                    ->where($where)
                    ->order('id desc')
                    ->select();
    }
    /**
     * 删除记录 软删除  未取消不可删除
     * @param  string $id [description]
     * @return mixed     [description]
     */
    public function deleteOne(string $id)
    {
        $status = $this->field('status')->find($id);
        if($status['status'] == 4){
            return $this->delete($id);
        }else{
            return false;
        }
    }
    /**
     * 确认一条记录
     * @param  string $id [description]
     * @return [type]     [description]
     */
    public function confirmOne(string $id)
    {
        $status = $this->field('status')->find($id);
        if($status['status'] == 2){
            $saveData = ['id'=>$id, 'status'=>3, 'confirm_time'=>time()];
            return $this->save($saveData);
        }else{
            return false;
        }
    }

}