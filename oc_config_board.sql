/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-25 00:10:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_config_board`
-- ----------------------------
DROP TABLE IF EXISTS `oc_config_board`;
CREATE TABLE `oc_config_board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `border_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_config_board
-- ----------------------------
INSERT INTO `oc_config_board` VALUES ('1', 'N4GSCC', null, null, '1');
INSERT INTO `oc_config_board` VALUES ('2', 'SSN6GSCC', null, null, '2');

-- ----------------------------
-- Table structure for `oc_config_board_type`
-- ----------------------------
DROP TABLE IF EXISTS `oc_config_board_type`;
CREATE TABLE `oc_config_board_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_config_board_type
-- ----------------------------
INSERT INTO `oc_config_board_type` VALUES ('1', 'Sysrtem Board', '1', null);
INSERT INTO `oc_config_board_type` VALUES ('2', 'STM-1 Service', '2', null);
INSERT INTO `oc_config_board_type` VALUES ('3', 'STM-4 Service', '2', null);
INSERT INTO `oc_config_board_type` VALUES ('4', 'STM-16 Service', '2', null);
INSERT INTO `oc_config_board_type` VALUES ('5', 'Ethernet Service', '2', null);
INSERT INTO `oc_config_board_type` VALUES ('6', 'PDH Service', '2', null);

-- ----------------------------
-- Table structure for `oc_config_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_config_category`;
CREATE TABLE `oc_config_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `banner` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_config_category
-- ----------------------------
INSERT INTO `oc_config_category` VALUES ('44', 'OSN 1500B', '', '312312', 'Choose OSN 1500B recommended configuration, or select the board you need to configure by yourself', 'OSN 1500B Typical Configuration - Thunder-link.com', 'OSN 1500B typical configuration, select system board, service board to configure yourself', 'OSN1500B, configuration, subrack, system board, service board', '7');
INSERT INTO `oc_config_category` VALUES ('45', 'OSN 2500', '', '2', 'Choose OSN 2500 recommended configuration, or select the board you need to configure by yourself', 'OSN 2500 Typical Configuration - thunder-link.com', 'OSN 2500 typical configuration, select system board, service board to configure yourself', 'OSN2500, configuration, subrack, system board, service board', '26');
INSERT INTO `oc_config_category` VALUES ('43', 'OSN 3500', '', '1', 'Choose OSN 3500 recommended configuration, or select the board you need to configure by yourself', 'OSN 3500 Typical Configuration - thunder-link.com', 'OSN 3500 typical configuration, select system board, service board to configure yourself', 'OSN3500, configuration, subrack, system board, service board', '23');
INSERT INTO `oc_config_category` VALUES ('46', 'MA5683T', '', '1', 'Choose MA5683T recommended configuration, or select the board you need to configure by yourself', 'MA5683T Typical Configuration - Thunder-link.com', 'MA5683T typical configuration, select system board, service board to configure yourself', 'MA5683T, configuration, subrack, system board, service board', '26');
INSERT INTO `oc_config_category` VALUES ('47', 'MA5680T', '', '2', 'Choose MA5680T recommended configuration, or select the board you need to configure by yourself', 'MA5680T Typical Configuration - Thunder-link.com', 'MA5680T typical configuration, select system board, service board to configure yourself', 'MA5680T, configuration, subrack, system board, service board', '25');
INSERT INTO `oc_config_category` VALUES ('48', 'MA5608T', '', '3', 'Choose MA5608T recommended configuration, or select the board you need to configure by yourself', 'MA5608T Typical Configuration - Thunder-link.com', 'MA5608T typical configuration, select system board, service board to configure yourself', 'MA5608T, configuration, subrack, system board, service board', '26');

-- ----------------------------
-- Table structure for `oc_config_typical`
-- ----------------------------
DROP TABLE IF EXISTS `oc_config_typical`;
CREATE TABLE `oc_config_typical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link_product_id` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `blueprint` varchar(255) NOT NULL,
  `link_boards` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
