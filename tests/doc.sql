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
  `add_user_name` varchar(255) DEFAULT NULL,
  `update_user_name` varchar(200) DEFAULT NULL,
  `update_ip` varchar(200) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `referer_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1214 DEFAULT CHARSET=utf8 COMMENT='这个是一个商品的介绍';

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1006', '57d2496d509e2', '0', '0', '待处理', '127.0.0.1@7378902', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1007', '1', '0', '0', '待处理', '127.0.0.1@7378904', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1008', '改造过的1480315157', '102', '0', '待处理', '127.0.0.1@7378907', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1009', '1', '0', '0', '待处理', '127.0.0.1@7378905', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1010', '1', '0', '0', '待处理', '127.0.0.1@7378908', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1011', '1', '0', '0', '待处理', '127.0.0.1@7378909', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1012', '1', '0', '0', '待处理', '127.0.0.1@7378911', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1013', '1', '0', '0', '待处理', '127.0.0.1@7378906', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1014', '1', '0', '0', '待处理', '127.0.0.1@7378910', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1015', '1', '0', '0', '待处理', '127.0.0.1@7378912', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1016', '1', '0', '0', '待处理', '127.0.0.1@7378915', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1017', '1', '0', '0', '待处理', '127.0.0.1@7378914', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1018', '1', '0', '0', '待处理', '127.0.0.1@7378913', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1019', '1', '0', '0', '待处理', '127.0.0.1@7378916', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1020', '1', '0', '0', '待处理', '127.0.0.1@7378917', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1021', '1', '0', '0', '待处理', '127.0.0.1@7378919', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1022', '1', '0', '0', '待处理', '127.0.0.1@7378918', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1023', '1', '0', '0', '待处理', '127.0.0.1@7378920', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1024', '1', '0', '0', '待处理', '127.0.0.1@7378921', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1025', '1', '0', '0', '待处理', '127.0.0.1@7378922', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1026', '1', '0', '0', '待处理', '127.0.0.1@7378924', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1027', '1', '0', '0', '待处理', '127.0.0.1@7378929', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1028', '1', '0', '0', '待处理', '127.0.0.1@7378925', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1029', '1', '0', '0', '待处理', '127.0.0.1@7378928', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1030', '1', '0', '0', '待处理', '127.0.0.1@7378927', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1031', '1', '0', '0', '待处理', '127.0.0.1@7378926', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1032', '1', '0', '0', '待处理', '127.0.0.1@7378923', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1033', '1', '0', '0', '待处理', '127.0.0.1@7378930', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1034', '1', '0', '0', '待处理', '127.0.0.1@7378931', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1035', '1', '0', '0', '待处理', '127.0.0.1@7378933', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1036', '1', '0', '0', '待处理', '127.0.0.1@7378932', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1037', '1', '0', '0', '待处理', '127.0.0.1@7378938', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1038', '1', '0', '0', '待处理', '127.0.0.1@7378937', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1039', '1', '0', '0', '待处理', '127.0.0.1@7378935', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1040', '1', '0', '0', '待处理', '127.0.0.1@7378936', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1041', '1', '0', '0', '待处理', '127.0.0.1@7378939', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1042', '1', '0', '0', '待处理', '127.0.0.1@7378934', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1043', '1', '0', '0', '待处理', '127.0.0.1@7378943', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1044', '1', '0', '0', '待处理', '127.0.0.1@7378942', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1045', '1', '0', '0', '待处理', '127.0.0.1@7378940', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1046', '1', '0', '0', '待处理', '127.0.0.1@7378941', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1047', '1', '0', '0', '待处理', '127.0.0.1@7378945', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1048', '1', '0', '0', '待处理', '127.0.0.1@7378944', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1049', '1', '0', '0', '待处理', '127.0.0.1@7378946', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1050', '1', '0', '0', '待处理', '127.0.0.1@7378947', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1051', '1', '0', '0', '待处理', '127.0.0.1@7378948', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1052', '1', '0', '0', '待处理', '127.0.0.1@7378950', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1053', '1', '0', '0', '待处理', '127.0.0.1@7378949', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1054', '1', '0', '0', '待处理', '127.0.0.1@7379007', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1055', '1', '0', '0', '待处理', '127.0.0.1@7378953', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1056', '1', '0', '0', '待处理', '127.0.0.1@7378951', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1057', '1', '0', '0', '待处理', '127.0.0.1@7379009', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1058', '1', '0', '0', '待处理', '127.0.0.1@7379015', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1059', '1', '0', '0', '待处理', '127.0.0.1@7379004', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1060', '1', '0', '0', '待处理', '127.0.0.1@7379011', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1061', '1', '0', '0', '待处理', '127.0.0.1@7379023', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1062', '1', '0', '0', '待处理', '127.0.0.1@7378952', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1063', '1', '0', '0', '待处理', '127.0.0.1@7379019', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1064', '1', '0', '0', '待处理', '127.0.0.1@7379028', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1065', '1', '0', '0', '待处理', '127.0.0.1@7379025', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1066', '1', '0', '0', '待处理', '127.0.0.1@7379021', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1067', '1', '0', '0', '待处理', '127.0.0.1@7379013', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1068', '1', '0', '0', '待处理', '127.0.0.1@7379017', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1069', '1', '0', '0', '待处理', '127.0.0.1@7379030', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1070', '1', '0', '0', '待处理', '127.0.0.1@7379035', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1071', '1', '0', '0', '待处理', '127.0.0.1@7379032', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1072', '1', '0', '0', '待处理', '127.0.0.1@7379006', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1073', '1', '0', '0', '待处理', '127.0.0.1@7379037', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1074', '1', '0', '0', '待处理', '127.0.0.1@7379040', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1075', '1', '0', '0', '待处理', '127.0.0.1@7379047', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1076', '1', '0', '0', '待处理', '127.0.0.1@7379049', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1077', '1', '0', '0', '待处理', '127.0.0.1@7379042', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1078', '1', '0', '0', '待处理', '127.0.0.1@7379039', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1079', '1', '0', '0', '待处理', '127.0.0.1@7379041', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1080', '1', '0', '0', '待处理', '127.0.0.1@7379054', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1081', '1', '0', '0', '待处理', '127.0.0.1@7379057', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1082', '1', '0', '0', '待处理', '127.0.0.1@7379061', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1083', '1', '0', '0', '待处理', '127.0.0.1@7379053', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1084', '1', '0', '0', '待处理', '127.0.0.1@7379063', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1085', '1', '0', '0', '待处理', '127.0.0.1@7379079', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1086', '1', '0', '0', '待处理', '127.0.0.1@7379065', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1087', '1', '0', '0', '待处理', '127.0.0.1@7379076', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1088', '1', '0', '0', '待处理', '127.0.0.1@7379099', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1089', '1', '0', '0', '待处理', '127.0.0.1@7379107', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1090', '1', '0', '0', '待处理', '127.0.0.1@7379067', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1091', '1', '0', '0', '待处理', '127.0.0.1@7379118', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1092', '1', '0', '0', '待处理', '127.0.0.1@7379082', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1093', '1', '0', '0', '待处理', '127.0.0.1@7379108', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1094', '1', '0', '0', '待处理', '127.0.0.1@7379105', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1095', '1', '0', '0', '待处理', '127.0.0.1@7379097', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1096', '1', '0', '0', '待处理', '127.0.0.1@7379084', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1097', '1', '0', '0', '待处理', '127.0.0.1@7379141', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1098', '1', '0', '0', '待处理', '127.0.0.1@7379092', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1099', '1', '0', '0', '待处理', '127.0.0.1@7379101', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1100', '1', '0', '0', '待处理', '127.0.0.1@7379090', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1101', '1', '0', '0', '待处理', '127.0.0.1@7379102', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1102', '1', '0', '0', '待处理', '127.0.0.1@7379075', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1103', '1', '0', '0', '待处理', '127.0.0.1@7379132', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1104', '1', '0', '0', '待处理', '127.0.0.1@7379086', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1105', '1', '0', '0', '待处理', '127.0.0.1@7379113', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1106', '1', '0', '0', '待处理', '127.0.0.1@7379122', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1107', '1', '0', '0', '待处理', '127.0.0.1@7379088', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1108', '1', '0', '0', '待处理', '127.0.0.1@7379114', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1109', '1', '0', '0', '待处理', '127.0.0.1@7379143', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1110', '1', '0', '0', '待处理', '127.0.0.1@7379069', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1111', '1', '0', '0', '待处理', '127.0.0.1@7379116', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1112', '1', '0', '0', '待处理', '127.0.0.1@7379051', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1113', '1', '0', '0', '待处理', '127.0.0.1@7379163', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1114', '1', '0', '0', '待处理', '127.0.0.1@7379159', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1115', '1', '0', '0', '待处理', '127.0.0.1@7379111', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1116', '1', '0', '0', '待处理', '127.0.0.1@7379148', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1117', '1', '0', '0', '待处理', '127.0.0.1@7379130', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1118', '1', '0', '0', '待处理', '127.0.0.1@7379146', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1119', '1', '0', '0', '待处理', '127.0.0.1@7379174', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1120', '1', '0', '0', '待处理', '127.0.0.1@7379140', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1121', '1', '0', '0', '待处理', '127.0.0.1@7379073', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1122', '1', '0', '0', '待处理', '127.0.0.1@7379134', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1123', '1', '0', '0', '待处理', '127.0.0.1@7379169', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1124', '1', '0', '0', '待处理', '127.0.0.1@7379178', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1125', '1', '0', '0', '待处理', '127.0.0.1@7379186', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1126', '1', '0', '0', '待处理', '127.0.0.1@7379182', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1127', '1', '0', '0', '待处理', '127.0.0.1@7379184', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1128', '1', '0', '0', '待处理', '127.0.0.1@7379176', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1129', '1', '0', '0', '待处理', '127.0.0.1@7379119', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1130', '1', '0', '0', '待处理', '127.0.0.1@7379125', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1131', '1', '0', '0', '待处理', '127.0.0.1@7379152', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1132', '1', '0', '0', '待处理', '127.0.0.1@7379121', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1133', '1', '0', '0', '待处理', '127.0.0.1@7379190', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1134', '1', '0', '0', '待处理', '127.0.0.1@7379071', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1135', '1', '0', '0', '待处理', '127.0.0.1@7379180', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1136', '1', '0', '0', '待处理', '127.0.0.1@7379202', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1137', '1', '0', '0', '待处理', '127.0.0.1@7379229', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1138', '1', '0', '0', '待处理', '127.0.0.1@7379167', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1139', '1', '0', '0', '待处理', '127.0.0.1@7379150', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1140', '1', '0', '0', '待处理', '127.0.0.1@7379154', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1141', '1', '0', '0', '待处理', '127.0.0.1@7379227', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1142', '1', '0', '0', '待处理', '127.0.0.1@7379201', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1143', '1', '0', '0', '待处理', '127.0.0.1@7379233', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1144', '1', '0', '0', '待处理', '127.0.0.1@7379161', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1145', '1', '0', '0', '待处理', '127.0.0.1@7379251', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1146', '1', '0', '0', '待处理', '127.0.0.1@7379257', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1147', '1', '0', '0', '待处理', '127.0.0.1@7379245', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1148', '1', '0', '0', '待处理', '127.0.0.1@7379223', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1149', '1', '0', '0', '待处理', '127.0.0.1@7379199', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1150', '1', '0', '0', '待处理', '127.0.0.1@7379172', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1151', '1', '0', '0', '待处理', '127.0.0.1@7379128', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1152', '1', '0', '0', '待处理', '127.0.0.1@7379136', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1153', '1', '0', '0', '待处理', '127.0.0.1@7379218', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1154', '1', '0', '0', '待处理', '127.0.0.1@7379059', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1155', '1', '0', '0', '待处理', '127.0.0.1@7379138', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1156', '1', '0', '0', '待处理', '127.0.0.1@7379145', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1157', '1', '0', '0', '待处理', '127.0.0.1@7379156', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1158', '1', '0', '0', '待处理', '127.0.0.1@7379231', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1159', '1', '0', '0', '待处理', '127.0.0.1@7379192', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1160', '1', '0', '0', '待处理', '127.0.0.1@7379081', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1161', '1', '0', '0', '待处理', '127.0.0.1@7379095', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1162', '1', '0', '0', '待处理', '127.0.0.1@7379240', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1163', '1', '0', '0', '待处理', '127.0.0.1@7379238', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1164', '1', '0', '0', '待处理', '127.0.0.1@7379225', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1165', '1', '0', '0', '待处理', '127.0.0.1@7379249', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1166', '1', '0', '0', '待处理', '127.0.0.1@7379212', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1167', '1', '0', '0', '待处理', '127.0.0.1@7379270', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1168', '1', '0', '0', '待处理', '127.0.0.1@7379263', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1169', '1', '0', '0', '待处理', '127.0.0.1@7379215', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1170', '1', '0', '0', '待处理', '127.0.0.1@7379210', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1171', '1', '0', '0', '待处理', '127.0.0.1@7379205', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1172', '1', '0', '0', '待处理', '127.0.0.1@7379213', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1173', '1', '0', '0', '待处理', '127.0.0.1@7379222', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1174', '1', '0', '0', '待处理', '127.0.0.1@7379208', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1175', '1', '0', '0', '待处理', '127.0.0.1@7379290', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1176', '1', '0', '0', '待处理', '127.0.0.1@7379247', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1177', '1', '0', '0', '待处理', '127.0.0.1@7379204', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1178', '1', '0', '0', '待处理', '127.0.0.1@7379271', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1179', '1', '0', '0', '待处理', '127.0.0.1@7379300', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1180', '1', '0', '0', '待处理', '127.0.0.1@7379307', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1181', '1', '0', '0', '待处理', '127.0.0.1@7379217', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1182', '1', '0', '0', '待处理', '127.0.0.1@7379253', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1183', '1', '0', '0', '待处理', '127.0.0.1@7379269', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1184', '1', '0', '0', '待处理', '127.0.0.1@7379282', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1185', '1', '0', '0', '待处理', '127.0.0.1@7379288', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1186', '1', '0', '0', '待处理', '127.0.0.1@7379313', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1187', '1', '0', '0', '待处理', '127.0.0.1@7379301', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1188', '1', '0', '0', '待处理', '127.0.0.1@7379283', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1189', '1', '0', '0', '待处理', '127.0.0.1@7379258', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1190', '1', '0', '0', '待处理', '127.0.0.1@7379266', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1191', '1', '0', '0', '待处理', '127.0.0.1@7379274', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1192', '1', '0', '0', '待处理', '127.0.0.1@7379265', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1193', '1', '0', '0', '待处理', '127.0.0.1@7379309', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1194', '1', '0', '0', '待处理', '127.0.0.1@7379273', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1195', '1', '0', '0', '待处理', '127.0.0.1@7379305', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1196', '1', '0', '0', '待处理', '127.0.0.1@7379278', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1197', '1', '0', '0', '待处理', '127.0.0.1@7379292', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1198', '1', '0', '0', '待处理', '127.0.0.1@7379285', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1199', '1', '0', '0', '待处理', '127.0.0.1@7379315', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1200', '1', '0', '0', '待处理', '127.0.0.1@7379260', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1201', '1', '0', '0', '待处理', '127.0.0.1@7379311', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1202', '1', '0', '0', '待处理', '127.0.0.1@7379287', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1203', '1', '0', '0', '待处理', '127.0.0.1@7379294', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1204', '1', '0', '0', '待处理', '127.0.0.1@7379298', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1205', '1', '0', '0', '待处理', '127.0.0.1@7379303', null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1206', null, '0', '0', '待处理', null, null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1207', null, '0', '0', '上架', null, null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1208', 'abc', '10', '2', '待处理', null, null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1209', 'abc', '10', '2', '待处理', null, null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1210', 'abc', '10', '2', '待处理', null, null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1211', 'abc', '10', '2', '上架', null, null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1212', 'abc', '10', '2', '上架', null, null, null, null, null, null, null);
INSERT INTO `goods` VALUES ('1213', 'abc', '10', '2', '上架', null, null, null, null, null, null, null);

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
  `url` varchar(255) DEFAULT NULL,
  `referer_url` varchar(255) DEFAULT NULL,
  `add_ip` varchar(255) DEFAULT NULL,
  `add_user_name` varchar(255) DEFAULT NULL,
  `update_user_name` varchar(100) DEFAULT NULL,
  `update_ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_goods_logs` (`goodid`,`name`),
  CONSTRAINT `fk_goods_logs` FOREIGN KEY (`goodid`, `name`) REFERENCES `goods` (`id`, `name`) ON UPDATE CASCADE,
  CONSTRAINT `fk_goods_logs2` FOREIGN KEY (`goodid`) REFERENCES `goods` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_logs
-- ----------------------------
INSERT INTO `goods_logs` VALUES ('2', '1006', '57d2496d509e2', '0', null, null, null, null, null, null, null);
