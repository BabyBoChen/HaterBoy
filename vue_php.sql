-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2022 at 10:26 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16788429_food`
--
CREATE DATABASE IF NOT EXISTS `id16788429_food` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id16788429_food`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `Id` int(10) UNSIGNED NOT NULL,
  `MemberId` int(10) NOT NULL,
  `ChatContent` mediumtext DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `IsHidden` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`Id`, `MemberId`, `ChatContent`, `CreatedDate`, `IsHidden`) VALUES
(1, 1, '第一筆留言', '2021-10-30 01:51:02', b'0'),
(2, 1, '第二筆', '2021-10-30 01:54:41', b'0'),
(3, 1, '好了夠了!', '2021-10-30 01:54:55', b'0'),
(4, 1, '上線測試！要先登入會員才能新增留言。只能刪除自己所送出的留言，請謹言慎行！謝謝！', '2021-10-30 17:41:16', b'0'),
(5, 1, 'Goodnight!', '2021-10-30 19:48:43', b'0'),
(6, 2, '貓仙人愛伯夷 <3', '2021-10-31 05:26:52', b'0'),
(7, 2, '喵Studio 2022', '2021-10-31 05:30:36', b'0'),
(8, 2, '(^・ω・^ )', '2021-10-31 05:31:38', b'0'),
(9, 1, '每則留言底下的時間跟真正的發文時間會差8小時是因為我忘了調時區', '2021-10-31 05:39:26', b'0'),
(10, 2, 'Mew~~~~~~~~~~~~~~', '2021-11-01 12:13:09', b'0'),
(11, 2, '貓仙人到此一遊', '2021-11-01 12:14:22', b'0'),
(12, 1, '!!!! 呵呵目前留言板沒有提醒機制，我要進來看才會看到留言 <3', '2021-11-02 02:14:15', b'0'),
(13, 56, 'Hello~~~~~~~', '2021-11-03 03:07:44', b'0'),
(14, 56, '待辦事項網站剛剛掛了，然後又自動修復了！超神奇的！ lol', '2021-11-03 03:25:30', b'0'),
(15, 60, 'LineBot加入Azure語意分析該不會是這個吧！\r\nhttps://medium.com/@starcaspar/azure-bot-service-luis-line-bot-%E6%89%93%E9%80%A0%E4%BD%A0%E7%9A%84%E8%81%8A%E5%A4%A9%E6%A9%9F%E5%99%A8%E4%BA%BA-3bbfe9893fd0', '2021-11-03 05:40:28', b'0'),
(16, 60, '我被公司閒置在一邊，沒派工也沒人鳥我，害我超想請假肥家！', '2021-11-03 05:41:44', b'0'),
(17, 1, '抱歉靠北伯夷的留言板沒有超連結的功能 ><\"。\r\n我只會用一種叫qnamaker.ai的聊天機器人（也是azure的）：\r\nhttps://www.youtube.com/watch?v=mxRaEykgcCE&ab_channel=developertw\r\n妳找到的那個連結看起來是可以整合line chatbot的，我也要花點時間研究一下。', '2021-11-03 06:55:08', b'0'),
(18, 1, '抱歉靠北伯夷的留言板沒有超連結的功能 ><\"。\\n 我只會用一種叫qnamaker.ai的聊天機器人（也是azure的）： <br>https://www.youtube.com/watch?v=mxRaEykgcCE&ab_channel=developertw 妳找到的那個連結看起來是可以整合line chatbot的，我也要花點時間研究一下。', '2021-11-03 06:55:44', b'1'),
(19, 1, '抱歉靠北伯夷的留言板沒有超連結的功能 ><\"。&#13;&#10; 我只會用一種叫qnamaker.ai的聊天機器人（也是azure的）： &#13;&#10;https://www.youtube.com/watch?v=mxRaEykgcCE&ab_channel=developertw &#13;&#10;妳找到的那個連結看起來是可以整合line chatbot的，我也要花點時間研究一下。', '2021-11-03 06:57:03', b'1'),
(20, 1, '寫自己的扣研究自己想研究的技術囉~！看起來一樣是在寫扣！我抓到時間就寫自己的扣，php、java、python、go、android...，想玩什麼就玩什麼^^偷懶自學兩相宜！呵呵...', '2021-11-03 07:01:20', b'0'),
(21, 2, '埼玉！！因為有頭髮隱藏了真正的實力嗎（？', '2021-11-03 07:02:10', b'0'),
(22, 60, '因為有頭髮所以還很弱！弱爆～', '2021-11-03 08:11:42', b'0'),
(23, 60, '目前只有左邊額頭禿了一小塊，還有很多頭髮～', '2021-11-03 08:12:21', b'0'),
(24, 2, '我要靠北喵Studio不給登入！還一直無限♾️Loop~~~喵！！！！！', '2021-11-08 08:41:05', b'0'),
(25, 1, '廢物喵studio2017', '2021-11-08 09:47:32', b'0'),
(26, 1, '<p>新版靠北伯夷留言板功能測試：</p>\n<p>連結：</p>\n<p><a href=\"https://babybochen.github.io/\" target=\"_blank\" rel=\"noopener\">https://babybochen.github.io/</a></p>', '2021-11-15 13:19:29', b'0'),
(27, 1, '<p>新建了即時聊天室哦！請見左方連結「即時聊天室」</p>\n<p><a href=\"http://119.14.71.47:8081/\" target=\"_blank\" rel=\"noopener\">http://119.14.71.47:8081/</a></p>', '2021-11-15 13:20:26', b'0'),
(28, 1, '<p>無話可說</p>', '2021-11-16 07:53:13', b'1'),
(29, 1, '<p>你掛了也沒差...</p>', '2021-11-24 03:07:54', b'0'),
(30, 2, '<p>掛好掛滿</p>', '2021-11-24 04:19:29', b'0'),
(31, 1, '<p>首頁改版！<br />靠北伯夷結案！</p>', '2021-12-07 13:18:47', b'0'),
(32, 1, '<p>無話可說</p>', '2021-12-08 10:28:16', b'0'),
(33, 2, '<p>ccc</p>', '2021-12-17 08:10:36', b'0'),
(34, 1, '<p>到底為什麼會出現ccc呢？:p</p>', '2021-12-22 03:28:48', b'0'),
(35, 1, '<p>難難難卜卜卜</p>', '2021-12-22 10:58:42', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Id` int(11) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Nickname` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Id`, `Email`, `Password`, `Nickname`) VALUES
(1, 'babybo@mail.com', 'xxxyyy', 'BabyBo'),
(2, 'secretcat@mail.com', 'xxxyyy', 'Secret Cat'),
(47, 'mrt19930418@gmail.com', '1026', '貓仙人'),
(56, 'tc10131@hotmail.com', 'xxxyyy', '伯夷'),
(60, 'zyxchihwa_992@naver.com', 'cowboy987', '有頭髮的埼玉'),
(64, 'msit130foodma@hotmail.com', 'xxxyyy', '福滿商城');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Id` int(11) UNSIGNED NOT NULL,
  `Md5` varchar(40) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Nickname` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`Id`, `Md5`, `Email`, `Password`, `Nickname`) VALUES
(41, 'c3c2c0e32a55e0b20f0fa3a98cd3e7db', 'tc10131@hotmail.com', 'xxxyyy', 'Hotmail'),
(42, '469dc065bbb1646b1395cff011328260', 'tc10131@gmail.com', 'xxxyyy', ''),
(43, 'fc4e4b89da173e896533aa0572639393', 'zyxchihwa_992@naver.com', 'cowboy987', '治華'),
(44, '9604800f9f3bc4864ded376ba3841af6', 'tc10131@yahoo.com.tw', 'xxxyyy', '伯夷'),
(45, '35f84d6af37ee87c230f2b5ec99e7f5c', 'msit130foodma@hotmail.com', 'xxxyyy', '福滿商城'),
(46, '59bf20c560fb5f09c47d57057f9f18c0', 'tc10131@gmail.com', 'xxxyyy', '寶貝伯');

-- --------------------------------------------------------

--
-- Table structure for table `reset_pwd`
--

CREATE TABLE `reset_pwd` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `NewPassword` varchar(256) NOT NULL,
  `Ticket` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_chat_member` (`MemberId`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reset_pwd`
--
ALTER TABLE `reset_pwd`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD KEY `FK_reset_pwd_member` (`MemberId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reset_pwd`
--
ALTER TABLE `reset_pwd`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `FK_chat_member` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reset_pwd`
--
ALTER TABLE `reset_pwd`
  ADD CONSTRAINT `FK_reset_pwd_member` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
