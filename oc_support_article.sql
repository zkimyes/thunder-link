/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-29 01:55:58
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
  `is_comment` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_support_article
-- ----------------------------
INSERT INTO `oc_support_article` VALUES ('2', '128', 'Huawei OLT MA5600T Series Equipment Upgrade Instructions', 'Huawei OLT MA5600T Series Equipment Upgrade Instructions', 'Huawei OLT MA5600T Series Equipment Upgrade Instructions', 'Huawei OLT MA5600T Series Equipment Upgrade Instructions', 'Huawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equip', '&lt;p&gt;Huawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade Instructions&lt;/p&gt; ', '2017-08-07 13:50:57', 'catalog/OSN 3500_1-1800x973.JPG', '6', '42,47', '0');
INSERT INTO `oc_support_article` VALUES ('3', '126', 'asdasdasddas', 'asdasdasddas', 'dasdasdasdasd', 'asdasdasdasdasd asdasd', 'asdasdasdasdas', '&lt;p&gt;dasdasdasdasdasda&lt;/p&gt; ', '2017-08-08 15:38:16', '', '6', '', '0');
