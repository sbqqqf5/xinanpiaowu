<?php
namespace Home\Controller;

use Think\Controller;

class WebController extends Controller
{
    /**
     * 快递100 订阅回调接口 C('EXPRESS_CALLBACKURL', /web/expresscallback)
     * 将接收到的数据写入数据表 piaowu_express_log
     * @return void
     */
    public function expressCallback()
    {
        $data = file_get_contents('php://input');
        $data = urldecode($data);
        $data = substr($data, 6);
        $data = json_decode($data, true);

        $data_db = []; // 写入数据库的数据
        $allowed_field = ['status', 'autoCheck', 'comNew', 'state', 'nu', 'data']; // 数据库接受的字段
        if($data['data']){
            foreach($data as $field=>$value){
                if(in_array($field, $allowed_field)){
                    $field = strtolower($field);
                    if(is_array($value)){
                        $data_db[$field] = json_encode($value, 
                            JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                    }else{
                        $data_db[$field] = $value;
                    }
                }
            }
            if($data_db){
                $data_db['update_time'] = time();
                //写表
                $model = M('ExpressLog');
                $find = $model->field('nu')->find($data_db['nu']);
                if($find){
                    $model->save($data_db);
                }else{
                    $model->add($data_db);
                }
            }
        }
    }
}