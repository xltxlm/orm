/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : doc

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2016-11-28 15:43:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品总数目',
  `used` int(10) NOT NULL,
  `status` enum('待处理','上架','下架') DEFAULT '待处理',
  `SIGN_KEY` varchar(255) DEFAULT NULL,
  `add_ip` varchar(255) DEFAULT NULL,
  `add_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_user_name` varchar(255) DEFAULT NULL,
  `update_ip` varchar(200) DEFAULT NULL,
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user_name` varchar(200) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `referer_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='这个是一个商品的介绍';


-- ----------------------------
-- Table structure for goods_logs
-- ----------------------------
DROP TABLE IF EXISTS `goods_logs`;
CREATE TABLE `goods_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goodid` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `used` int(10) unsigned NOT NULL,
  `SIGN_KEY` varchar(255) DEFAULT NULL,
  `add_ip` varchar(255) DEFAULT NULL,
  `add_user_name` varchar(255) DEFAULT NULL,
  `update_ip` varchar(100) DEFAULT NULL,
  `update_user_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_goods_logs` (`goodid`,`name`),
  CONSTRAINT `fk_goods_logs` FOREIGN KEY (`goodid`, `name`) REFERENCES `goods` (`id`, `name`) ON UPDATE CASCADE,
  CONSTRAINT `fk_goods_logs2` FOREIGN KEY (`goodid`) REFERENCES `goods` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

