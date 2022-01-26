-- --------------------------------------------------------
-- 主機:                           127.0.0.1
-- 伺服器版本:                        10.4.19-MariaDB - mariadb.org binary distribution
-- 伺服器作業系統:                      Win64
-- HeidiSQL 版本:                  11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 傾印  資料表 vue_php.chat 結構
DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MemberId` int(10) NOT NULL,
  `ChatContent` mediumtext DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `IsHidden` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Id`),
  KEY `FK_chat_member` (`MemberId`),
  CONSTRAINT `FK_chat_member` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- 正在傾印表格  vue_php.chat 的資料：~3 rows (近似值)
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
REPLACE INTO `chat` (`Id`, `MemberId`, `ChatContent`, `CreatedDate`, `IsHidden`) VALUES
	(1, 1, '第一筆留言', '2021-10-30 01:51:02', b'0'),
	(2, 1, '第二筆', '2021-10-30 01:54:41', b'0'),
	(3, 1, '好了夠了!', '2021-10-30 01:54:55', b'0');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
