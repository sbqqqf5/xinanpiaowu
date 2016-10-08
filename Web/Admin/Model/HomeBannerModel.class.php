<?php
namespace Admin\Model;

class HomeBannerModel extends \Think\Model
{
    protected $_validate = [
        ['img','require','未上传图片']
    ];
    /**
     * 添加一个
     * @param array $data [description]
     */
    public function addOne(array $data)
    {
        $ct = $this->create($data);
        if($ct && $this->add()){
            return [true, '添加成功'];
        }else{
            $info = $this->getError()?$this->getError():'添加失败';
            return [false, $info];
        }
    }
    /**
     * 获取数据
     * @return [type] [description]
     */
    public function getAll()
    {
        return $this->field(true)->order('sorted desc')->select();
    }

    /**
     * 更新状态 start--显示为栏目 stop--不显示为栏目
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function updateStatus(array $data)
    {
        return $this->save(['id'=>$data['id'],'status'=>$data['value']]);
    }
    /**
     * 更新排序值
     */
    public function  updateSorted(array $data)
    {
        return $this->save($data);
    }
}