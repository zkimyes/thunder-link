/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-13 22:35:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_all_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_all_category`;
CREATE TABLE `oc_all_category` (
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `banner_center` int(11) DEFAULT NULL,
  `banner_right_top` int(11) DEFAULT NULL,
  `banner_right_bottom` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_all_category
-- ----------------------------
