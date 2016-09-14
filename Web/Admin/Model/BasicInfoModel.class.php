<?php
namespace Admin\Model;

use Think\Model;

class BasicInfoModel extends Model
{
    const LOCATION_PRESALE        = 1; // 预售票提示信息
    const LOCATION_PROMOTION      = 2; // 个人中心 推广图片 注册后
    const LOCATION_SEOKEYWORDS    = 3; // seo keywords
    const LOCATION_SEODESCRIPTION = 4; // seo description
    const LOCATION_SITERIGHTS     = 5; // site rights

/**
 * 获取预售票提示信息
 * @return [type] [description]
 */
    public function getPreSale()
    {
        return $this->field('id,content')
                ->where(['location'=>self::LOCATION_PRESALE])
                ->find();
    }
/**
 * 更新预售票提示信息
 * @param  string $content [description]
 * @return [type]          [description]
 */
    public function updatePreSale(string $content)
    {
        $save = $this->where(['location'=>self::LOCATION_PRESALE])->setField('content',$content);
        if(false !== $save){
            return true;
        }else{
            return false;
        }
    }
/**
 * 获取个人中心 推广图
 * @return [type] [description]
 */
    public function getPromotionPic()
    {
        return $this->where(['location'=>self::LOCATION_PROMOTION])->getField('content');
    }
/**
 * 个人中心 更新推广图 注册后
 * @param  string $filename [description]
 * @return [type]           [description]
 */
    public function updatePromotionPic(string $filename)
    {
        $save = $this->where(['location'=>self::LOCATION_PROMOTION])->setField('content',$filename);
        if(false !== $save){
            return true;
        }else{
            return false;
        }
    }
/**
 * 获取 seo_keywords seo_description site_rights
 * @return array ['seo_keywords'=>'','seo_description' => '','rights' => '']
 */
    public function getSeoAndRights()
    {
        $where['location'] = ['between',[self::LOCATION_SEOKEYWORDS,self::LOCATION_SITERIGHTS]];
        $basic = $this->field('id,location,content')->where($where)->select();
        $data = [];
        foreach($basic as $v){
            switch($v['location']){
                case '3' : $data['seo_keywords'] = $v['content'];break;
                case '4' : $data['seo_description'] = $v['content'];break;
                case '5' : $data['rights'] = $v['content'];break;
            }
        }
        return $data;
    }
/**
 * 更新 seo rights 信息
 * @param  array $data [description]
 * @return [type]       [description]
 */
    public function updateSeoAndRights(array $data)
    {
        foreach($data as $filed => $content){
            switch($filed){
                case 'seo_keywords' : $this->where(['location'=>self::LOCATION_SEOKEYWORDS])
                                            ->save(['content'=>$content]);break;
                case 'seo_description' : $this->where(['location'=>self::LOCATION_SEODESCRIPTION])
                                            ->save(['content'=>$content]);break;
                case 'site_rights' : $this->where(['location'=>self::LOCATION_SITERIGHTS])
                                            ->save(['content'=>$content]);break;
            }
        }
        return true;
    }


}