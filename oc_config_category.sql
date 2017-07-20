/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-21 00:31:53
*/

SET FOREIGN_KEY_CHECKS=0;

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
INSERT INTO `oc_config_category` VALUES ('44', 'OSN 1500B', '', '3', 'Choose OSN 1500B recommended configuration, or select the board you need to configure by yourself', 'OSN 1500B Typical Configuration - Thunder-link.com', 'OSN 1500B typical configuration, select system board, service board to configure yourself', 'OSN1500B, configuration, subrack, system board, service board', '0');
INSERT INTO `oc_config_category` VALUES ('45', 'OSN 2500', '', '2', 'Choose OSN 2500 recommended configuration, or select the board you need to configure by yourself', 'OSN 2500 Typical Configuration - thunder-link.com', 'OSN 2500 typical configuration, select system board, service board to configure yourself', 'OSN2500, configuration, subrack, system board, service board', '26');
INSERT INTO `oc_config_category` VALUES ('43', 'OSN 3500', '', '1', 'Choose OSN 3500 recommended configuration, or select the board you need to configure by yourself', 'OSN 3500 Typical Configuration - thunder-link.com', 'OSN 3500 typical configuration, select system board, service board to configure yourself', 'OSN3500, configuration, subrack, system board, service board', '23');
INSERT INTO `oc_config_category` VALUES ('46', 'MA5683T', '', '1', 'Choose MA5683T recommended configuration, or select the board you need to configure by yourself', 'MA5683T Typical Configuration - Thunder-link.com', 'MA5683T typical configuration, select system board, service board to configure yourself', 'MA5683T, configuration, subrack, system board, service board', '26');
INSERT INTO `oc_config_category` VALUES ('47', 'MA5680T', '', '2', 'Choose MA5680T recommended configuration, or select the board you need to configure by yourself', 'MA5680T Typical Configuration - Thunder-link.com', 'MA5680T typical configuration, select system board, service board to configure yourself', 'MA5680T, configuration, subrack, system board, service board', '25');
INSERT INTO `oc_config_category` VALUES ('48', 'MA5608T', '', '3', 'Choose MA5608T recommended configuration, or select the board you need to configure by yourself', 'MA5608T Typical Configuration - Thunder-link.com', 'MA5608T typical configuration, select system board, service board to configure yourself', 'MA5608T, configuration, subrack, system board, service board', '26');

-- ----------------------------
-- Table structure for `oc_config_product`
-- ----------------------------
DROP TABLE IF EXISTS `oc_config_product`;
CREATE TABLE `oc_config_product` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link_product_id` int(11) NOT NULL,
  `quote_description` text NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_config_product
-- ----------------------------
INSERT INTO `oc_config_product` VALUES ('12', '48', '3', '', 'OSN 1500B Gold Line', 'OSN 1500B Gold Line configuration.&lt;/br&gt;\r\nOSN 1500B Subrack with 2*PIU, 1*AUX, 2*SSQ2CXL4(S-4.1), 1*R1SLQ1(S-1.1), 1*R1EFT4&lt;/br&gt;, 1*PD1(D75S)', '565', '');
INSERT INTO `oc_config_product` VALUES ('13', '43', '1', '', 'OSN 3500 Gold Line', 'OSN 3500 Gold Line configuration, \r\nOSN 3500 Subrack with redundancy 1+1 SXCSA, 1+1 GSCC, 2*SLD64, 1*SLQ16, 1*SLQ4, 1*SLO1, 1*EGS4, 1*EFS0, 1*PQ1', '0', '');
INSERT INTO `oc_config_product` VALUES ('14', '43', '2', '', 'OSN 3500 Silver Line', 'OSN 3500 Silver Line', '0', '');
INSERT INTO `oc_config_product` VALUES ('15', '43', '3', '', 'OSN 3500 Platinum Line', 'OSN 3500 Platinum Line', '0', '');
INSERT INTO `oc_config_product` VALUES ('16', '43', '4', '', 'OSN 3500 Jade Line', 'OSN 3500 Jade Line', '0', '');
INSERT INTO `oc_config_product` VALUES ('17', '44', '1231', 'catalog/20150626002613.png', '111112', '&lt;p&gt;22222222222&lt;/p&gt;', '565', '&lt;p&gt;quote_descriptionquote_descriptionquote_descriptionquote_descriptionquote_descriptionquote_descriptionquote_descriptionquote_descriptionquote_description&lt;/p&gt;');
INSERT INTO `oc_config_product` VALUES ('19', '44', '0', '', 'asdasdasd', '&lt;p&gt;&lt;img src=&quot;/image/editor/image/20160424/1461495734497060.jpg&quot; title=&quot;1461495734497060.jpg&quot; alt=&quot;235102-130G112002730.jpg&quot;/&gt;&lt;/p&gt;', '566', '');
