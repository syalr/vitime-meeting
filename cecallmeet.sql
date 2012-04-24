-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2012 年 04 月 24 日 17:03
-- 服务器版本: 5.1.56
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cecallmeet`
--
CREATE DATABASE `cecallmeet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cecallmeet`;

-- --------------------------------------------------------

--
-- 表的结构 `vitime_admin`
--

CREATE TABLE IF NOT EXISTS `vitime_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(64) DEFAULT NULL COMMENT 'email',
  `mobile` varchar(16) NOT NULL COMMENT '用户手机号码',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系统管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `vitime_admin`
--

INSERT INTO `vitime_admin` (`id`, `username`, `password`, `email`, `mobile`, `regtime`) VALUES
(1, 'admin', '3ceb33aa48c41c64bf4f550f86b2ba3a', 'gaoomei@gmail.com', '13800138000', '2012-04-21 11:54:57');

-- --------------------------------------------------------

--
-- 表的结构 `vitime_company`
--

CREATE TABLE IF NOT EXISTS `vitime_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(64) DEFAULT NULL,
  `company_mark` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_mark` (`company_mark`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `vitime_company`
--

INSERT INTO `vitime_company` (`id`, `company_name`, `company_mark`) VALUES
(10, '高鸿', 'gh'),
(11, 'ND', 'ND'),
(12, 'ozing公司', 'ozing'),
(13, 'web co.,ltd', 'web'),
(14, 'web co.,ltd', 'chinadrtv'),
(15, 'web co.,ltd', 'chinadrtv2');

-- --------------------------------------------------------

--
-- 表的结构 `vitime_meeting`
--

CREATE TABLE IF NOT EXISTS `vitime_meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `title` varchar(64) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `type` char(1) DEFAULT '0' COMMENT '会议类型:0为公共会议，1为企业会议',
  `state` char(1) DEFAULT '1' COMMENT '0：删除，1 可修改，2 锁定',
  `password` varchar(32) DEFAULT NULL,
  `usercount` int(8) NOT NULL DEFAULT '0',
  `time_length` smallint(6) NOT NULL DEFAULT '0' COMMENT '会议时间长度',
  PRIMARY KEY (`id`),
  KEY `start_time` (`start_time`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `vitime_meeting`
--

INSERT INTO `vitime_meeting` (`id`, `company_id`, `user_id`, `title`, `start_time`, `end_time`, `type`, `state`, `password`, `usercount`, `time_length`) VALUES
(1, 0, 24, '测试会议', '2012-04-11 16:25:50', '2012-04-11 16:25:53', '0', NULL, NULL, 0, 0),
(2, 0, 15, 'tw测试会议', '2012-04-12 16:11:47', '2012-04-12 16:11:50', '0', NULL, NULL, 22, 0),
(3, 0, 15, 'tw测试会议1', '2012-04-12 16:11:47', '2012-04-12 16:11:50', '0', NULL, NULL, 22, 0),
(4, 0, 15, '啊啊啊啊啊啊啊啊', '2012-04-12 16:20:01', '2012-04-12 16:20:03', '0', NULL, NULL, 11, 0),
(5, 0, 15, '巴巴爸爸', '2012-04-12 16:20:38', '2012-04-12 16:20:41', '0', NULL, NULL, 33, 0),
(6, 0, 15, '淡淡的', '2012-04-12 16:22:09', '2012-04-12 16:22:10', '0', NULL, NULL, 44, 0),
(7, 0, 15, '刚刚刚', '2012-04-12 16:24:30', '2012-04-12 16:24:32', '0', NULL, NULL, 33, 0),
(8, 0, 15, '11111', '2012-04-12 16:25:55', '2012-04-12 16:25:57', '0', NULL, NULL, 11, 0),
(9, 0, 15, '11111', '2012-04-12 16:25:55', '2012-04-12 16:25:57', '0', NULL, NULL, 11, 0),
(10, 0, 15, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', NULL, NULL, 0, 0),
(11, 10, 16, '企业会议', '2012-04-12 17:06:50', '2012-04-12 17:06:54', '0', NULL, NULL, 0, 0),
(12, 10, 16, '2222222', '2012-04-12 17:10:25', '2012-04-12 17:10:27', '0', NULL, NULL, 0, 0),
(13, 10, 16, '33333333', '2012-04-12 17:10:52', '2012-04-12 17:10:54', '0', NULL, NULL, 0, 0),
(14, 10, 16, '444', '2012-04-12 17:12:19', '2012-04-12 17:12:21', '0', NULL, NULL, 0, 0),
(15, 0, 16, '11111', '2012-04-12 17:14:21', '2012-04-12 17:14:23', '0', NULL, '33333333', 33, 0),
(16, 10, 16, '444444', '2012-04-12 17:14:51', '2012-04-12 17:14:53', '0', NULL, NULL, 0, 0),
(17, 10, 16, '11111', '2012-04-12 17:16:23', '2012-04-12 17:16:25', '0', NULL, NULL, 0, 0),
(18, 10, 16, '222222222', '2012-04-12 17:17:32', '2012-04-12 17:17:34', '0', NULL, NULL, 0, 0),
(19, 10, 16, '3333333333', '2012-04-12 17:25:01', '2012-04-12 17:25:03', '0', NULL, NULL, 0, 0),
(20, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(21, 0, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(22, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(23, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(24, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(25, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(26, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(27, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(28, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(29, 0, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(30, 0, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(31, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(32, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(33, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(34, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(35, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(36, 10, 16, '22222222', '2012-04-12 17:25:25', '2012-04-12 17:25:27', '0', NULL, NULL, 0, 0),
(37, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(38, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(39, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(40, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(41, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(42, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(43, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(44, 10, 16, '333333333', '2012-04-12 17:37:53', '2012-04-12 17:37:55', '0', NULL, NULL, 0, 0),
(45, 10, 16, '1111111111', '2012-04-12 17:48:44', '2012-04-12 17:48:46', '0', NULL, NULL, 0, 0),
(46, 10, 16, '222222222', '2012-04-12 17:49:00', '2012-04-12 17:49:01', '0', NULL, NULL, 0, 0),
(47, 10, 16, '11111111', '2012-04-12 18:01:03', '2012-04-12 18:01:05', '0', NULL, NULL, 0, 0),
(48, 12, 26, 'test测试会议', '2012-04-25 08:00:00', '2012-04-25 09:00:00', '1', '1', NULL, 2, 60),
(49, 12, 31, '明日产品发布会', '1970-01-01 08:33:32', '1970-01-01 08:33:32', '1', '0', NULL, 1, 0),
(50, 12, 31, '明天项目上线', '2012-04-26 17:00:00', '2012-04-26 17:40:00', '1', '1', NULL, 2, 40),
(51, 12, 31, '明天开会', '2012-04-24 16:40:00', '2012-04-24 17:20:00', '1', '1', NULL, 1, 40),
(52, 12, 31, '明天开二次会议', '2012-04-24 13:35:00', '2012-04-24 15:05:00', '1', '1', NULL, 1, 90),
(53, 12, 31, '预约公共会议', '2012-04-24 21:20:00', '2012-04-24 21:50:00', '0', '1', '123', 12, 0);

-- --------------------------------------------------------

--
-- 表的结构 `vitime_meeting_userlog`
--

CREATE TABLE IF NOT EXISTS `vitime_meeting_userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meet_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT NULL COMMENT '如果该字段为空，则说明该人员没有参加这场会议',
  PRIMARY KEY (`meet_id`,`user_id`),
  UNIQUE KEY `userlog_id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `vitime_meeting_userlog`
--

INSERT INTO `vitime_meeting_userlog` (`id`, `meet_id`, `user_id`, `date`) VALUES
(7, 48, 26, NULL),
(6, 48, 29, NULL),
(8, 50, 26, NULL),
(9, 50, 29, NULL),
(4, 51, 29, NULL),
(12, 52, 26, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `vitime_member`
--

CREATE TABLE IF NOT EXISTS `vitime_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(24) DEFAULT NULL COMMENT '用户名称',
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) DEFAULT NULL,
  `company_id` varchar(16) NOT NULL DEFAULT '' COMMENT '公司ID',
  `v_money` decimal(12,2) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `priority` char(1) DEFAULT '0' COMMENT '优先级，1 企业管理与员，2 企业普通员工',
  `status` char(1) DEFAULT '1',
  `create_time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`username`,`company_id`),
  UNIQUE KEY `member_id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `vitime_member`
