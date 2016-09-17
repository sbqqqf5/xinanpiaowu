-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2016 at 01:56 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fengniao_piaowu`
--

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_admin`
--

CREATE TABLE `piaowu_admin` (
  `id` smallint(6) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `last_login_ip` varchar(15) DEFAULT NULL COMMENT '上次登录IP',
  `login_times` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `piaowu_admin`
--

INSERT INTO `piaowu_admin` (`id`, `user`, `password`, `last_login_time`, `last_login_ip`, `login_times`, `create_at`) VALUES
(1, 'admin', '$2y$10$dNrxexKkQYbYC51fsExBm.DvQgT4hDhN/5Avl.cdLHg/M4lyb4vE6', 0, NULL, 0, '2016-09-14 15:39:02'),
(2, 'user', '$2y$10$sNLqkKXCLoopY3WEC0SlwuFGdeXyPaZ7KvDQVO5RtEknBnZDf2Lum', 0, NULL, 0, '2016-09-14 15:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_basic_info`
--

CREATE TABLE `piaowu_basic_info` (
  `id` int(11) NOT NULL,
  `location` tinyint(4) NOT NULL COMMENT '呈现位置',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `other` text COLLATE utf8_unicode_ci COMMENT '其他'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='网站基本信息表';

--
-- Dumping data for table `piaowu_basic_info`
--

INSERT INTO `piaowu_basic_info` (`id`, `location`, `content`, `other`) VALUES
(1, 1, '123123123', NULL),
(2, 2, '/Uploads/promotion/2016-09-12/57d67c6543f6f.jpg', '个人中心推广图 申请后'),
(3, 3, 'keyworsd123', 'seo_keywords'),
(4, 4, 'des123', 'seo_description'),
(5, 5, 'tight123', 'site rights');

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_basic_vipprice`
--

CREATE TABLE `piaowu_basic_vipprice` (
  `id` int(11) NOT NULL,
  `cate` tinyint(3) UNSIGNED NOT NULL COMMENT '1-月 2-年',
  `price` decimal(6,2) NOT NULL COMMENT '价格',
  `points` int(11) NOT NULL COMMENT '积分'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='基本信息 会员购买价格';

--
-- Dumping data for table `piaowu_basic_vipprice`
--

INSERT INTO `piaowu_basic_vipprice` (`id`, `cate`, `price`, `points`) VALUES
(1, 1, '10.00', 100),
(2, 2, '100.00', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_order`
--

CREATE TABLE `piaowu_order` (
  `order_id` int(11) NOT NULL,
  `order_sn` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单编号',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `order_status` tinyint(1) DEFAULT '0' COMMENT '0-未确认 1-已确认',
  `delivery_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发货状态 1-已发货',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态 1-已支付',
  `consignee` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '收货人',
  `province` int(11) NOT NULL DEFAULT '0' COMMENT '省',
  `city` int(11) NOT NULL DEFAULT '0' COMMENT '市',
  `district` int(11) NOT NULL DEFAULT '0' COMMENT '区',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '详细地址',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '电话',
  `receive_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-自己取货 1-快递收货',
  `express` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '快递公司',
  `express_code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '快递单号',
  `goods_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '商品总价',
  `use_desposit` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '使用订金',
  `use_integral` int(11) NOT NULL DEFAULT '0' COMMENT '使用积分',
  `integral_money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '积分抵多少钱',
  `order_amount` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '应付金额',
  `delivery_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '发货时间',
  `receive_time` int(11) NOT NULL DEFAULT '0' COMMENT '收货确认时间',
  `user_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户备注',
  `admin_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理员备注',
  `admin_confirm_time` int(11) NOT NULL DEFAULT '0' COMMENT '管理员确认订单时间',
  `parant_id` int(11) NOT NULL DEFAULT '0' COMMENT '父订单ID',
  `is_distribut` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已分成',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` int(10) UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='订单表';

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_order_goods`
--

CREATE TABLE `piaowu_order_goods` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `goods_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-门票商品 2-其他商品',
  `goods_num` smallint(6) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `goods_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `vip_goods_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '会员价格',
  `integral` smallint(6) NOT NULL DEFAULT '0' COMMENT '积分价格',
  `spec_id` int(11) NOT NULL DEFAULT '1' COMMENT '商品规格ID',
  `is_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未发货 1-已发货 2-已换货 3-已退货',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='订单商品表';

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_product_property`
--

CREATE TABLE `piaowu_product_property` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '规格名',
  `type` tinyint(4) NOT NULL COMMENT '1-单行文本 2-多行文本 3-列表选择 4-颜色选择',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '列表选择的值 json'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品规格模型';

--
-- Dumping data for table `piaowu_product_property`
--

INSERT INTO `piaowu_product_property` (`id`, `name`, `type`, `value`) VALUES
(1, '大小', 3, '["S","M","L","XL"]'),
(2, '颜色', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_rebate_log`
--

CREATE TABLE `piaowu_rebate_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '获佣用户ID',
  `by_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '购买人ID',
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `order_sn` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单号',
  `goods_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '订单商品总额',
  `money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '提成金额',
  `receive_time` int(11) NOT NULL DEFAULT '0' COMMENT '收货时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未付款 1-已付款 2-等待分成（已收货） 3-已分成 4-已取消',
  `confirm_time` int(11) NOT NULL DEFAULT '0' COMMENT '确定分成时间 或 取消时间',
  `remark` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注信息',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='分成记录表';

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_recharge`
--

CREATE TABLE `piaowu_recharge` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `order_sn` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '充值单号',
  `money` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `last_time` tinyint(1) NOT NULL DEFAULT '1' COMMENT '时长 1-月 2-年',
  `begin_date` date NOT NULL COMMENT '开始日期',
  `end_date` date NOT NULL COMMENT '结束日期',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='会员充值表';

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_star_brand`
--

CREATE TABLE `piaowu_star_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sorted` tinyint(4) NOT NULL DEFAULT '1',
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '缩略图',
  `pics` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '轮播图',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示为栏目 1-显示 0-不显示',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='明星品牌';

--
-- Dumping data for table `piaowu_star_brand`
--

INSERT INTO `piaowu_star_brand` (`id`, `name`, `sorted`, `thumb`, `pics`, `status`, `create_at`) VALUES
(1, '周杰伦', 50, '/Uploads/starbrand/2016-09-09/57d22166c1177.jpg', NULL, 1, '2016-09-09 02:41:50'),
(2, '小明', 40, '/Uploads/starbrand/2016-09-09/57d221c13b76a.jpg', NULL, 0, '2016-09-09 02:43:21'),
(3, '小红', 30, '/Uploads/starbrand/2016-09-09/57d222b254e73.jpg', '["/Uploads/starbanner/2016-09-09/57d222b7ec488.jpg","/Uploads/starbanner/2016-09-09/57d222b7f335e.jpg"]', 0, '2016-09-09 02:47:21'),
(4, '买买提', 20, '/Uploads/starbrand/2016-09-09/57d222d532f7b.jpg', '["/Uploads/starbanner/2016-09-09/57d222d987b00.jpg","/Uploads/starbanner/2016-09-09/57d222d98daa8.jpg","/Uploads/starbanner/2016-09-09/57d222d993882.jpg"]', 0, '2016-09-09 02:47:55'),
(6, '3434', 10, '/Uploads/starbrand/2016-09-09/57d26ba6d4cf4.jpg', '["/Uploads/starbanner/2016-09-09/57d26b9e2e18d.jpg","/Uploads/starbanner/2016-09-09/57d26b9e344eb.jpg","",""]', 0, '2016-09-09 06:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_star_goods`
--

CREATE TABLE `piaowu_star_goods` (
  `id` int(11) NOT NULL,
  `payment_way` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付方式 1-一般商品 2-积分商品 3-会员商品',
  `column_id` int(11) DEFAULT NULL COMMENT '栏目ID',
  `cate_id` int(11) NOT NULL COMMENT '分类ID',
  `goods_name` varchar(255) NOT NULL COMMENT '名称',
  `shop_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '最低价格',
  `store_count` int(11) NOT NULL DEFAULT '0' COMMENT '库存--没有用',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `goods_content` text COMMENT '商品详情',
  `pics` varchar(255) DEFAULT NULL COMMENT '原始图',
  `commission` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  `is_on_sale` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-上架 0-下架',
  `sorted` smallint(5) UNSIGNED NOT NULL DEFAULT '10' COMMENT '排序',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 1-推荐',
  `is_new` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否新品 1-新品',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否热卖 1-热卖',
  `sales_sum` int(11) NOT NULL DEFAULT '0' COMMENT '销量  便于排序',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='明星周边商品';

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_star_goods_price`
--

CREATE TABLE `piaowu_star_goods_price` (
  `id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `key_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '规格键名 10_12',
  `key_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '规格键名中文 name:value name:value',
  `price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `inventory` int(11) NOT NULL DEFAULT '0' COMMENT '库存'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='规格对应价格 库存';

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_star_product_cate`
--

CREATE TABLE `piaowu_star_product_cate` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `sorted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序值',
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '类名',
  `property` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品属性 json'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='明星周边--产品--分类';

--
-- Dumping data for table `piaowu_star_product_cate`
--

INSERT INTO `piaowu_star_product_cate` (`id`, `pid`, `sorted`, `name`, `property`) VALUES
(1, 1, 4, '音箱', NULL),
(2, 0, 126, '电器', NULL),
(3, 2, 1, '人桂花', '["1","2"]'),
(4, 0, 3, '地地地', '["1","2"]'),
(5, 0, 60, '地茜要', NULL),
(6, 0, 3, '顶戴 模压', '["2"]'),
(7, 5, 4, '二级分类', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_ticket`
--

CREATE TABLE `piaowu_ticket` (
  `id` int(11) NOT NULL,
  `columns` int(11) DEFAULT NULL COMMENT '栏目ID',
  `cate` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sorted` int(11) NOT NULL DEFAULT '1' COMMENT '排序值',
  `is_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否预订 1-预订',
  `is_home` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否首页 1-首页',
  `deposit` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '预订订金',
  `distribute_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '分享提成',
  `venues` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '场馆',
  `city` smallint(6) NOT NULL,
  `view_location` varchar(90) COLLATE utf8_unicode_ci NOT NULL COMMENT '观看位置 json',
  `price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '价格 json',
  `vip_price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '会员价 json',
  `performance_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '演出时间 json',
  `inventory` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `performance_duration` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '演出时长 小时',
  `entry_time` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '入场时间 字符串',
  `limit_explain` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '限购说明',
  `child_explain` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '儿童入场说明',
  `should_known` text COLLATE utf8_unicode_ci COMMENT '购票须知',
  `home_thumb` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '首页缩略图',
  `thumb` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '一般缩略图',
  `detail` text COLLATE utf8_unicode_ci COMMENT '详情',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-上架中 0-下架',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` int(11) DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除  1-删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='门票 产品表';

--
-- Dumping data for table `piaowu_ticket`
--

INSERT INTO `piaowu_ticket` (`id`, `columns`, `cate`, `title`, `sorted`, `is_order`, `is_home`, `deposit`, `distribute_price`, `venues`, `city`, `view_location`, `price`, `vip_price`, `performance_time`, `inventory`, `performance_duration`, `entry_time`, `limit_explain`, `child_explain`, `should_known`, `home_thumb`, `thumb`, `detail`, `status`, `create_at`, `update_at`, `is_delete`) VALUES
(1, 1, 1, '门票', 1, 1, 0, '200.00', '0.00', '成都场馆', 2, '["看台","台下"]', '["200","300"]', '["180","280"]', '["2016-09-14 17:00:05","2016-09-30 17:00:11"]', 0, '2', '提前一小时', '限购说明', '儿童', '购票须知 \r\n1\r\n2', '/Uploads/tickets/2016-09-13/57d7bbe350df5.jpg', '/Uploads/tickets/2016-09-13/57d7bbe728ae2.jpg', '<p>商品详情</p>', 0, '2016-09-13 08:56:39', 0, 0),
(2, 2, 3, '另一个门票', 5, 1, 1, '0.00', '0.00', '昆明', 3, '["看台"]', '["200"]', '["160"]', '["2016-09-29 19:00:23"]', 10, '3', '入场时间', '限购说明', '儿童儿童', '购票须知\r\n购票须知\r\n购票须知\r\n33333', '/Uploads/tickets/2016-09-14/57d8bc9639c11.jpg', '/Uploads/tickets/2016-09-13/57d7c1763f20a.jpg', '<p>顶起asdfsdaf</p><p><br></p><p><img src="http://test07.com/Uploads/wangeditor/upload/2016-09-13/57d7c17e3325f.jpg" alt="9497517bd983876cc9955963" style="max-width:100%;"><br></p><p>hello world</p><p><br></p>', 1, '2016-09-13 09:06:27', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_ticket_cate`
--

CREATE TABLE `piaowu_ticket_cate` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sorted` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='票务城市';

--
-- Dumping data for table `piaowu_ticket_cate`
--

INSERT INTO `piaowu_ticket_cate` (`id`, `name`, `sorted`, `status`) VALUES
(1, '流行', 1, 1),
(3, '摇滚', 1, 1),
(5, '音乐节', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_ticket_city`
--

CREATE TABLE `piaowu_ticket_city` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sorted` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='票务城市';

--
-- Dumping data for table `piaowu_ticket_city`
--

INSERT INTO `piaowu_ticket_city` (`id`, `name`, `sorted`, `status`) VALUES
(2, '成都', 1, 1),
(3, '昆明', 1, 1),
(4, '重庆', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `piaowu_ticket_column`
--

CREATE TABLE `piaowu_ticket_column` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cates` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '栏目下具有的分类 json',
  `intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pics` text COLLATE utf8_unicode_ci COMMENT 'banner',
  `sorted` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='票务栏目';

--
-- Dumping data for table `piaowu_ticket_column`
--

INSERT INTO `piaowu_ticket_column` (`id`, `name`, `cates`, `intro`, `pics`, `sorted`, `status`) VALUES
(1, '演唱会', '["1","3"]', '演唱会的介绍', NULL, 100, 1),
(2, '话剧表演', NULL, '话剧表演的介绍', NULL, 1, 1),
(3, '景点门票', NULL, '景点的介绍', NULL, 1, 1),
(11, '体育赛事', '["4","5"]', '体育赛事的介绍', '["/Uploads/columnbanner/2016-09-12/57d651c4bf5a4.jpg","/Uploads/columnbanner/2016-09-12/57d651c4c989c.jpg","/Uploads/columnbanner/2016-09-12/57d651c4d0bd8.jpg"]', 6, 1),
(12, '新的栏目', '["3","5"]', '栏目的介绍', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `piaowu_admin`
--
ALTER TABLE `piaowu_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_basic_info`
--
ALTER TABLE `piaowu_basic_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_basic_vipprice`
--
ALTER TABLE `piaowu_basic_vipprice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_order_goods`
--
ALTER TABLE `piaowu_order_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_product_property`
--
ALTER TABLE `piaowu_product_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_rebate_log`
--
ALTER TABLE `piaowu_rebate_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_recharge`
--
ALTER TABLE `piaowu_recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_star_brand`
--
ALTER TABLE `piaowu_star_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_star_goods`
--
ALTER TABLE `piaowu_star_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_star_goods_price`
--
ALTER TABLE `piaowu_star_goods_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_star_product_cate`
--
ALTER TABLE `piaowu_star_product_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_ticket`
--
ALTER TABLE `piaowu_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_ticket_cate`
--
ALTER TABLE `piaowu_ticket_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_ticket_city`
--
ALTER TABLE `piaowu_ticket_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_ticket_column`
--
ALTER TABLE `piaowu_ticket_column`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `piaowu_admin`
--
ALTER TABLE `piaowu_admin`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `piaowu_basic_info`
--
ALTER TABLE `piaowu_basic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `piaowu_basic_vipprice`
--
ALTER TABLE `piaowu_basic_vipprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `piaowu_order_goods`
--
ALTER TABLE `piaowu_order_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `piaowu_product_property`
--
ALTER TABLE `piaowu_product_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `piaowu_rebate_log`
--
ALTER TABLE `piaowu_rebate_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `piaowu_recharge`
--
ALTER TABLE `piaowu_recharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `piaowu_star_brand`
--
ALTER TABLE `piaowu_star_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `piaowu_star_goods`
--
ALTER TABLE `piaowu_star_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `piaowu_star_goods_price`
--
ALTER TABLE `piaowu_star_goods_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `piaowu_star_product_cate`
--
ALTER TABLE `piaowu_star_product_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `piaowu_ticket`
--
ALTER TABLE `piaowu_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `piaowu_ticket_cate`
--
ALTER TABLE `piaowu_ticket_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `piaowu_ticket_city`
--
ALTER TABLE `piaowu_ticket_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `piaowu_ticket_column`
--
ALTER TABLE `piaowu_ticket_column`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
