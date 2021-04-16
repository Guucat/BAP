/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50726
Source Host           : localhost:3307
Source Database       : iip

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-12-18 19:41:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for iip_source
-- ----------------------------
DROP TABLE IF EXISTS `iip_source`;
CREATE TABLE `iip_source` (
  `source_id` varchar(10) NOT NULL,
  `source_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `source_url` varchar(2038) DEFAULT NULL,
  `create_time` varchar(20) DEFAULT NULL,
  `update_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of iip_source
-- ----------------------------
INSERT INTO `iip_source` VALUES ('1', '国际免疫遗传学系统（IMGT）', 'http://www.imgt.org', '2020/9/23 12:28:31', '2020/9/24 22:38:55');
INSERT INTO `iip_source` VALUES ('2', '抗原表位数据库（IEDB）', 'http://www.iedb.org', '2020/9/26 09:24:18', '2020/10/2 23:42:56');
INSERT INTO `iip_source` VALUES ('3', '抗体结构数据库（SAbDab）', 'http://opig.stats.ox.ac.uk/webapps/newsabdab/sabdab/', '2020/10/23 05:51:35', '2020/10/30 19:53:32');
INSERT INTO `iip_source` VALUES ('4', 'SARS病毒S蛋白的B细胞表位预测', 'https://web.expasy.org/abcd/', '2020/10/29 10:24:36', '2020/11/05 13:24:46');
INSERT INTO `iip_source` VALUES ('5', '单域抗体数据库（sdAb-db）', 'http://www.sdab-db.ca', '2020/11/4 12:17:28', '2020/11/9 23:19:43');

-- ----------------------------
-- Table structure for iip_tool
-- ----------------------------
DROP TABLE IF EXISTS `iip_tool`;
CREATE TABLE `iip_tool` (
  `tool_id` varchar(10) NOT NULL,
  `tool_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tool_url` varchar(2038) DEFAULT NULL,
  `create_time` varchar(20) DEFAULT NULL,
  `update_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`tool_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of iip_tool
-- ----------------------------
INSERT INTO `iip_tool` VALUES ('1', '抗体序列与结构分析（abYsis）', 'http://www.abysis.org/abysis/index.html', '2020/11/4 13:10:21', '2020/11/14 12:21:05');
INSERT INTO `iip_tool` VALUES ('2', '抗体序列编号及CDR定界工具（AbRSA）', 'http://cao.labshare.cn/AbRSA/index.html', '2020/11/6 15:24:49', '2020/11/9 14:49:30');
INSERT INTO `iip_tool` VALUES ('3', '免疫球蛋白序列比对工具（IgBlast）', 'https://www.ncbi.nlm.nih.gov/projects/igblast/', '2020/11/15 17:48:25', '2020/12/12 23:52:37');
INSERT INTO `iip_tool` VALUES ('4', '抗体预测工具集（SAbPred）', 'http://opig.stats.ox.ac.uk/webapps/newsabdab/sabpred/', '2020/11/24 19:36:57', '2020/12/1 22:34:47');

-- ----------------------------
-- Table structure for iip_user
-- ----------------------------
DROP TABLE IF EXISTS `iip_user`;
CREATE TABLE `iip_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `user_role` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `user_pwd` varchar(32) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `user_phone` char(11) DEFAULT NULL,
  `create_time` varchar(20) DEFAULT NULL,
  `update_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of iip_user
-- ----------------------------
INSERT INTO `iip_user` VALUES ('1', '小王', '游客', '123456', '1773852344@qq.com', '13423442442', '2020/10/5 11:54:06', '2020/10/5 11:54:06');
INSERT INTO `iip_user` VALUES ('2', '小红', '游客', '123456', '1451644614@qq.com', '15463548124', '2020/10/10 10:25:05', '2020/10/11 12:11:44');
INSERT INTO `iip_user` VALUES ('3', '小强', '注释员', '123456', '15165464@qq.com', '17458422655', '2020/10/13 20:51:41', '2020/10/15 23:21:14');
INSERT INTO `iip_user` VALUES ('4', '小明', '学生', '123456', '1545344635@qq.com', '15845265772', '2020/10/13 23:48:33', '2020/10/14 08:30:55');
INSERT INTO `iip_user` VALUES ('5', '李华', '老师', '123456', '2416413348@qq.com', '16846838475', '2020/10/25 09:41:57', '2020/11/11 21:35:07');
