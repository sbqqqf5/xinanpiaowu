-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-09-09 09:32:08
-- 服务器版本： 5.7.11
-- PHP Version: 5.6.19

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
-- 表的结构 `piaowu_product_property`
--

CREATE TABLE `piaowu_product_property` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '规格名',
  `type` tinyint(4) NOT NULL COMMENT '1-单行文本 2-多行文本 3-列表选择 4-颜色选择',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '列表选择的值 json'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品规格模型';

--
-- 转存表中的数据 `piaowu_product_property`
--

INSERT INTO `piaowu_product_property` (`id`, `name`, `type`, `value`) VALUES
(1, '大小', 3, '["S","M","L","XL"]'),
(2, '颜色', 4, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `piaowu_star_brand`
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
-- 转存表中的数据 `piaowu_star_brand`
--

INSERT INTO `piaowu_star_brand` (`id`, `name`, `sorted`, `thumb`, `pics`, `status`, `create_at`) VALUES
(1, '周杰伦', 50, '/Uploads/starbrand/2016-09-09/57d22166c1177.jpg', NULL, 1, '2016-09-09 02:41:50'),
(2, '小明', 40, '/Uploads/starbrand/2016-09-09/57d221c13b76a.jpg', NULL, 0, '2016-09-09 02:43:21'),
(3, '小红', 30, '/Uploads/starbrand/2016-09-09/57d222b254e73.jpg', '["/Uploads/starbanner/2016-09-09/57d222b7ec488.jpg","/Uploads/starbanner/2016-09-09/57d222b7f335e.jpg"]', 0, '2016-09-09 02:47:21'),
(4, '买买提', 20, '/Uploads/starbrand/2016-09-09/57d222d532f7b.jpg', '["/Uploads/starbanner/2016-09-09/57d222d987b00.jpg","/Uploads/starbanner/2016-09-09/57d222d98daa8.jpg","/Uploads/starbanner/2016-09-09/57d222d993882.jpg"]', 0, '2016-09-09 02:47:55'),
(6, '3434', 10, '/Uploads/starbrand/2016-09-09/57d26ba6d4cf4.jpg', '["/Uploads/starbanner/2016-09-09/57d26b9e2e18d.jpg","/Uploads/starbanner/2016-09-09/57d26b9e344eb.jpg","",""]', 0, '2016-09-09 06:37:06');

-- --------------------------------------------------------

--
-- 表的结构 `piaowu_star_product_cate`
--

CREATE TABLE `piaowu_star_product_cate` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `sorted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序值',
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '类名',
  `property` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品属性 json'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='明星周边--产品--分类';

--
-- 转存表中的数据 `piaowu_star_product_cate`
--

INSERT INTO `piaowu_star_product_cate` (`id`, `pid`, `sorted`, `name`, `property`) VALUES
(1, 1, 4, '音箱', NULL),
(2, 0, 126, '电器', NULL),
(3, 2, 1, '人桂花', '["1","2"]'),
(4, 0, 3, '地地地', '["1","2"]'),
(5, 0, 60, '地茜要', NULL),
(6, 0, 3, '顶戴 模压', '["2"]'),
(7, 5, 4, '二级分类', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `piaowu_product_property`
--
ALTER TABLE `piaowu_product_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_star_brand`
--
ALTER TABLE `piaowu_star_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaowu_star_product_cate`
--
ALTER TABLE `piaowu_star_product_cate`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `piaowu_product_property`
--
ALTER TABLE `piaowu_product_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `piaowu_star_brand`
--
ALTER TABLE `piaowu_star_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `piaowu_star_product_cate`
--
ALTER TABLE `piaowu_star_product_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
