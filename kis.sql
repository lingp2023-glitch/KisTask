/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50723
Source Host           : 10.0.0.11:3306
Source Database       : kistask

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2026-01-24 17:24:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_account
-- ----------------------------
DROP TABLE IF EXISTS `sys_account`;
CREATE TABLE `sys_account` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(64) DEFAULT NULL,
  `roleid` int(11) DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `headimg` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rand_code` varchar(8) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `token_time` datetime DEFAULT NULL,
  `token_exptime` datetime DEFAULT NULL,
  `refresh_token` varchar(32) DEFAULT NULL,
  `is_ghsub` tinyint(4) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT '0',
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_account
-- ----------------------------
INSERT INTO `sys_account` VALUES ('1', null, '1', '1', '系统管理员', null, '13800138000', '1f1955e323760c5a74a2f4186541a23c', '3611', '281c245783d8f12298374f70d0aafbfb', '2026-01-24 16:18:27', '2026-01-24 18:18:27', '2ddfa082556f8530a0ebcb55fd03aee7', '0', null, '0', null);
INSERT INTO `sys_account` VALUES ('2', 'oB34U6C7APZkC5YmR7G4tjit1sPs', '1', '1', '林桂平', null, '13560401996', '1f1955e323760c5a74a2f4186541a23c', '1104', '39e492f3321eae10d939e7efd1f90f66', '2025-01-13 11:13:44', '2025-01-13 13:13:44', 'badc5604243d5e1534067bf887b7e35b', '1', '2023-12-22 10:49:49', '0', null);
INSERT INTO `sys_account` VALUES ('3', 'oB34U6Gxn3F41Uxt-1yzoetFgwRM', '1', '1', '林家振', null, '13229020837', 'c21d596c8df214f9e899f59d44517e8b', '5558', '1cb7dbdef8834db64150f54af4e61ab7', '2026-01-23 15:02:11', '2026-01-23 17:02:11', 'e38150e81ec45105777d87b352cc36eb', '1', '2024-06-03 16:30:59', '0', null);

-- ----------------------------
-- Table structure for sys_res_audio
-- ----------------------------
DROP TABLE IF EXISTS `sys_res_audio`;
CREATE TABLE `sys_res_audio` (
  `audio_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `group_id` int(4) DEFAULT '0',
  `file` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(36) DEFAULT NULL,
  `duration` varchar(36) DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `is_del` tinyint(4) DEFAULT '0',
  `del_time` datetime DEFAULT NULL,
  PRIMARY KEY (`audio_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_res_audio
-- ----------------------------

-- ----------------------------
-- Table structure for sys_res_doc
-- ----------------------------
DROP TABLE IF EXISTS `sys_res_doc`;
CREATE TABLE `sys_res_doc` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `author` varchar(64) DEFAULT NULL,
  `title` varchar(200) DEFAULT '',
  `summary` varchar(200) DEFAULT '',
  `cover` varchar(255) DEFAULT '',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `create_time` datetime DEFAULT NULL,
  `is_del` tinyint(4) DEFAULT '0',
  `del_time` datetime DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_res_doc
-- ----------------------------

-- ----------------------------
-- Table structure for sys_res_file
-- ----------------------------
DROP TABLE IF EXISTS `sys_res_file`;
CREATE TABLE `sys_res_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `group_id` int(4) DEFAULT '0',
  `file` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(36) DEFAULT NULL,
  `file_type` varchar(36) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `is_del` tinyint(4) DEFAULT '0',
  `del_time` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_res_file
-- ----------------------------

-- ----------------------------
-- Table structure for sys_res_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_res_group`;
CREATE TABLE `sys_res_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `group_type` tinyint(4) DEFAULT '0' COMMENT '1图片 2音频 3视频 4文件 5文案',
  `group_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_res_group
-- ----------------------------

-- ----------------------------
-- Table structure for sys_res_image
-- ----------------------------
DROP TABLE IF EXISTS `sys_res_image`;
CREATE TABLE `sys_res_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `shop_id` int(11) DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `src_file` varchar(255) DEFAULT '',
  `min_file` varchar(255) DEFAULT '',
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `media_id` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_del` tinyint(4) DEFAULT '0',
  `del_time` datetime DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_res_image
-- ----------------------------
INSERT INTO `sys_res_image` VALUES ('1', '1', '0', '0', 'upload/image/2025/12/176611602619282.png', 'upload/image/thumb/2025/12/176611602619282.png', 'logo.png', '162644', '2025-12-19 11:47:09', null, null, '0', null);
INSERT INTO `sys_res_image` VALUES ('2', '1', '0', '0', 'upload/image/2025/12/176611779254692.png', 'upload/image/thumb/2025/12/176611779254692.png', '流程图例子.png', '9358', '2025-12-19 12:16:35', null, null, '0', null);
INSERT INTO `sys_res_image` VALUES ('3', '1', '0', '0', 'upload/image/2026/01/176822409986317.png', 'upload/image/thumb/2026/01/176822409986317.png', '93E5F1A8-A8F3-43B7-8D81-535DB4CAC500.png', '62071', '2026-01-12 21:21:46', null, null, '0', null);
INSERT INTO `sys_res_image` VALUES ('4', '1', '0', '0', 'upload/image/2026/01/176822409994282.png', 'upload/image/thumb/2026/01/176822409994282.png', '17655E43-F5CB-4A15-A60D-D58036C0C48F.png', '76455', '2026-01-12 21:21:46', null, null, '0', null);
INSERT INTO `sys_res_image` VALUES ('5', '1', '0', '0', 'upload/image/2026/01/176822409995868.png', 'upload/image/thumb/2026/01/176822409995868.png', '18A39DA8-D8F2-4A03-95FD-96B521ADDEBF.png', '135518', '2026-01-12 21:21:47', null, null, '0', null);
INSERT INTO `sys_res_image` VALUES ('6', '1', '0', '0', 'upload/image/2026/01/176822409992163.png', 'upload/image/thumb/2026/01/176822409992163.png', '22BBC96D-A8AB-429F-9FCD-E5FECA714A42.png', '66106', '2026-01-12 21:21:47', null, null, '0', null);
INSERT INTO `sys_res_image` VALUES ('7', '1', '0', '0', 'upload/image/2026/01/176822409953028.png', 'upload/image/thumb/2026/01/176822409953028.png', '704F07F2-4C7F-415D-A60F-C1FD9C95B157.png', '184191', '2026-01-12 21:21:47', null, null, '0', null);

-- ----------------------------
-- Table structure for sys_res_video
-- ----------------------------
DROP TABLE IF EXISTS `sys_res_video`;
CREATE TABLE `sys_res_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `cover` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(36) DEFAULT NULL,
  `duration` varchar(36) DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `is_del` tinyint(4) DEFAULT '0',
  `del_time` datetime DEFAULT NULL,
  PRIMARY KEY (`video_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_res_video
-- ----------------------------

-- ----------------------------
-- Table structure for sys_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) DEFAULT NULL,
  `role_grade` varchar(200) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_role
-- ----------------------------
INSERT INTO `sys_role` VALUES ('1', '系统管理员', '[\"1_1\",\"1_2\",\"1_3\",\"1_4\",\"2\",\"3\",\"4\",\"1\"]', '2020-06-11 14:18:09');
INSERT INTO `sys_role` VALUES ('2', '员工', '[\"2\",\"3\",\"4\"]', '2023-10-15 16:58:13');

-- ----------------------------
-- Table structure for sys_wechat_media
-- ----------------------------
DROP TABLE IF EXISTS `sys_wechat_media`;
CREATE TABLE `sys_wechat_media` (
  `media_code` int(11) NOT NULL DEFAULT '0',
  `media_name` varchar(64) DEFAULT NULL,
  `media_type` int(11) DEFAULT NULL,
  `file_url` varchar(200) DEFAULT NULL,
  `media_id` varchar(64) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `exp_time` datetime DEFAULT NULL,
  PRIMARY KEY (`media_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_wechat_media
-- ----------------------------

-- ----------------------------
-- Table structure for sys_wechat_param
-- ----------------------------
DROP TABLE IF EXISTS `sys_wechat_param`;
CREATE TABLE `sys_wechat_param` (
  `param_code` int(11) NOT NULL,
  `param_value` varchar(255) DEFAULT NULL,
  `expires_in` int(11) DEFAULT NULL,
  `exp_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`param_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sys_wechat_param
-- ----------------------------
INSERT INTO `sys_wechat_param` VALUES ('1', '95_Wbecon7ZVEc50NQCkLl0eeCEbeuWJBTRAks55waKE8Ib04_gpiOlpk4x1uRnwpeZJ26JHJxSh_nVgpkEtw7Z8AJqL5JWb721V7KO0ukdJJqFm938S8AMCoxg1GsYSJeAAATNE', '7200', '2025-08-08 20:10:55', '2025-05-14 11:17:10');

-- ----------------------------
-- Table structure for tb_group
-- ----------------------------
DROP TABLE IF EXISTS `tb_group`;
CREATE TABLE `tb_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `group_name` varchar(36) DEFAULT NULL,
  `group_attrs` varchar(255) DEFAULT NULL,
  `group_img` varchar(255) DEFAULT '',
  `sort` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tb_group
-- ----------------------------
INSERT INTO `tb_group` VALUES ('1', '0', '研发部', null, '', '1', '2025-12-19 11:46:17');

-- ----------------------------
-- Table structure for tb_issue
-- ----------------------------
DROP TABLE IF EXISTS `tb_issue`;
CREATE TABLE `tb_issue` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '0',
  `flow_id` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `severity` tinyint(11) DEFAULT '0',
  `priority` tinyint(11) DEFAULT '0',
  `status` varchar(100) DEFAULT '0',
  `creater` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `btime` datetime DEFAULT NULL,
  `etime` datetime DEFAULT NULL,
  PRIMARY KEY (`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_issue
-- ----------------------------

-- ----------------------------
-- Table structure for tb_issue_work
-- ----------------------------
DROP TABLE IF EXISTS `tb_issue_work`;
CREATE TABLE `tb_issue_work` (
  `work_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bstatus` varchar(100) NOT NULL DEFAULT '',
  `estatus` varchar(100) NOT NULL,
  `is_finish` tinyint(100) DEFAULT '0',
  `content` text,
  `btime` datetime DEFAULT NULL,
  `etime` datetime DEFAULT NULL,
  `work_time` datetime DEFAULT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_issue_work
-- ----------------------------

-- ----------------------------
-- Table structure for tb_project
-- ----------------------------
DROP TABLE IF EXISTS `tb_project`;
CREATE TABLE `tb_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_project
-- ----------------------------
INSERT INTO `tb_project` VALUES ('1', 'KisTask', '任务管理系统', 'upload/image/2025/12/176611602619282.png', '2025-12-19 11:47:13');

-- ----------------------------
-- Table structure for tb_project_flow
-- ----------------------------
DROP TABLE IF EXISTS `tb_project_flow`;
CREATE TABLE `tb_project_flow` (
  `flow_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `status` text,
  `actions` text,
  `chart` text,
  PRIMARY KEY (`flow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_project_flow
-- ----------------------------
INSERT INTO `tb_project_flow` VALUES ('1', '1', 'BUG跟踪', '', '[{\"name\":\"开始\",\"intro\":\"开始创建\",\"is_begin\":1,\"is_end\":0},{\"name\":\"结束\",\"intro\":\"任务结束\",\"is_begin\":0,\"is_end\":1},{\"name\":\"处理\",\"intro\":\"处理bug\",\"is_begin\":0,\"is_end\":0},{\"name\":\"分配\",\"intro\":\"分配任务\",\"is_begin\":0,\"is_end\":0},{\"name\":\"已修复\",\"intro\":\"bug已修复\",\"is_begin\":0,\"is_end\":0}]', '[{\"src_status\":\"开始\",\"dst_status\":[\"分配\"]},{\"src_status\":\"结束\",\"dst_status\":[\"分配\"]},{\"src_status\":\"处理\",\"dst_status\":[\"已修复\",\"分配\"]},{\"src_status\":\"分配\",\"dst_status\":[\"处理\"]},{\"src_status\":\"已修复\",\"dst_status\":[\"结束\",\"处理\"]}]', '{\"cells\":[{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"9762456e-07d3-4320-a20f-4d5582d609c7\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1767162792004\",\"port\":\"right-port\"},\"target\":{\"cell\":\"rect-node-1767690615361\",\"port\":\"left-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"994c531c-e10d-4626-88f7-1a96433d13cb\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1767690615361\",\"port\":\"right-port\"},\"target\":{\"cell\":\"rect-node-1767690614793\",\"port\":\"left-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"7bbaaee5-a053-48b2-b5bd-d0252cd8c91c\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1767690614793\",\"port\":\"right-port\"},\"target\":{\"cell\":\"rect-node-1769243564056\",\"port\":\"left-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"b054839b-dbb3-4d91-b927-097d97418b3d\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1769243564056\",\"port\":\"right-port\"},\"target\":{\"cell\":\"rect-node-1767604171766\",\"port\":\"left-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"463feed6-20c6-404b-9620-9985d9ee5faa\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1769243564056\",\"port\":\"bottom-port\"},\"target\":{\"cell\":\"rect-node-1767690614793\",\"port\":\"bottom-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"d504ef08-808c-4b3e-ab99-afb7c83416c1\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1767690614793\",\"port\":\"top-port\"},\"target\":{\"cell\":\"rect-node-1767690615361\",\"port\":\"top-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"8fe6c75e-b1ff-4266-84c9-6423effc17d5\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1767604171766\",\"port\":\"bottom-port\"},\"target\":{\"cell\":\"rect-node-1767690615361\",\"port\":\"bottom-port\"}},{\"position\":{\"x\":20,\"y\":90},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#307dee\",\"fill\":\"rgba(48, 125, 238, 0.1)\"},\"label\":{\"text\":\"开始\"},\"content\":{\"text\":\"开始创建\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1767162792004\",\"zIndex\":1,\"data\":{\"label\":\"开始\",\"content\":\"开始创建\",\"color\":\"#307dee\",\"type\":\"start\"}},{\"position\":{\"x\":1130,\"y\":190},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#e53d30\",\"fill\":\"rgba(229, 61, 48, 0.1)\"},\"label\":{\"text\":\"结束\"},\"content\":{\"text\":\"任务结束\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1767604171766\",\"zIndex\":3,\"data\":{\"label\":\"结束\",\"content\":\"任务结束\",\"color\":\"#e53d30\",\"type\":\"end\"}},{\"position\":{\"x\":560,\"y\":90},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#289947\",\"fill\":\"rgba(40, 153, 71, 0.1)\"},\"label\":{\"text\":\"处理\"},\"content\":{\"text\":\"处理bug\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1767690614793\",\"zIndex\":4,\"data\":{\"label\":\"处理\",\"content\":\"处理bug\",\"color\":\"#289947\",\"type\":\"process\"}},{\"position\":{\"x\":280,\"y\":90},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#289947\",\"fill\":\"rgba(40, 153, 71, 0.1)\"},\"label\":{\"text\":\"分配\"},\"content\":{\"text\":\"分配任务\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1767690615361\",\"zIndex\":5,\"data\":{\"label\":\"分配\",\"content\":\"分配任务\",\"color\":\"#289947\",\"type\":\"process\"}},{\"position\":{\"x\":860,\"y\":90},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#289947\",\"fill\":\"rgba(40, 153, 71, 0.1)\"},\"label\":{\"text\":\"已修复\"},\"content\":{\"text\":\"bug已修复\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1769243564056\",\"data\":{\"label\":\"已修复\",\"content\":\"bug已修复\",\"color\":\"#289947\",\"type\":\"process\"},\"zIndex\":6}]}');
INSERT INTO `tb_project_flow` VALUES ('4', '1', '需求', '功能需求', '[{\"name\":\"规划中\",\"intro\":\"新功能规划\",\"is_begin\":1,\"is_end\":0},{\"name\":\"实现中\",\"intro\":\"已开始实现需求\",\"is_begin\":0,\"is_end\":0},{\"name\":\"已拒绝\",\"intro\":\"需求不需要实现\",\"is_begin\":0,\"is_end\":1},{\"name\":\"已实现\",\"intro\":\"功能已经实现\",\"is_begin\":0,\"is_end\":1}]', '[{\"src_status\":\"规划中\",\"dst_status\":[\"实现中\"]},{\"src_status\":\"实现中\",\"dst_status\":[\"已实现\",\"规划中\",\"已拒绝\"]},{\"src_status\":\"已拒绝\",\"dst_status\":[]},{\"src_status\":\"已实现\",\"dst_status\":[\"规划中\"]}]', '{\"cells\":[{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"66cf4374-dd52-47c8-9564-e2468b0039b1\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1769246170596\",\"port\":\"right-port\"},\"target\":{\"cell\":\"rect-node-1769246200940\",\"port\":\"left-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"8bb58680-684a-4dbb-bf90-581ec74969a5\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1769246200940\",\"port\":\"right-port\"},\"target\":{\"cell\":\"rect-node-1769246333299\",\"port\":\"left-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"73f66979-68b1-40c5-9f88-a5712f6054f1\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1769246200940\",\"port\":\"bottom-port\"},\"target\":{\"cell\":\"rect-node-1769246170596\",\"port\":\"bottom-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"fb53eb64-cefc-48b9-8a45-dd3ae7707994\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1769246333299\",\"port\":\"top-port\"},\"target\":{\"cell\":\"rect-node-1769246170596\",\"port\":\"top-port\"}},{\"shape\":\"edge\",\"attrs\":{\"line\":{\"stroke\":\"#A2B1C3\",\"targetMarker\":{\"name\":\"block\",\"width\":12,\"height\":8}}},\"id\":\"0242231a-3316-46ac-81cc-cd37a48fee66\",\"labels\":[{\"position\":0.5,\"attrs\":{\"text\":{\"text\":\"\"}}}],\"zIndex\":0,\"source\":{\"cell\":\"rect-node-1769246200940\",\"port\":\"bottom-port\"},\"target\":{\"cell\":\"rect-node-1769246332803\",\"port\":\"top-port\"}},{\"position\":{\"x\":220,\"y\":100},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#307dee\",\"fill\":\"rgba(48, 125, 238, 0.1)\"},\"label\":{\"text\":\"规划中\"},\"content\":{\"text\":\"新功能规划\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1769246170596\",\"data\":{\"label\":\"规划中\",\"content\":\"新功能规划\",\"color\":\"#307dee\",\"type\":\"start\"},\"zIndex\":1},{\"position\":{\"x\":500,\"y\":100},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#289947\",\"fill\":\"rgba(40, 153, 71, 0.1)\"},\"label\":{\"text\":\"实现中\"},\"content\":{\"text\":\"已开始实现需求\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1769246200940\",\"data\":{\"label\":\"实现中\",\"content\":\"已开始实现需求\",\"color\":\"#289947\",\"type\":\"process\"},\"zIndex\":3},{\"position\":{\"x\":500,\"y\":260},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#e53d30\",\"fill\":\"rgba(229, 61, 48, 0.1)\"},\"label\":{\"text\":\"已拒绝\"},\"content\":{\"text\":\"需求不需要实现\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1769246332803\",\"data\":{\"label\":\"已拒绝\",\"content\":\"需求不需要实现\",\"color\":\"#e53d30\",\"type\":\"end\"},\"zIndex\":4},{\"position\":{\"x\":770,\"y\":100},\"size\":{\"width\":140,\"height\":60},\"attrs\":{\"body\":{\"stroke\":\"#e53d30\",\"fill\":\"rgba(229, 61, 48, 0.1)\"},\"label\":{\"text\":\"已实现\"},\"content\":{\"text\":\"功能已经实现\"}},\"visible\":true,\"shape\":\"custom-rect\",\"ports\":{\"groups\":{\"top\":{\"position\":\"top\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"right\":{\"position\":\"right\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"bottom\":{\"position\":\"bottom\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}},\"left\":{\"position\":\"left\",\"attrs\":{\"circle\":{\"r\":4,\"magnet\":true,\"stroke\":\"#5F95FF\",\"strokeWidth\":1,\"fill\":\"#fff\",\"style\":{\"visibility\":\"hidden\"}}}}},\"items\":[{\"group\":\"top\",\"id\":\"top-port\"},{\"group\":\"right\",\"id\":\"right-port\"},{\"group\":\"bottom\",\"id\":\"bottom-port\"},{\"group\":\"left\",\"id\":\"left-port\"}]},\"id\":\"rect-node-1769246333299\",\"data\":{\"label\":\"已实现\",\"content\":\"功能已经实现\",\"color\":\"#e53d30\",\"type\":\"end\"},\"zIndex\":5}]}');
