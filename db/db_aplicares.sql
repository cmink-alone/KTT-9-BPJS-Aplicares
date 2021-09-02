/*
Navicat MySQL Data Transfer

Source Server         : Ktt9
Source Server Version : 50556
Source Host           : 10.83.129.98:3306
Source Database       : db_aplicares

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2021-06-09 10:07:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for datcp
-- ----------------------------
DROP TABLE IF EXISTS `datcp`;
CREATE TABLE `datcp` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datcp
-- ----------------------------
INSERT INTO `datcp` VALUES ('1', 'Informasi', '0361 -779969');

-- ----------------------------
-- Table structure for datruang
-- ----------------------------
DROP TABLE IF EXISTS `datruang`;
CREATE TABLE `datruang` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `idruang` varchar(200) DEFAULT NULL,
  `kodekelas` varchar(5) DEFAULT NULL,
  `koderuang` varchar(10) DEFAULT NULL,
  `namaruang` varchar(150) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `tersedia` int(11) DEFAULT NULL,
  `tersediapria` int(11) DEFAULT NULL,
  `tersediawanita` int(11) DEFAULT NULL,
  `tersediapriawanita` int(11) DEFAULT NULL,
  `jmlpasien` int(11) DEFAULT NULL,
  `tglentri` datetime DEFAULT NULL,
  `kdppk` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datruang
-- ----------------------------
INSERT INTO `datruang` VALUES ('11', 'HCU.HCU', 'HCU', 'HCU', 'HCU', '5', '1', null, null, null, '4', '2021-06-09 09:54:14', '0227R005');
INSERT INTO `datruang` VALUES ('12', 'ICU.ICU', 'ICU', 'ICU', 'ICU', '15', '1', null, null, null, '14', '2021-06-09 09:54:19', '0227R005');
INSERT INTO `datruang` VALUES ('13', 'VIP.VIP', 'VIP', 'VIP', 'VIP', '41', '2', null, null, null, '39', '2021-06-09 09:54:32', '0227R005');
INSERT INTO `datruang` VALUES ('14', 'C1.KL1', 'KL1', 'C1', 'C1', '52', '0', null, null, null, '52', '2021-06-09 09:53:16', '0227R005');
INSERT INTO `datruang` VALUES ('15', 'C2.KL2', 'KL2', 'C2', 'C2', '20', '0', null, null, null, '20', '2021-06-09 09:53:21', '0227R005');
INSERT INTO `datruang` VALUES ('16', 'C3.KL3', 'KL3', 'C3', 'C3', '58', '0', null, null, null, '58', '2021-06-09 09:53:29', '0227R005');

-- ----------------------------
-- Table structure for histdashboard
-- ----------------------------
DROP TABLE IF EXISTS `histdashboard`;
CREATE TABLE `histdashboard` (
  `id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of histdashboard
-- ----------------------------
INSERT INTO `histdashboard` VALUES ('7');

-- ----------------------------
-- Table structure for refkelas
-- ----------------------------
DROP TABLE IF EXISTS `refkelas`;
CREATE TABLE `refkelas` (
  `no` char(2) NOT NULL,
  `nm_kelas` varchar(30) DEFAULT NULL,
  `kd_kelas` char(8) NOT NULL,
  PRIMARY KEY (`kd_kelas`,`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of refkelas
-- ----------------------------
INSERT INTO `refkelas` VALUES ('1', 'HCU', 'HCU');
INSERT INTO `refkelas` VALUES ('2', 'ICU', 'ICU');
INSERT INTO `refkelas` VALUES ('3', 'KELAS I', 'KL1');
INSERT INTO `refkelas` VALUES ('4', 'KELAS II', 'KL2');
INSERT INTO `refkelas` VALUES ('5', 'KELAS III', 'KL3');
INSERT INTO `refkelas` VALUES ('6', 'VIP', 'VIP');

-- ----------------------------
-- Table structure for refurl
-- ----------------------------
DROP TABLE IF EXISTS `refurl`;
CREATE TABLE `refurl` (
  `url` varchar(80) DEFAULT NULL,
  `koneksi` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of refurl
-- ----------------------------
INSERT INTO `refurl` VALUES ('http://dvlp.bpjs-kesehatan.go.id', '0');
INSERT INTO `refurl` VALUES ('http://api.bpjs-kesehatan.go.id', '1');

-- ----------------------------
-- Table structure for runningtext
-- ----------------------------
DROP TABLE IF EXISTS `runningtext`;
CREATE TABLE `runningtext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isi` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of runningtext
-- ----------------------------
INSERT INTO `runningtext` VALUES ('1', 'Untuk informasi terbaru silahkan menghubungi petugas rumah sakit');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `username` varchar(8) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `kdppk` varchar(8) DEFAULT NULL,
  `nmppk` varchar(50) DEFAULT NULL,
  `consid` varchar(25) DEFAULT NULL,
  `conspwd` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('0227R005', 'd1cba02271190ed5671103ff146bf741', '0227R005', 'RS. SILOAM BALI', '12345', 'isi_secret_key');
