/*
Navicat MySQL Data Transfer

Source Server         : home
Source Server Version : 50641
Source Host           : localhost:3306
Source Database       : test_db

Target Server Type    : MYSQL
Target Server Version : 50641
File Encoding         : 65001

Date: 2020-04-03 21:14:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` char(255) NOT NULL,
  `password` char(32) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `photo` text,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index1` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Anton', 'test@gmail.com', 'c78b6663d47cfbdb4d65ea51c104044e', '1997-08-08', 'uploads/img/no_photo.png', 'male');
INSERT INTO `users` VALUES ('2', 'Павел', 'task@gmail.com', 'c78b6663d47cfbdb4d65ea51c104044e', '1954-05-03', 'uploads/img/no_photo.png', 'male');
