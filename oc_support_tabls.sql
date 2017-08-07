/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-07 16:20:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_support_article`
-- ----------------------------
DROP TABLE IF EXISTS `oc_support_article`;
CREATE TABLE `oc_support_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `content` text,
  `createAt` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `banner_id` int(11) DEFAULT NULL,
  `related_product_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_support_article
-- ----------------------------
INSERT INTO `oc_support_article` VALUES ('2', '126', 'asdasdasdasdasdasdasds', 'asdasdasdasdasdasdasds', 'asdasdas', 'dasdas', 'dasdasd', '&lt;p&gt;asdasdasdasd&lt;/p&gt;\n', '2017-08-07 13:50:57', 'catalog/20150723000650.png', '7', '42');

-- ----------------------------
-- Table structure for `oc_support_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_support_category`;
CREATE TABLE `oc_support_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_desc` text,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_support_category
-- ----------------------------
INSERT INTO `oc_support_category` VALUES ('125', 'Access Network', 'Access Network', 'Access Network', '');
INSERT INTO `oc_support_category` VALUES ('126', 'Transmission Network', 'Transmission Network', 'Transmission Network', '');
INSERT INTO `oc_support_category` VALUES ('127', 'Data Communication', 'Data Communication', 'Data Communication', 'Data Communication');

-- ----------------------------
-- Table structure for `oc_support_tag_relative`
-- ----------------------------
DROP TABLE IF EXISTS `oc_support_tag_relative`;
CREATE TABLE `oc_support_tag_relative` (
  `support_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oc_support_tag_relative
-- ----------------------------
INSERT INTO `oc_support_tag_relative` VALUES ('2', '3');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '7');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '9');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '3');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '7');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '9');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '3');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '7');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '9');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '3');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '7');
INSERT INTO `oc_support_tag_relative` VALUES ('2', '9');

-- ----------------------------
-- Table structure for `oc_support_tags`
-- ----------------------------
DROP TABLE IF EXISTS `oc_support_tags`;
CREATE TABLE `oc_support_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oc_support_tags
-- ----------------------------
INSERT INTO `oc_support_tags` VALUES ('1', 'tagss');
INSERT INTO `oc_support_tags` VALUES ('2', 'dd');
INSERT INTO `oc_support_tags` VALUES ('3', 'ww');
INSERT INTO `oc_support_tags` VALUES ('4', 'ww22');
INSERT INTO `oc_support_tags` VALUES ('5', 'asd');
INSERT INTO `oc_support_tags` VALUES ('6', 'wwww');
INSERT INTO `oc_support_tags` VALUES ('7', 'asdasda');
INSERT INTO `oc_support_tags` VALUES ('8', 'wwwwaaa');
INSERT INTO `oc_support_tags` VALUES ('9', 'dawdawd');
INSERT INTO `oc_support_tags` VALUES ('10', 'wwadasd');
INSERT INTO `oc_support_tags` VALUES ('11', 'wetwetwvsfs');
INSERT INTO `oc_support_tags` VALUES ('12', 'asdadasdasd');
INSERT INTO `oc_support_tags` VALUES ('13', 'adwadwasdaw');
INSERT INTO `oc_support_tags` VALUES ('14', 'asdasdwadaw');
INSERT INTO `oc_support_tags` VALUES ('15', 'wwwwwadd');
INSERT INTO `oc_support_tags` VALUES ('16', 'ddww');
INSERT INTO `oc_support_tags` VALUES ('17', 'k');
INSERT INTO `oc_support_tags` VALUES ('18', 'y');