--

INSERT INTO `vitime_member` (`id`, `name`, `username`, `password`, `company_id`, `v_money`, `mobile`, `email`, `priority`, `status`, `create_time`) VALUES
(16, NULL, 'add1', 'eca3f2a96c228f9015ccfd4ae6f7ebda', '10', NULL, '13609501926', 'add1@qq.com', '2', NULL, '1334045904'),
(17, NULL, 'add2', 'e7d12b0c17d58b491706fdada281b4a7', '10', NULL, '13555555555', 'add2@qq.com', '2', NULL, '1334046026'),
(18, NULL, 'add3', '98d8ac32d54d6cc22c3af07afa06897a', '10', NULL, '1222222222', 'add3@qq.com', '2', NULL, '1334046390'),
(19, NULL, 'add4', 'ba74da4320275b751517a55bc0cbea9c', '10', NULL, '123333333', 'add4@qq.com', '2', NULL, '1334046504'),
(20, NULL, 'add5', 'b4dc0bda68e29c85195eda73391613ae', '10', NULL, '1111111111', 'add5@qq.com', '2', NULL, '1334046650'),
(21, NULL, 'add6', '2840cabb54a08bb8f55c638832d6f347', '10', NULL, '222222222', 'add6@qq.com', '2', NULL, '1334046869'),
(22, NULL, 'add7', 'a6be4bc70b254219249aa1eee6a8887e', '10', NULL, '15555555', 'add7@qq.com', '2', NULL, '1334046956'),
(30, NULL, 'faiinlove', '9631efa73051a3064e93c912b3bbf0ed', '15', NULL, '13800138000', 'web@qq.2com', '1', '0', '1335071487'),
(26, NULL, 'gray', 'a09c1360ce6654f8ce6fed34242cb226', '12', NULL, '13800138000', 'gaoomei@gmail.com', '1', '1', '2012-04-21 16:15'),
(31, '劳力', 'laoli', 'c094d122e04056bdc55972b094a7afeb', '12', NULL, '13800138000', 'adfad@adfa.com', '2', '0', '1335074076'),
(29, '老刘', 'laoliu2', '80484bb9da36a1a18afc1fc8d7dae486', '12', NULL, '13800138000', 'laoliu@qq.com', '2', '1', '1335022340'),
(28, NULL, 'liu', '393bec92acd3f546298273ba3a0ce007', '14', NULL, '13800138000', 'web@qq.com', '0', NULL, '1335001611'),
(25, NULL, 'test4', '86985e105f79b95d6bc918fb45ec7727', '10', NULL, '44444444', 'test4@qq.com', '2', NULL, '1334133058'),
(15, NULL, 'tw198611', 'fbe990e973f1ee9732c5226f9a6ae78f', '10', NULL, '13609501926', 'tw198611@163.com', '1', NULL, '1334023459'),
(23, NULL, 'tww', 'fc89965d47de0e136dc0d29e7e19c2ba', '11', NULL, '11111111', 'tww@qq.com', '1', NULL, '1334131799'),
(24, NULL, 'tww1', '4fec87a124146259a4d2aba210a197c3', '11', NULL, '11111111', 'tww1@qq.com', '2', NULL, '1334131856'),
(27, NULL, 'web', 'b14f67117248667af5de3ec19a38ed8e', '13', NULL, '13800138000', 'web@qq.com', '0', NULL, '1335000359');

-- --------------------------------------------------------

--
-- 表的结构 `vitime_pay_records`
--

CREATE TABLE IF NOT EXISTS `vitime_pay_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meet_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `r_money` decimal(12,2) DEFAULT NULL,
  `pay_time` varchar(16) DEFAULT NULL,
  `pay_type` varchar(16) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `vitime_pay_records`
--

