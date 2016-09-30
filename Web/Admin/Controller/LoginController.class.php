<?php

namespace Admin\Controller;

class LoginController extends \Think\Controller
{
    public function index()
    {
        if(IS_POST){
            if(I('post.token') != session('admin_login_token')){
                $this->error('非法请求');exit;
            }
            if(D('admin')->checkLogin(I('post.'))){
                session('admin_login_token', null);
                $this->success('登陆成功','/token.php/Index/index');exit;
            }else{
                $this->error('登陆失败');exit;
            }
        }
        $token = md5(time());
        session('admin_login_token', $token);
        $this->assign('token', $token);
        $this->display();
    }

    public function addone()
    {
        $data = ['user'=>'user','password'=>'123456','repassword'=>'123456'];
        $ans = D('admin')->addOne($data);
        dump($ans);
    }
}