<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController
{
    public function index()
    {
        $this->display();
    }

    public function form()
    {
        $msg = '您有新的订单，请即时处理！';
        $send = $this->_sendMsg($msg,'13540314451');
        dump($send);
    }

    public function multi()
    {
        $this->display();
    }

    public function table()
    {
        $this->display();
    }

    public function delete()
    {
        $result = [true,'操作成功'];
        $result = [false,I('post.id')];
        $this->ajaxReturn( $result );
    }


}