<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {
        $this->assign([
            'banners' => D('HomeBanner')->getAll(),
            'columns' => D('TicketColumn')->getColumns(),
            'menus'   => D('TicketColumn')->getMenu(),
        ]);
        $this->display();
    }
}