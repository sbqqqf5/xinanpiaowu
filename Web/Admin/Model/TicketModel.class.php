<?php
namespace Admin\Model;

use Think\Model;

class TicketModel extends Model
{
/**
 * 添加门票
 * @param  array $data 表单数据
 * @return array       添加信息
 */
    public function ticketAdd(array $data)
    {
        $data['view_location']    = json_encode($data['view_location'],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $data['price']            = json_encode($data['price'],JSON_UNESCAPED_SLASHES);
        $data['vip_price']        = json_encode($data['vip_price'],JSON_UNESCAPED_SLASHES);
        $data['performance_time'] = json_encode($data['performance_time'],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

        $ct = $this->create($data);
        if($ct){
            $add = $this->add();
            if($add){
                $result = [true,'操作成功'];
            }else{
                $info = $this->getError()?$this->getError():'操作错误';
                $result = [false,$info];
            }
        }else{
            $info = $this->getError()?$this->getError():'操作错误';
            $result = [false,$info];
        }
        return $result;
    }
/**
 * 获取所有
 * @param  mixed $where 查询条件
 * @return array        [description]
 */
    public function getAll($where = null)
    {
        $where['t.is_delete'] = ['eq',0]; // 未删除
        $basic = $this->alias('t')
                ->join('piaowu_ticket_city c ON t.city = c.id')
                ->join('piaowu_ticket_column columns ON t.columns = columns.id')
                ->join('piaowu_ticket_cate cate ON t.cate = cate.id')
                ->field('t.*,c.name city_name,cate.name cate_name,columns.name column_name')
                ->order('t.create_at desc')
                ->where($where)
                ->select();
        return $basic;
    }

/**
 * 更新状态 start--上架 stop--下架
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
 * 查找一个
 * @param  string $id ID
 * @return array     detail
 */
    public function findOne($id)
    {
        $where = ['t.id'=>$id];
        $basic = $this->alias('t')
                ->join('piaowu_ticket_city c ON t.city = c.id')
                ->join('piaowu_ticket_cate cate ON t.cate = cate.id')
                ->join('piaowu_ticket_column columns ON t.columns = columns.id')
                ->field('t.*,c.name city_name,cate.name cate_name,columns.name column_name')
                ->where($where)
                ->find();
        $basic['performance_time'] = json_decode($basic['performance_time'],true);
        $basic['view_location'] = json_decode($basic['view_location'],true);
        $basic['price'] = json_decode($basic['price'],true);
        $basic['vip_price'] = json_decode($basic['vip_price'],true);
        return $basic;
    }
/**
 * 更新门票信息
 * @param  array $data $_POST
 * @return array       [description]
 */
    public function updateOne(array $data)
    {
        $data['view_location']    = json_encode($data['view_location'],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $data['price']            = json_encode($data['price'],JSON_UNESCAPED_SLASHES);
        $data['vip_price']        = json_encode($data['vip_price'],JSON_UNESCAPED_SLASHES);
        $data['performance_time'] = json_encode($data['performance_time'],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $ct = $this->create($data);
        if($ct){
            if($this->save()){
                $result = [true,'更新成功'];
            }else{
                $result = [false,'未更新任何内容'];
            }
        }else{
            $result = [false,'内容错误，更新失败'];
        }
        return $result;
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
     * 根据分类ID 查询有效数据
     * @param  string $cate_id [description]
     * @return [type]          [description]
     */
    public function getActivityDataByCate(string $cate_id)
    {
        return $this->where(['cate'=>$cate_id,'is_delete'=>0])
                      ->field('id,title name')
                      ->select();
    }
}