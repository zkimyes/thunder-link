/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : new_thunder

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-29 01:55:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_support_comments`
-- ----------------------------
DROP TABLE IF EXISTS `oc_support_comments`;
CREATE TABLE `oc_support_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `content` text,
  `createAt` datetime DEFAULT NULL,
  `arthor` varchar(100) DEFAULT NULL,
  `custom_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_support_comments
-- ----------------------------
INSERT INTO `oc_support_comments` VALUES ('2', '128', '&lt;p&gt;Huawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade InstructionsHuawei OLT MA5600T Series Equipment Upgrade Instructions&lt;/p&gt; ', '2017-08-07 13:50:57', null, null, '0');
INSERT INTO `oc_support_comments` VALUES ('3', '126', '&lt;p&gt;dasdasdasdasdasda&lt;/p&gt; ', '2017-08-08 15:38:16', null, null, '0');
