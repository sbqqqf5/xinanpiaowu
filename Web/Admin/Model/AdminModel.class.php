<?php
namespace Admin\Model;

class AdminModel extends \Think\Model
{
    protected $_validate = [
        ['user','','用户名不能重复',0,'unique'],
        ['password','6,13','密码不少于6位，不多于13位',0,'length'],
        ['repassword','password','确认密码不正确',0,'confirm']
    ];
/**
 * 添加一个管理员
 * @param array $data ['user','password','repassword']
 * @return array [bool , 'info']
 */
    public function addOne(array $data)
    {
        if($this->create($data)){
            $this->password = password_hash($data['password'],PASSWORD_DEFAULT);
            if($this->add()){
                $result = [true,'添加管理员成功'];
            }else{
                $result = [false,$this->getError()?$this->getError():'添加管理员失败'];
            }
        }else{
            $result = [false,$this->getError()?$this->getError():'数据验证失败'];
        }
        return $result;
    }
/**
 * 判断登录
 * @param  array  $data ['user','password']
 * @return bool       [description]
 */
    public function checkLogin(array $data)
    {
        $info = $this->field(true)->where(['user'=>$data['user']])->find();
        if(!$info){return false;}
        if(password_verify($data['password'],$info['password'])){
            session('admin_user',$info);
            $updateData = [
                'last_login_time' => time(),
                'last_login_ip'   => get_client_ip(),
                'login_times'     => $info['login_times']+1,
            ];
            $this->where(['user'=>$data['user']])->save($updateData);
            return true;
        }else{
            return false;
        }
    }
/**
 * 修改密码
 * @param  array  $data ['id','oldpassword','password','repassword']
 * @return array       [bool,'info']
 */
    public function updatePassword(array $data)
    {
        $info = $this->field('id,user,password')->where(['id'=>$data['id']])->find();
        if(!password_verify($data['oldpassword'],$info['password'])){
            return [false,'旧密码输入不正确'];
        }else{
            if($this->create($data)){
                $this->password = password_hash($data['password'],PASSWORD_DEFAULT);
                if($this->save()){
                    return [true,'更新密码成功'];
                }else{
                    return [false,$this->getError()?$this->getError():'更新失败'];
                }
            }else{
                return [false,$this->getError()?$this->getError():'更新失败'];
            }
        }
    }
}