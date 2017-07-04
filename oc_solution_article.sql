/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-04 23:03:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_solution_article`
-- ----------------------------
DROP TABLE IF EXISTS `oc_solution_article`;
CREATE TABLE `oc_solution_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `content` text,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_solution_article
-- ----------------------------
INSERT INTO `oc_solution_article` VALUES ('1', '124', 'asd', 'asdasdasdasda', 'sdasd', 'sadasas', 'dasda', 'sdas', '2017-07-04 20:43:02');
