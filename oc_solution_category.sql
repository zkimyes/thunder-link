/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-07-04 14:49:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for oc_solution_category
-- ----------------------------
DROP TABLE IF EXISTS `oc_solution_category`;
CREATE TABLE `oc_solution_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_desc` text,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_solution_category
-- ----------------------------
INSERT INTO `oc_solution_category` VALUES ('123', '2', '2222', '13', '123123');
INSERT INTO `oc_solution_category` VALUES ('124', '1231', '21', '23123', '12312321');
