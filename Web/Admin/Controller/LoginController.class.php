<?php

namespace Admin\Controller;

class LoginController extends \Think\Controller
{
    public function index()
    {
        if(IS_POST){
            if(D('admin')->checkLogin(I('post.'))){
                $this->success('登陆成功','Index/index');exit;
            }else{
                $this->error('登陆失败');exit;
            }
        }
        $this->display();
    }

    public function addone()
    {
        $data = ['user'=>'user','password'=>'123456','repassword'=>'123456'];
        $ans = D('admin')->addOne($data);
        dump($ans);
    }
}