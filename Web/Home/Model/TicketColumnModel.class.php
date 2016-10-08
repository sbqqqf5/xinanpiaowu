<?php
namespace Home\Model;
class TicketColumnModel extends \Think\Model
{
    /** 顶级栏目 */
    public function getColumns()
    {
        return $this->field('id,name')
                    ->cache('home_ticketcolumns')
                    ->where('status=1')
                    ->order('sorted desc')
                    ->select();
    }
    /** 一级菜单 */
    public function getMenu()
    {
        return $this->field('id,name,icon')
                    ->cache('home_ticketmenu')
                    ->order('sorted desc')
                    ->select();
    }
}