<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function form()
    {
        $this->display();
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