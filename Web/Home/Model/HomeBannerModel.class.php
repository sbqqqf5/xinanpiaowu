<?php
namespace Home\Model;
class HomeBannerModel extends \Think\Model
{
    public function getAll()
    {
        return $this->field('img,link')
                    ->cache('home_homebanner',3600)
                    ->where('status=1')
                    ->order('sorted desc')
                    ->select();
    }
}