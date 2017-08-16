/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : sayyas

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2017-08-16 17:45:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for db_project
-- ----------------------------
DROP TABLE IF EXISTS `db_project`;
CREATE TABLE `db_project` (
  `id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `report_time` date DEFAULT NULL,
  `contact` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT '联系人',
  `contact_tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '项目地址',
  `update_time` datetime DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of db_project
-- ----------------------------
INSERT INTO `db_project` VALUES ('2b29740e4a0346cb815fdb84b64c9d54', 'lijian', '2017-06-13', '陈总', '18706177777', '锦园27#', null, '2017-08-16 17:01:37');
INSERT INTO `db_project` VALUES ('60bd234ae3ef41dea8129d1cc7445fda', 'lijian', '2017-08-01', '谢总', '13506184256', '景园6#', null, '2017-08-16 17:00:00');
INSERT INTO `db_project` VALUES ('9a6dc208726142689b4e01ca868d106d', 'lijian', '2017-07-11', '过总', '13706172960', '檀溪湾261#', null, '2017-08-16 16:55:49');

-- ----------------------------
-- Table structure for db_schedule
-- ----------------------------
DROP TABLE IF EXISTS `db_schedule`;
CREATE TABLE `db_schedule` (
  `id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '所属项目',
  `content` text COLLATE utf8_unicode_ci,
  `create_time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of db_schedule
-- ----------------------------
INSERT INTO `db_schedule` VALUES ('0f2decbe338b4851ab5e101a89ca433a', '9a6dc208726142689b4e01ca868d106d', '在工地谈过价格，影响还不错', '2017-07-20');
INSERT INTO `db_schedule` VALUES ('2d1f3ed5ae754d928ca999044bf9929e', '9a6dc208726142689b4e01ca868d106d', '檀溪湾203王总再次介绍，对产品很满意。', '2017-07-12');
INSERT INTO `db_schedule` VALUES ('50f6b0d339dc46e39908e09574a3f11a', '60bd234ae3ef41dea8129d1cc7445fda', '客户初步了解过，有介绍人', '2017-06-20');
INSERT INTO `db_schedule` VALUES ('555a63284b3c4afa9aa3359a3412e267', '60bd234ae3ef41dea8129d1cc7445fda', '四月初约过，说7月份来了解', '2017-05-17');
INSERT INTO `db_schedule` VALUES ('57998680c3e94ffeb907e9e856dc89c2', '2b29740e4a0346cb815fdb84b64c9d54', '金桥市场老板，为人土豪', '2017-08-15');
INSERT INTO `db_schedule` VALUES ('d70929d4f5be4601aad0502d2618b06b', '9a6dc208726142689b4e01ca868d106d', '由物业经理介绍，客户了解过产品工地。印象比较贵，听不进去介绍', '2017-07-04');

-- ----------------------------
-- Table structure for db_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `db_userinfo`;
CREATE TABLE `db_userinfo` (
  `uuid` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '123456' COMMENT '密码',
  `uname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '性别 0-女 1-男',
  `head_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` int(1) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '职位',
  `update_time` datetime DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of db_userinfo
-- ----------------------------
INSERT INTO `db_userinfo` VALUES ('dean', '123456', '迪恩', '11211311456', null, null, null, null, null, '2017-08-15 13:55:43');
INSERT INTO `db_userinfo` VALUES ('lijian', '123456', '李健', '18352566686', 'http://v1.qzone.cc/avatar/201504/04/17/40/551fb1a2b79b6736.jpg%21200x200.jpg', '1', null, '2', null, '2017-08-15 17:39:19');
