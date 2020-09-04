-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 21, 2019 lúc 02:29 AM
-- Phiên bản máy phục vụ: 5.6.41-84.1
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `suusoft_product_ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `logo` varchar(300) DEFAULT NULL COMMENT 'editor:upload',
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `keywords` varchar(1000) DEFAULT NULL,
  `note` varchar(3000) DEFAULT NULL,
  `storage_max` bigint(20) DEFAULT NULL COMMENT 'group:storage',
  `storage_current` bigint(20) DEFAULT NULL COMMENT 'group:storage',
  `address` varchar(255) DEFAULT NULL COMMENT 'group:contact',
  `map` varchar(255) DEFAULT NULL COMMENT 'group:contact;grid:hidden',
  `website` varchar(255) DEFAULT NULL COMMENT 'group:contact',
  `email` varchar(255) DEFAULT NULL COMMENT 'group:contact',
  `phone` varchar(255) DEFAULT NULL COMMENT 'group:contact',
  `fax` varchar(255) DEFAULT NULL COMMENT 'group:contact',
  `chat` varchar(255) DEFAULT NULL COMMENT 'group:contact',
  `facebook` varchar(255) DEFAULT NULL COMMENT 'grid:hidden;group:social',
  `twitter` varchar(255) DEFAULT NULL COMMENT 'grid:hidden;group:social',
  `google` varchar(255) DEFAULT NULL COMMENT 'grid:hidden;group:social',
  `youtube` varchar(255) DEFAULT NULL COMMENT 'grid:hidden;group:social',
  `copyright` varchar(255) DEFAULT NULL COMMENT 'grid:hidden;',
  `terms_of_service` varchar(300) DEFAULT NULL COMMENT 'editor:file;group:common',
  `profile` varchar(300) DEFAULT NULL COMMENT 'editor:file;group:common',
  `privacy_policy` varchar(300) DEFAULT NULL COMMENT 'editor:file;group:common',
  `is_active` tinyint(1) DEFAULT NULL COMMENT 'group:common',
  `type` varchar(100) DEFAULT NULL COMMENT 'data:ONEPAGE,COMPANY,ECOMMERCE,SOCIAL,MUSIC,EDUCATION',
  `status` varchar(100) DEFAULT NULL COMMENT 'data:DEMO,LIVE,CLOSED,SUSPEND',
  `page_size` int(5) DEFAULT NULL COMMENT 'group:setting',
  `main_color` varchar(255) DEFAULT NULL COMMENT 'lookup:#COLORS;group:setting;editor:input',
  `cache_enabled` tinyint(1) DEFAULT NULL,
  `currency_format` varchar(255) DEFAULT NULL COMMENT 'lookup:#CURRENCY;group:setting',
  `date_format` varchar(255) DEFAULT NULL COMMENT 'group:setting;editor:input',
  `web_theme` varchar(255) DEFAULT NULL COMMENT 'group:style',
  `admin_form_alignment` varchar(255) DEFAULT NULL COMMENT 'data:vertical,horizontal,inline;group:setting',
  `body_css` varchar(255) DEFAULT NULL COMMENT 'group:style',
  `body_style` varchar(255) DEFAULT NULL COMMENT 'group:style',
  `page_css` varchar(255) DEFAULT NULL COMMENT 'group:style',
  `page_style` varchar(255) DEFAULT NULL COMMENT 'group:style',
  `owner_id` varchar(100) DEFAULT NULL COMMENT 'editor:select;lookup:@user,id,username;group:common',
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `application`
--

INSERT INTO `application` (`id`, `logo`, `code`, `name`, `description`, `keywords`, `note`, `storage_max`, `storage_current`, `address`, `map`, `website`, `email`, `phone`, `fax`, `chat`, `facebook`, `twitter`, `google`, `youtube`, `copyright`, `terms_of_service`, `profile`, `privacy_policy`, `is_active`, `type`, `status`, `page_size`, `main_color`, `cache_enabled`, `currency_format`, `date_format`, `web_theme`, `admin_form_alignment`, `body_css`, `body_style`, `page_css`, `page_style`, `owner_id`, `created_date`, `created_user`, `modified_date`, `modified_user`) VALUES
(1, 'application1_logo.png', 'education', 'iwanadeal', 'Always the best', '', '', 50000, NULL, '17 Phung CHi Kien, Cau Giay, Ha noi, Vietnam.', '', 'www.vnexpress.net', 'hung.hoxuan@gmail.com', '84912738748', '', '', 'bach.hop.790', 't', '', 'https://www.youtube.com/channel/UCyw4WvIz4CbBBipCJpVTQjQ', '', '', '', '', 1, '', '', NULL, 'red', NULL, '', 'yyyy-m-d', '', '', 'bg-color-light', '.container {     width:90% !important;     padding-left:50px !important;padding-right: 50px !important;', '', '', '6', '2016-10-03 13:15:39', '6', '2016-10-26 01:41:26', '6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user`
--

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `qb_id` int(11) DEFAULT '0',
  `balance` decimal(12,1) DEFAULT NULL COMMENT 'group:FINANCE',
  `lat` varchar(255) DEFAULT NULL COMMENT 'group:LOCATION',
  `long` varchar(255) DEFAULT NULL COMMENT 'group:LOCATION',
  `avatar` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `content` text,
  `gender` varchar(100) DEFAULT NULL COMMENT 'male,felame',
  `dob` varchar(255) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `point` int(11) DEFAULT NULL COMMENT 'group:FINANCE',
  `card_number` varchar(255) DEFAULT NULL COMMENT 'group:CARD',
  `card_cvv` varchar(255) DEFAULT NULL COMMENT 'editor:text;group:CARD',
  `card_exp` varchar(255) DEFAULT NULL COMMENT 'group:CARD',
  `is_online` tinyint(1) DEFAULT NULL COMMENT 'group:GROUPING',
  `is_active` tinyint(1) DEFAULT NULL COMMENT 'group:GROUPING',
  `type` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL COMMENT 'data:PENDING,BANNED,REJECTED,NORMAL,PRO,VIP',
  `role` int(2) DEFAULT NULL COMMENT 'data:10:USER,20:MODERATOR,30:ADMIN;editor:select;group:GROUPING',
  `rate` float DEFAULT '0',
  `rate_count` int(11) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user`
--

INSERT INTO `app_user` (`id`, `qb_id`, `balance`, `lat`, `long`, `avatar`, `name`, `username`, `email`, `password`, `auth_key`, `password_hash`, `password_reset_token`, `description`, `content`, `gender`, `dob`, `phone`, `weight`, `height`, `address`, `country`, `state`, `city`, `point`, `card_number`, `card_cvv`, `card_exp`, `is_online`, `is_active`, `type`, `status`, `role`, `rate`, `rate_count`, `created_date`, `modified_date`) VALUES
(1, 0, '1486.2', NULL, NULL, '1573784209avatar.png', 'Minh Trí', 'tri@gmail.com', 'tri@gmail.com', '$2y$13$avz4L044yjdVYiXfc.JZU.ys4Ckp1evXN3keaGSeEDHR3AGMgftCq', 'onX94A4B1X2ZLkhnRSr5vnrzcHIlNf5i', NULL, 'e9f75447df1a8ab17d2853cc5c1c5563', NULL, NULL, 'Male', NULL, '+84 0392662642', NULL, NULL, 'phúc diễn bắc từ liêm hà nội', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-14 03:21:06', '2019-11-14 20:16:49'),
(5, 100440137, '7006.5', NULL, NULL, '1573813187avatar.png', 'Trường Nguyễn', 'truong@gmail.com', 'truong@gmail.com', '$2y$13$FMy2iBKNz1bBgBuKbnTXY.CQYyj5cQWRz6VL4FLlNVa7gu4kInGve', 'MrPe82m-DL1H4lXE26LMtZuPv1_LVgDT', NULL, '68f9d4bec3ffc853c15fe5b52fc86168', NULL, NULL, 'Male', NULL, '+84 5457576', NULL, NULL, 'Hà Nội', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-15 01:33:37', '2019-11-21 19:21:25'),
(6, 0, '0.0', NULL, NULL, NULL, 'The', 'test@gmail.com', 'test@gmail.com', '$2y$13$HP2JxThENlHEOc8vOJls.enQKNaKVSDaTd1dlKj3c/OfHDPdLXRTe', '60DVkjL_n9YrC5ugy9Ke7RjC711BYqmS', NULL, '84208defe0e03bbcfdf63abeac09efd8', NULL, NULL, 'Male', NULL, '+84 0852369741', NULL, NULL, 'an Thule g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-17 22:03:20', NULL),
(7, 0, '0.0', NULL, NULL, NULL, 'Tri@', 'huy@gmail.com', 'huy@gmail.com', '$2y$13$4Pzhr/nz9I1sq0iL1JsJke5j0.uhe0mqPrnJe3kqgWALDxBOFCMUi', 'jk7kgqk1GhWjipTvgraq29P68MqJWSo5', NULL, 'c84aff0d5df7bba9adb3a5a39d111fc7', NULL, NULL, 'Male', NULL, '+84 46656', NULL, NULL, 'Keith', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-18 01:32:30', NULL),
(8, 0, '0.0', NULL, NULL, '1574073183avatar.png', 'Trí Phạm', 'tripm@gmail.com', 'tripm@gmail.com', '$2y$13$YQOal2Or/pG9Jw4kdUsDaOCIKrf7MoK.sw5fc9qhvo.T1nIBBBQw6', 'OzxPSkcIHIb8LcxZCJs01K2V8CA-bt7E', NULL, '1254a67a82f66c54cd59f2353750c018', NULL, NULL, 'male', NULL, '+84 0392662642', NULL, NULL, 'phúc diễn bắc từ liêm hà nội', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-18 04:19:56', '2019-11-18 04:33:03'),
(9, 0, '0.0', NULL, NULL, NULL, 'Long', 'long@gmail.com', 'long@gmail.com', '$2y$13$xjUmzPtzKpgkDhKzfSklq.IDA5KQPeP7LnYIK4q/DLh7iK8oJl.Gy', '8-nuKiSSGPFDGwTatTtFdvqLnRfc9La3', NULL, 'ea736c8abf08a3c9f616d708e2b02640', NULL, NULL, 'female', NULL, '0467579444', NULL, NULL, 'tây mỗ hà nội', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-18 19:19:36', NULL),
(10, 0, '0.0', NULL, NULL, '1576146858avatar.png', 'Trí Phạm', 'tripmph05786@fpt.edu.vn', 'tripmph05786@fpt.edu.vn', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+84 0392662642', NULL, NULL, 'gfhj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-21 02:02:04', '2019-12-12 04:34:18'),
(11, 0, '0.0', NULL, NULL, 'https://lh3.googleusercontent.com/a-/AAuE7mCC8eD8fnSr9qHBLVKinRgadzIbKKQ1VAJ8ZfqL', 'Hà Trần', 'tranha18042001@gmail.com', 'tranha18042001@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-21 02:02:56', NULL),
(12, 0, '0.0', NULL, NULL, 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=543777819796402&height=50&width=50&ext=1579339234&hash=AeSwavXpczeCowWD', 'Thien Tran', 'suusoft@gmail.com', 'suusoft@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-21 20:18:03', NULL),
(13, 0, '0.0', NULL, NULL, 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1544673305680883&height=50&width=50&ext=1579229764&hash=AeTIWcRo6j7A9n6c', 'Phạm Thế Truyền', 'boynhaquenb@gmail.com', 'boynhaquenb@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-25 21:21:30', NULL),
(14, 0, '0.0', NULL, NULL, 'https://lh3.googleusercontent.com/a-/AAuE7mAgOCsEhViLWrzxEo6m_UWFnc4Z3-6sFmWuygPx', 'Vu minh', 'vuvanminh19990@gmail.com', 'vuvanminh19990@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-26 19:44:20', NULL),
(15, 0, '93600.3', NULL, NULL, 'https://lh3.googleusercontent.com/a-/AAuE7mAtUVujf6FvnlSn0WM0PeaPfM73Vqm0u4KUbgVAhg', 'Phạm Văn Long', 'phamvanlonghn@gmail.com', 'phamvanlonghn@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+84 3656427546', NULL, NULL, 'rsdk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-27 20:21:30', '2019-12-10 21:37:14'),
(16, 0, '0.0', NULL, NULL, '1576720051avatar.png', 'Jone smith ken', 'jstrangpv@gmail.com', 'jstrangpv@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+84 098864897', NULL, NULL, 'phu thu -tay mo-ha noi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-28 02:45:28', '2019-12-18 19:47:31'),
(17, 0, '0.0', NULL, NULL, 'https://lh3.googleusercontent.com/a-/AAuE7mCUTDhkMpfksZ_uK0Mo4Ladf95McHCTPsgZT1aI', 'Radzi Readmi', 'radzi.readmi@gmail.com', 'radzi.readmi@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-28 07:48:35', NULL),
(18, 0, '0.0', NULL, NULL, '', 'Mr Radzi', 'mr.radzi.63@gmail.com', 'mr.radzi.63@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-11-28 07:51:44', NULL),
(19, 0, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a-/AAuE7mAgOSnIJdiQBJupgwr-ltQrAwRJo_O4rHyGyuY4', 'Trường Nguyễn', 'truongnv1292@gmail.com', 'truongnv1292@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-12-17 20:39:21', NULL),
(20, 0, NULL, NULL, NULL, '', 'SuuSoft Dev', 'suusoft.dev@gmail.com', 'suusoft.dev@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-12-17 20:41:57', NULL),
(21, 0, NULL, NULL, NULL, '', 'ena.ramsay@gmail.com', 'ena.ramsay@gmail.com', 'ena.ramsay@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-12-20 21:35:35', NULL),
(22, 0, NULL, NULL, NULL, '', 'dionna.muncy@gmail.com', 'dionna.muncy@gmail.com', 'dionna.muncy@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'normal', NULL, 0, 0, '2019-12-20 22:47:04', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_device`
--

CREATE TABLE `app_user_device` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'lookup:@app_user',
  `ime` varchar(255) NOT NULL,
  `gcm_id` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_device`
--

INSERT INTO `app_user_device` (`id`, `user_id`, `ime`, `gcm_id`, `type`, `status`) VALUES
(1, 1, '351929088805960', 'eF0k53x67ok:APA91bH6L51EeI4y2bFWeX48eZTXXx10LyC4eUMiIO72wYPSKUBfOdjKpXcMgZ1L8xE8v3KA1FI07mxgbnpoMRXuAp9l9gqSQ004kZuBRpsJVAh7DgOsVvNi68Sh1WWxiMZ-EEqt_RP-', 1, 1),
(2, 15, '', 'eojtIBRfP40:APA91bEmjq5jM0PSWLXl5NE0vAIsoc1D9puI8oabUcTXtq4-RObTbLXINzfujBYGCExPUmkb0KsFvxB_yYt_xdfiE2SkTfUli5qeTeJYG_AbPkdnSLWInYD3HCbZTFiXCkDR82tbgwMe', 1, 1),
(3, 16, '', 'eF0k53x67ok:APA91bH6L51EeI4y2bFWeX48eZTXXx10LyC4eUMiIO72wYPSKUBfOdjKpXcMgZ1L8xE8v3KA1FI07mxgbnpoMRXuAp9l9gqSQ004kZuBRpsJVAh7DgOsVvNi68Sh1WWxiMZ-EEqt_RP-', 1, 1),
(4, 14, '', 'd8EHyhtp6bY:APA91bHTkOEl7m9hOsucQR_T-Gb2VJ9AjQUB5QfePTinfm_zwMfEGDdxz06MFUliaxlneZWcHyNJTBFwalYpAN25lW0AhBMZJqvb369GbwOom-u1OMrVVbUMlX9Q5EZrQmB2PUc3IDjp', 1, 1),
(5, 11, '', 'dZ-3LKYjVUg:APA91bH_XhCHq_Re8e7EQhbpvEQ0B75G1iys-4vuYKbQIGE-Nzkf9G-MjukcV5CcDcAmzNhJUwSmzFxgT13mrc7j6VlFswlkfTGVaQd3G_wh88cNHiw7SyAp0ogJsmoHysKX7r9Wy5TB', 1, 1),
(6, 17, '', 'ebBMHECYoxU:APA91bHY7gFZ3RuFmidCqaJV6nl6q8ilPF8SgaMr4VwuhnxDwB0vDhd-NTI6kCaeJg8bF6k114EfkC2CTcq7XYDvHPDYHfJU3NjJM6BHQKQX4OhZHvOGSGUrsksCh3cpMbtXkebNvkOv', 1, 1),
(7, 18, '', 'ciDUSZzRvSM:APA91bHgA6ICHoNZcu9-NQpuWI3k6sFoDUXyh-eu5m-rIdrS9zlmz0d5t1zIdpRXGvh-6F12WU2XMjU2OkxWEmvqwfjI-0-zuIk5uL0UcnG7zjz-NC4a0eajI3mY53KlBH7G-XPhLyZz', 1, 1),
(8, NULL, '', 'dacVkzud-ZM:APA91bFbmCmLDDDZbMtYIXxtjN8Y9m1s3B6YXNplxbONlwUQjSiX59KKe0z-wwvK5KKnBRowNKctDzUDrpppTokskwncpzWAnFYARePrnEEy4SWcq3dnVOWCmOT7PoeNLEXApNhiyKh7', 1, 1),
(9, NULL, '', 'dZ-3LKYjVUg:APA91bH_XhCHq_Re8e7EQhbpvEQ0B75G1iys-4vuYKbQIGE-Nzkf9G-MjukcV5CcDcAmzNhJUwSmzFxgT13mrc7j6VlFswlkfTGVaQd3G_wh88cNHiw7SyAp0ogJsmoHysKX7r9Wy5TB', 1, 1),
(10, NULL, '', 'cb4VbvLj0P8:APA91bFruvxMlF-v2CYLu8N8Zg7RJXgGPDnNWIe5X5zBixWUnHfG8asJ4A3CFk-KVbH6WxsDBsEffyOGESYdBLBm5jQFTyXct-lIfTwSviV4BehZuK9QSzCFvLF2c-vlaQNwhfzRleQ1', 1, 1),
(11, NULL, '', 'e0e48IexZHA:APA91bGmk3l3leynNpXJfenx4oH1-FVd6ZvcTg6JByyWRq-4DIwwTRwyLAW0D9-txWUlg9Z1iQeitMoi1bTY4gloAqsaBS_Pm-gmQ95M2a9TspArcRv04M-76dffQC-cI4i0uoGuDetT', 1, 1),
(12, NULL, '', 'e0e48IexZHA:APA91bGmk3l3leynNpXJfenx4oH1-FVd6ZvcTg6JByyWRq-4DIwwTRwyLAW0D9-txWUlg9Z1iQeitMoi1bTY4gloAqsaBS_Pm-gmQ95M2a9TspArcRv04M-76dffQC-cI4i0uoGuDetT', 1, 1),
(13, NULL, '', 'e0e48IexZHA:APA91bGmk3l3leynNpXJfenx4oH1-FVd6ZvcTg6JByyWRq-4DIwwTRwyLAW0D9-txWUlg9Z1iQeitMoi1bTY4gloAqsaBS_Pm-gmQ95M2a9TspArcRv04M-76dffQC-cI4i0uoGuDetT', 1, 1),
(14, NULL, '', 'e0e48IexZHA:APA91bGmk3l3leynNpXJfenx4oH1-FVd6ZvcTg6JByyWRq-4DIwwTRwyLAW0D9-txWUlg9Z1iQeitMoi1bTY4gloAqsaBS_Pm-gmQ95M2a9TspArcRv04M-76dffQC-cI4i0uoGuDetT', 1, 1),
(15, NULL, '', 'cb4VbvLj0P8:APA91bFruvxMlF-v2CYLu8N8Zg7RJXgGPDnNWIe5X5zBixWUnHfG8asJ4A3CFk-KVbH6WxsDBsEffyOGESYdBLBm5jQFTyXct-lIfTwSviV4BehZuK9QSzCFvLF2c-vlaQNwhfzRleQ1', 1, 1),
(16, NULL, '', 'cLPMntLErps:APA91bFtGE1cQGYho8JzNMmy1k3XmG44SoEW8twupGte0UiQONW3pcf7i2jEVRL0hubu5fAq12o4v3oMhShkblMQN_SO1lNevm_Io5iIjGJqO5NEsH-EfgWm97KRNTNzHwR0ITjV05Vv', 1, 1),
(17, NULL, '', 'e0e48IexZHA:APA91bGmk3l3leynNpXJfenx4oH1-FVd6ZvcTg6JByyWRq-4DIwwTRwyLAW0D9-txWUlg9Z1iQeitMoi1bTY4gloAqsaBS_Pm-gmQ95M2a9TspArcRv04M-76dffQC-cI4i0uoGuDetT', 1, 1),
(18, NULL, '', 'eF0k53x67ok:APA91bH6L51EeI4y2bFWeX48eZTXXx10LyC4eUMiIO72wYPSKUBfOdjKpXcMgZ1L8xE8v3KA1FI07mxgbnpoMRXuAp9l9gqSQ004kZuBRpsJVAh7DgOsVvNi68Sh1WWxiMZ-EEqt_RP-', 1, 1),
(19, 5, '', 'dmQMIu0svDo:APA91bHFh6c8e2AmXmZrPQLwA67VNBaY1-dFd4bhqLde5PRk6jIr5vxYYs_AU68MijvrdkW6foB29BAxda1i4swUEA1X5xsdO5z4VQv47aqvZKgUwEpRE0-4ZiPKrR5TRLPDi_kQsScs', 1, 1),
(20, 10, '', 'dZ-3LKYjVUg:APA91bH_XhCHq_Re8e7EQhbpvEQ0B75G1iys-4vuYKbQIGE-Nzkf9G-MjukcV5CcDcAmzNhJUwSmzFxgT13mrc7j6VlFswlkfTGVaQd3G_wh88cNHiw7SyAp0ogJsmoHysKX7r9Wy5TB', 1, 1),
(21, NULL, '', 'cb4VbvLj0P8:APA91bFruvxMlF-v2CYLu8N8Zg7RJXgGPDnNWIe5X5zBixWUnHfG8asJ4A3CFk-KVbH6WxsDBsEffyOGESYdBLBm5jQFTyXct-lIfTwSviV4BehZuK9QSzCFvLF2c-vlaQNwhfzRleQ1', 1, 1),
(22, NULL, '', 'dODsGxI1EM8:APA91bGsZTUcf0-_r4V1fI78mFUZI-67vnZlZkFgF1aZUMFyJRmtVw7nAPes96xKxDtM1orCaPHs-3RyWUz8Sxli-fc-34rdmo08bPzB3K_GAtm1L5mTsWZIhaY8tbnM4mSsVd1k9qT8', 1, 1),
(23, 19, '', 'fd4oE0ZqHpU:APA91bEW1JMz7UN9wqpELR3Lq7OgbiYQ4ddbTe74y0JdF4XD1ZBo--RzFSlPhatG7GPvuSMN4oG7tZiryoFRo666hvO_3s5ognU1H9CzZEWufckTrZkKFjjqFE54VJYQ18Hg71uMpJ4_', 1, 1),
(24, 20, '', 'f5Wt-qJZhqc:APA91bGRoPVZa2OIO3QVQP2mxE3PDYRjFdTynLkxC9RQUzD2buZpu5CGu5NDj6zwqAiD44FbP44dJHdotx9DmoU2J5i_Z7hiR_EFChU8zUqur2sQ3wgXywOB9DgBt7MnxS1IqhdO3nwQ', 1, 1),
(25, 13, '', 'fZRJzTul7SY:APA91bHdrp5OdruWDSFva_9Ry8uWXVufXr8RLYTfe8l3ohbnMb6FMa9h1IqiNkzx6cszfaoWDo_afb1eIf4N5v26ySsmYOfHu8dfdHmdpXjJVce2LHPU0HwXnr_0yQ20jomwj38bs4q7', 1, 1),
(26, NULL, '', 'cb4VbvLj0P8:APA91bFruvxMlF-v2CYLu8N8Zg7RJXgGPDnNWIe5X5zBixWUnHfG8asJ4A3CFk-KVbH6WxsDBsEffyOGESYdBLBm5jQFTyXct-lIfTwSviV4BehZuK9QSzCFvLF2c-vlaQNwhfzRleQ1', 1, 1),
(27, NULL, '', 'esatMzb8WRM:APA91bEPd5bN1JiVrTde4nqlVLRvSlmJHPCzGMvBOePQGDExCJKJuI7mSFzzoFjVk0HnQFGXtuXkvTw3K3UeFJxLuyouW3Mei_Zj2GkKHhB79PCN46gFSv6-71MPrqRtHLhf-v2t0L9y', 1, 1),
(28, NULL, '', 'cb4VbvLj0P8:APA91bFruvxMlF-v2CYLu8N8Zg7RJXgGPDnNWIe5X5zBixWUnHfG8asJ4A3CFk-KVbH6WxsDBsEffyOGESYdBLBm5jQFTyXct-lIfTwSviV4BehZuK9QSzCFvLF2c-vlaQNwhfzRleQ1', 1, 1),
(29, NULL, '', 'cIJPJ-gf3r4:APA91bF1vUczIBJvFipbBfaeb9-YYxbhLRLMQwvj_P76KXw12QE0NwtygCM57Jz_8Djy-ftBIDnYGJqV4J-6oIvqkDq_MllKu4WerxApQOFEEtAIUIVZsg8s_0LHk00xlCveaZkaK-96', 1, 1),
(30, NULL, '', 'cIJPJ-gf3r4:APA91bF1vUczIBJvFipbBfaeb9-YYxbhLRLMQwvj_P76KXw12QE0NwtygCM57Jz_8Djy-ftBIDnYGJqV4J-6oIvqkDq_MllKu4WerxApQOFEEtAIUIVZsg8s_0LHk00xlCveaZkaK-96', 1, 1),
(31, 12, '', 'eF0k53x67ok:APA91bH6L51EeI4y2bFWeX48eZTXXx10LyC4eUMiIO72wYPSKUBfOdjKpXcMgZ1L8xE8v3KA1FI07mxgbnpoMRXuAp9l9gqSQ004kZuBRpsJVAh7DgOsVvNi68Sh1WWxiMZ-EEqt_RP-', 1, 1),
(32, NULL, '', 'cIJPJ-gf3r4:APA91bF1vUczIBJvFipbBfaeb9-YYxbhLRLMQwvj_P76KXw12QE0NwtygCM57Jz_8Djy-ftBIDnYGJqV4J-6oIvqkDq_MllKu4WerxApQOFEEtAIUIVZsg8s_0LHk00xlCveaZkaK-96', 1, 1),
(33, NULL, '', 'cb4VbvLj0P8:APA91bFruvxMlF-v2CYLu8N8Zg7RJXgGPDnNWIe5X5zBixWUnHfG8asJ4A3CFk-KVbH6WxsDBsEffyOGESYdBLBm5jQFTyXct-lIfTwSviV4BehZuK9QSzCFvLF2c-vlaQNwhfzRleQ1', 1, 1),
(34, NULL, '', 'dmQMIu0svDo:APA91bHFh6c8e2AmXmZrPQLwA67VNBaY1-dFd4bhqLde5PRk6jIr5vxYYs_AU68MijvrdkW6foB29BAxda1i4swUEA1X5xsdO5z4VQv47aqvZKgUwEpRE0-4ZiPKrR5TRLPDi_kQsScs', 1, 1),
(35, NULL, '', 'cb4VbvLj0P8:APA91bFruvxMlF-v2CYLu8N8Zg7RJXgGPDnNWIe5X5zBixWUnHfG8asJ4A3CFk-KVbH6WxsDBsEffyOGESYdBLBm5jQFTyXct-lIfTwSviV4BehZuK9QSzCFvLF2c-vlaQNwhfzRleQ1', 1, 1),
(36, NULL, '', 'eojtIBRfP40:APA91bEmjq5jM0PSWLXl5NE0vAIsoc1D9puI8oabUcTXtq4-RObTbLXINzfujBYGCExPUmkb0KsFvxB_yYt_xdfiE2SkTfUli5qeTeJYG_AbPkdnSLWInYD3HCbZTFiXCkDR82tbgwMe', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_favourite`
--

CREATE TABLE `app_user_favourite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `object_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_invite_code`
--

CREATE TABLE `app_user_invite_code` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'inviter',
  `invite_code` varchar(20) NOT NULL COMMENT 'invited phone number',
  `created_at` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '1: approved 0: processing -1: rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_pro`
--

CREATE TABLE `app_user_pro` (
  `user_id` int(11) NOT NULL,
  `rate` float DEFAULT '0',
  `rate_count` int(11) DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `business_email` varchar(255) DEFAULT NULL,
  `business_address` varchar(255) DEFAULT NULL,
  `business_website` varchar(255) DEFAULT NULL,
  `business_phone` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_pro`
--

INSERT INTO `app_user_pro` (`user_id`, `rate`, `rate_count`, `description`, `business_name`, `business_email`, `business_address`, `business_website`, `business_phone`, `is_active`, `created_date`, `modified_date`) VALUES
(1, 10, 2, NULL, '', NULL, NULL, NULL, NULL, 1, NULL, NULL),
(5, 10, 6, NULL, 'huyên', NULL, NULL, NULL, NULL, 1, NULL, NULL),
(6, 7, 1, NULL, 'hehe', NULL, NULL, NULL, NULL, 1, NULL, NULL),
(7, 0, 0, NULL, 'hinh', NULL, NULL, NULL, NULL, 1, NULL, NULL),
(8, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 1, NULL, NULL),
(9, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 1, NULL, NULL),
(10, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(11, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(15, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_refund_request`
--

CREATE TABLE `app_user_refund_request` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` int(1) DEFAULT '0' COMMENT '-1: reject; 2: cancel;0: processing 1:approved',
  `type` varchar(255) NOT NULL COMMENT 'refund method',
  `note` text,
  `time` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_refund_request`
--

INSERT INTO `app_user_refund_request` (`id`, `buyer_id`, `seller_id`, `order_id`, `product_id`, `amount`, `status`, `type`, `note`, `time`, `created_at`, `modified_at`) VALUES
(1, 5, 1, 2, 1, 500, 0, 'cash', '', NULL, '2019-11-17 21:49:20', NULL),
(2, 5, 1, 3, 1, 32, 0, 'point', '', NULL, '2019-11-19 03:17:45', NULL),
(3, 14, 5, 37, 10, 139, 0, 'cash', '', NULL, '2019-11-26 20:14:58', NULL),
(4, 14, 5, 37, 10, 139, 0, 'cash', '', NULL, '2019-12-08 21:54:07', NULL),
(5, 1, 5, 42, 10, 139, 0, 'cash', '', NULL, '2019-12-11 01:48:15', NULL),
(6, 1, 5, 42, 10, 139, 0, 'point', '', NULL, '2019-12-11 01:48:19', NULL),
(7, 12, 15, 66, 23, 22.75, 0, 'cash', '', NULL, '2019-12-19 03:10:09', NULL),
(8, 12, 15, 66, 24, 32.01, 0, 'cash', '', NULL, '2019-12-19 03:19:30', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_report_image`
--

CREATE TABLE `app_user_report_image` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `modified_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_report_image`
--

INSERT INTO `app_user_report_image` (`id`, `report_id`, `image`, `created_at`, `modified_at`) VALUES
(1, 1, '1574048842_report_image.png', NULL, NULL),
(2, 2, '1574820865_report_image.png', NULL, NULL),
(3, 3, '1576050526_report_image.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_report_request`
--

CREATE TABLE `app_user_report_request` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(1) DEFAULT '0' COMMENT '1: approved 0: processing -1: rejected 2: canceled ',
  `note` text,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_report_request`
--

INSERT INTO `app_user_report_request` (`id`, `buyer_id`, `seller_id`, `order_id`, `product_id`, `status`, `note`, `created_at`, `modified_at`) VALUES
(1, 5, 1, 2, 1, 0, 'chans', '2019-11-17 21:47:22', NULL),
(2, 14, 5, 37, 10, 0, '2bbka', '2019-11-26 20:14:25', NULL),
(3, 1, 5, 42, 10, 0, 'oh no', '2019-12-11 01:48:46', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_review`
--

CREATE TABLE `app_user_review` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_role` varchar(20) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `destination_role` varchar(20) NOT NULL,
  `object_id` int(11) NOT NULL,
  `object_type` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `rate` float(3,1) NOT NULL,
  `is_active` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_review`
--

INSERT INTO `app_user_review` (`id`, `author_id`, `author_role`, `destination_id`, `destination_role`, `object_id`, `object_type`, `content`, `rate`, `is_active`, `created_date`, `modified_date`) VALUES
(1, 2, 'buyer', 1, 'seller', 1, 'deal', 'n', 10.0, '1', '2019-11-14 04:13:23', '2019-11-15 01:03:29'),
(2, 5, 'buyer', 1, 'seller', 1, 'deal', 'k', 10.0, '1', '2019-11-15 04:15:46', '2019-11-20 19:47:15'),
(3, 1, 'buyer', 5, 'seller', 9, 'deal', 'ok\n', 10.0, '1', '2019-11-18 04:55:45', '2019-11-26 02:15:17'),
(4, 5, 'buyer', 6, 'seller', 2, 'deal', 'dsf', 7.0, '1', '2019-11-25 20:33:12', '2019-11-25 20:33:43'),
(5, 14, 'buyer', 5, 'seller', 16, 'deal', 'good', 10.0, '1', '2019-11-26 20:06:36', '2019-11-26 20:06:36'),
(6, 15, 'buyer', 5, 'seller', 19, 'deal', 'goog', 10.0, '1', '2019-11-28 02:35:03', '2019-11-28 02:35:03'),
(7, 16, 'buyer', 5, 'seller', 11, 'deal', 'bhnn', 10.0, '1', '2019-11-28 03:10:29', '2019-11-28 03:10:29'),
(8, 1, 'buyer', 5, 'seller', 14, 'deal', 'hgjhgjghjhg', 10.0, '1', '2019-12-15 19:40:37', '2019-12-15 19:40:37'),
(9, 15, 'buyer', 5, 'seller', 9, 'deal', 'good product ', 10.0, '1', '2019-12-18 01:54:29', '2019-12-18 01:54:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_token`
--

CREATE TABLE `app_user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_token`
--

INSERT INTO `app_user_token` (`id`, `user_id`, `token`, `time`) VALUES
(1, 1, '690a26cf7291741367fb88c0781260e7', '2019-12-20 20:02:26'),
(2, 2, '2eb72e24fe57dec5b780b55351794678', '2019-11-14 21:04:09'),
(3, 5, '0fd199f0d611e05b10217129309b9a66', '2019-12-18 20:33:51'),
(4, 6, 'fa8ec705823568e179b68d8928b43c55', '2019-11-17 22:03:34'),
(5, 7, 'b7ed7e7965fb0e05230fb4f41c7feaaa', '2019-11-18 01:32:35'),
(6, 8, 'ceac56ab328b8f09e80758fece1e5cd9', '2019-11-18 04:32:20'),
(7, 9, '61b8b389f0c818ff5fdaf42e20e56b58', '2019-11-18 19:20:22'),
(8, 10, 'd084b71d2f3b7a9a9d407005ac7244c6', '2019-12-12 01:42:09'),
(9, 11, '5aa79772f2f53ab294a29562c2956c25', '2019-12-09 03:01:00'),
(10, 12, 'd7dca99ff4caf7f17adefbd6a7594136', '2019-12-19 03:20:35'),
(11, 13, '357c49a37fe30653687001604900047a', '2019-12-17 20:56:05'),
(12, 14, 'a69b1f3adcb88f93b0b66c193098cf13', '2019-12-17 22:04:41'),
(13, 15, '3665e96cfbeb892c670be7034ea4a9c7', '2019-12-20 21:18:05'),
(14, 16, '98ca29cfabbf071cf8d85e69f7e68fdd', '2019-12-17 20:50:21'),
(15, 17, '9b03044cfb4d0d4b5385da59b02f2f4b', '2019-11-28 08:01:19'),
(16, 18, '3a50a50cdc015e77c2d7496ed1aac5da', '2019-11-28 07:51:44'),
(17, 19, '47145b6bb7efe25c0666a6402ae27824', '2019-12-17 20:40:33'),
(18, 20, '5272c6f8f1c422b8812b8b3faaf5b1f6', '2019-12-17 20:41:57'),
(19, 21, '89f0ee864809898ace250d507199950c', '2019-12-20 21:35:35'),
(20, 22, '0a29be0f89040efba8fb5bd1d65558b3', '2019-12-20 22:47:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_transaction`
--

CREATE TABLE `app_user_transaction` (
  `id` bigint(20) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `external_transaction_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_visible` tinyint(1) DEFAULT NULL,
  `destination_id` int(11) DEFAULT NULL COMMENT 'lookup:@app_user',
  `destination_visible` tinyint(1) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `object_type` varchar(100) DEFAULT NULL,
  `amount` decimal(20,2) NOT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL COMMENT 'data:point,credit,cash,bank,paypal,wu',
  `note` varchar(2000) DEFAULT NULL,
  `time` varchar(20) NOT NULL,
  `action` varchar(255) DEFAULT NULL COMMENT 'data:system_adjust,exchange_point,redeem_point,transfer_point,trip_payment,deal_payment,deal_online,driver_online',
  `type` varchar(100) DEFAULT NULL COMMENT 'data:PLUS=+,MINUS=-',
  `is_active` varchar(100) NOT NULL COMMENT 'data:PENDING=0,APPROVED=1,REJECTED=-1',
  `trm_id` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_user` varchar(100) DEFAULT NULL,
  `application_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_transaction`
--

INSERT INTO `app_user_transaction` (`id`, `transaction_id`, `external_transaction_id`, `user_id`, `user_visible`, `destination_id`, `destination_visible`, `object_id`, `object_type`, `amount`, `currency`, `payment_method`, `note`, `time`, `action`, `type`, `is_active`, `trm_id`, `created_date`, `created_user`, `modified_date`, `modified_user`, `application_id`) VALUES
(1, '60C24EA910103B5', NULL, 5, 1, NULL, NULL, NULL, 'deal', '92.00', 'point', 'point', NULL, '1574331526', 'order', '-', '1', NULL, '2019-11-21 04:18:46', 'truong@gmail.com', NULL, NULL, NULL),
(2, '6E2F306EC19F126', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '3.20', 'point', 'point', NULL, '1574331526', 'deal_online', '-', '1', NULL, '2019-11-21 04:18:46', 'admin', NULL, NULL, NULL),
(3, '8FD948AD36C7946', NULL, 6, 1, 1, NULL, NULL, 'sell', '32.00', 'point', 'point', NULL, '1574331526', 'deal_online', '+', '1', NULL, '2019-11-21 04:18:46', 'admin', NULL, NULL, NULL),
(4, '21E823233DE1AC6', NULL, 6, 1, 6, NULL, NULL, 'COMMISSION_RATE', '4.00', 'point', 'point', NULL, '1574331526', 'deal_online', '-', '1', NULL, '2019-11-21 04:18:46', 'admin', NULL, NULL, NULL),
(5, '8C266F8682E36F6', NULL, 6, 1, 6, NULL, NULL, 'sell', '40.00', 'point', 'point', NULL, '1574331526', 'deal_online', '+', '1', NULL, '2019-11-21 04:18:46', 'admin', NULL, NULL, NULL),
(6, 'B0AEF3722EE5276', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '3.20', 'point', 'point', NULL, '1574333338', 'deal_online', '-', '1', NULL, '2019-11-21 04:48:58', 'admin', NULL, NULL, NULL),
(7, 'C584B2788D6A346', NULL, 6, 1, 1, NULL, NULL, 'sell', '32.00', 'point', 'point', NULL, '1574333338', 'deal_online', '+', '1', NULL, '2019-11-21 04:48:58', 'admin', NULL, NULL, NULL),
(8, 'C2BB08C3CAA7C26', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '3.20', 'point', 'point', NULL, '1574500463', 'deal_online', '-', '1', NULL, '2019-11-23 03:14:23', 'admin', NULL, NULL, NULL),
(9, 'A6D2978B9DC40F6', NULL, 6, 1, 1, NULL, NULL, 'sell', '32.00', 'point', 'point', NULL, '1574500463', 'deal_online', '+', '1', NULL, '2019-11-23 03:14:23', 'admin', NULL, NULL, NULL),
(10, '1564E799DE629A6', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '72.30', 'point', 'point', NULL, '1574820804', 'deal_online', '-', '1', NULL, '2019-11-26 20:13:24', 'admin', NULL, NULL, NULL),
(11, 'CE0196F17D75076', NULL, 6, 1, 5, NULL, NULL, 'sell', '723.00', 'point', 'point', NULL, '1574820804', 'deal_online', '+', '1', NULL, '2019-11-26 20:13:24', 'admin', NULL, NULL, NULL),
(12, '7DC7FD05C535E16', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '77.70', 'point', 'point', NULL, '1574823641', 'deal_online', '-', '1', NULL, '2019-11-26 21:00:41', 'admin', NULL, NULL, NULL),
(13, 'EAFC01F9F0A66F6', NULL, 6, 1, 1, NULL, NULL, 'sell', '777.00', 'point', 'point', NULL, '1574823641', 'deal_online', '+', '1', NULL, '2019-11-26 21:00:41', 'admin', NULL, NULL, NULL),
(14, '9699DCD566A59E6', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '13.90', 'point', 'point', NULL, '1574823641', 'deal_online', '-', '1', NULL, '2019-11-26 21:00:41', 'admin', NULL, NULL, NULL),
(15, '1B072E44A1B8326', NULL, 6, 1, 5, NULL, NULL, 'sell', '139.00', 'point', 'point', NULL, '1574823641', 'deal_online', '+', '1', NULL, '2019-11-26 21:00:41', 'admin', NULL, NULL, NULL),
(16, 'E66AF8F8566FA76', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '35.00', 'point', 'point', NULL, '1574838747', 'deal_online', '-', '1', NULL, '2019-11-27 01:12:27', 'admin', NULL, NULL, NULL),
(17, '5BDF2D0B15D63F6', NULL, 6, 1, 1, NULL, NULL, 'sell', '350.00', 'point', 'point', NULL, '1574838747', 'deal_online', '+', '1', NULL, '2019-11-27 01:12:27', 'admin', NULL, NULL, NULL),
(18, '1A893F6E7199D26', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1574930058', 'deal_online', '-', '1', NULL, '2019-11-28 02:34:18', 'admin', NULL, NULL, NULL),
(19, 'BF4C0081A4A11A6', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1574930058', 'deal_online', '+', '1', NULL, '2019-11-28 02:34:18', 'admin', NULL, NULL, NULL),
(20, '57A82F650B163E6', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1574932535', 'deal_online', '-', '1', NULL, '2019-11-28 03:15:35', 'admin', NULL, NULL, NULL),
(21, '0EC569733D57556', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1574932535', 'deal_online', '+', '1', NULL, '2019-11-28 03:15:35', 'admin', NULL, NULL, NULL),
(22, '21A93B9DE03DE86', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '43.90', 'point', 'point', NULL, '1575944953', 'deal_online', '-', '1', NULL, '2019-12-09 20:29:13', 'admin', NULL, NULL, NULL),
(23, '489ECF04034A6A6', NULL, 6, 1, 5, NULL, NULL, 'sell', '439.00', 'point', 'point', NULL, '1575944953', 'deal_online', '+', '1', NULL, '2019-12-09 20:29:13', 'admin', NULL, NULL, NULL),
(24, '334AF5E524A97E6', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '89.50', 'point', 'point', NULL, '1575945680', 'deal_online', '-', '1', NULL, '2019-12-09 20:41:20', 'admin', NULL, NULL, NULL),
(25, 'DBCF56B88B43BB6', NULL, 6, 1, 5, NULL, NULL, 'sell', '895.00', 'point', 'point', NULL, '1575945680', 'deal_online', '+', '1', NULL, '2019-12-09 20:41:20', 'admin', NULL, NULL, NULL),
(26, '597C6664D1DC0D1', NULL, 1, 1, 0, NULL, NULL, NULL, '1000.00', '', 'point', NULL, '1576028173', 'redeem_point', '-', '1', NULL, '2019-12-10 19:36:13', '0', NULL, NULL, NULL),
(27, '91AB23AC2FE4506', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '30.00', 'point', 'point', NULL, '1576049212', 'deal_online', '-', '1', NULL, '2019-12-11 01:26:52', 'admin', NULL, NULL, NULL),
(28, '234AF1D574BD0F6', NULL, 6, 1, 5, NULL, NULL, 'sell', '300.00', 'point', 'point', NULL, '1576049212', 'deal_online', '+', '1', NULL, '2019-12-11 01:26:52', 'admin', NULL, NULL, NULL),
(29, '0B7D01DD5E051E5', NULL, 5, 1, NULL, NULL, NULL, 'deal', '590.00', 'point', 'point', NULL, '1576050846', 'order', '-', '1', NULL, '2019-12-11 01:54:06', 'truong@gmail.com', NULL, NULL, NULL),
(30, '1D4DCCBD4CF3946', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '59.00', 'point', 'point', NULL, '1576050846', 'deal_online', '-', '1', NULL, '2019-12-11 01:54:06', 'admin', NULL, NULL, NULL),
(31, '5840094132086F6', NULL, 6, 1, 1, NULL, NULL, 'sell', '590.00', 'point', 'point', NULL, '1576050846', 'deal_online', '+', '1', NULL, '2019-12-11 01:54:06', 'admin', NULL, NULL, NULL),
(32, 'B23501014F61165', NULL, 5, 1, NULL, NULL, NULL, 'deal', '3010.00', 'point', 'point', NULL, '1576050925', 'order', '-', '1', NULL, '2019-12-11 01:55:25', 'truong@gmail.com', NULL, NULL, NULL),
(33, 'C480C6FB655E2F6', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '59.00', 'point', 'point', NULL, '1576050925', 'deal_online', '-', '1', NULL, '2019-12-11 01:55:25', 'admin', NULL, NULL, NULL),
(34, 'D205DCE2B951B36', NULL, 6, 1, 1, NULL, NULL, 'sell', '590.00', 'point', 'point', NULL, '1576050925', 'deal_online', '+', '1', NULL, '2019-12-11 01:55:25', 'admin', NULL, NULL, NULL),
(35, '7BA966F043311C5', NULL, 5, 1, NULL, NULL, NULL, 'deal', '90080.88', 'point', 'point', NULL, '1576124505', 'order', '-', '1', NULL, '2019-12-11 22:21:45', 'truong@gmail.com', NULL, NULL, NULL),
(36, 'F62E05300771DE6', NULL, 6, 1, 5, NULL, NULL, 'Admin transfer', '1000000.00', 'point', 'point', NULL, '1576124749', 'deal_online', '+', '1', NULL, '2019-12-11 22:25:49', '6', NULL, NULL, NULL),
(37, 'FEC0FBE8CFA3115', NULL, 5, 1, NULL, NULL, NULL, 'deal', '180161.76', 'point', 'point', NULL, '1576125800', 'order', '-', '1', NULL, '2019-12-11 22:43:20', 'truong@gmail.com', NULL, NULL, NULL),
(38, 'E8C3DC88C1A63D6', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1576286789', 'deal_online', '-', '1', NULL, '2019-12-13 19:26:29', 'admin', NULL, NULL, NULL),
(39, '6B59CF2C28C6C26', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1576286789', 'deal_online', '+', '1', NULL, '2019-12-13 19:26:29', 'admin', NULL, NULL, NULL),
(40, '8303983C52C2746', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1576286873', 'deal_online', '-', '1', NULL, '2019-12-13 19:27:53', 'admin', NULL, NULL, NULL),
(41, 'D1790E276BDF036', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1576286873', 'deal_online', '+', '1', NULL, '2019-12-13 19:27:53', 'admin', NULL, NULL, NULL),
(42, '39E889FA91EB0E6', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1576287059', 'deal_online', '-', '1', NULL, '2019-12-13 19:30:59', 'admin', NULL, NULL, NULL),
(43, '6E377D209513E76', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1576287059', 'deal_online', '+', '1', NULL, '2019-12-13 19:30:59', 'admin', NULL, NULL, NULL),
(44, 'EDB16AD681006E1', NULL, 1, 1, NULL, NULL, NULL, 'deal', '123.00', 'point', 'point', NULL, '1576287390', 'order', '-', '1', NULL, '2019-12-13 19:36:30', 'tri@gmail.com', NULL, NULL, NULL),
(45, '1ED9AA6C092EF46', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1576287390', 'deal_online', '-', '1', NULL, '2019-12-13 19:36:30', 'admin', NULL, NULL, NULL),
(46, 'C605181EDCB6216', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1576287390', 'deal_online', '+', '1', NULL, '2019-12-13 19:36:30', 'admin', NULL, NULL, NULL),
(47, '14951268B0A7D71', NULL, 1, 1, NULL, NULL, NULL, 'deal', '123.00', 'point', 'point', NULL, '1576287462', 'order', '-', '1', NULL, '2019-12-13 19:37:42', 'tri@gmail.com', NULL, NULL, NULL),
(48, '6F293CB50374516', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1576287462', 'deal_online', '-', '1', NULL, '2019-12-13 19:37:42', 'admin', NULL, NULL, NULL),
(49, '9AAF6CE0CDB9236', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1576287462', 'deal_online', '+', '1', NULL, '2019-12-13 19:37:42', 'admin', NULL, NULL, NULL),
(50, 'A4821F2F3AA2AE1', NULL, 1, 1, NULL, NULL, NULL, 'deal', '123.00', 'point', 'point', NULL, '1576287696', 'order', '-', '1', NULL, '2019-12-13 19:41:36', 'tri@gmail.com', NULL, NULL, NULL),
(51, '2BC587C8B35B916', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '32.20', 'point', 'point', NULL, '1576287696', 'deal_online', '-', '1', NULL, '2019-12-13 19:41:36', 'admin', NULL, NULL, NULL),
(52, '7D2310B2F256E76', NULL, 6, 1, 5, NULL, NULL, 'sell', '322.00', 'point', 'point', NULL, '1576287696', 'deal_online', '+', '1', NULL, '2019-12-13 19:41:36', 'admin', NULL, NULL, NULL),
(53, '38A840CE9EAA711', NULL, 1, 1, NULL, NULL, NULL, 'deal', '123.00', 'point', 'point', NULL, '1576287756', 'order', '-', '1', NULL, '2019-12-13 19:42:36', 'tri@gmail.com', NULL, NULL, NULL),
(54, 'CC8A687FA64E766', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '12.30', 'point', 'point', NULL, '1576287756', 'deal_online', '-', '1', NULL, '2019-12-13 19:42:36', 'admin', NULL, NULL, NULL),
(55, '652144206602536', NULL, 6, 1, 5, NULL, NULL, 'sell', '123.00', 'point', 'point', NULL, '1576287756', 'deal_online', '+', '1', NULL, '2019-12-13 19:42:36', 'admin', NULL, NULL, NULL),
(56, '8FC4A6B36E6B1E15', NULL, 15, 1, NULL, NULL, NULL, 'deal', '6299.72', 'point', 'point', NULL, '1576292996', 'order', '-', '1', NULL, '2019-12-13 21:09:56', 'phamvanlonghn@gmail.com', NULL, NULL, NULL),
(57, 'A6470E2303638E6', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '177.77', 'point', 'point', NULL, '1576292996', 'deal_online', '-', '1', NULL, '2019-12-13 21:09:56', 'admin', NULL, NULL, NULL),
(58, '82CC67A835F9F56', NULL, 6, 1, 1, NULL, NULL, 'sell', '1777.72', 'point', 'point', NULL, '1576292996', 'deal_online', '+', '1', NULL, '2019-12-13 21:09:56', 'admin', NULL, NULL, NULL),
(59, '69D88F2A366E096', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '452.20', 'point', 'point', NULL, '1576292996', 'deal_online', '-', '1', NULL, '2019-12-13 21:09:56', 'admin', NULL, NULL, NULL),
(60, '8E64D06A70A09A6', NULL, 6, 1, 5, NULL, NULL, 'sell', '4522.00', 'point', 'point', NULL, '1576292996', 'deal_online', '+', '1', NULL, '2019-12-13 21:09:56', 'admin', NULL, NULL, NULL),
(61, 'D607E74084D0666', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '152.40', 'point', 'point', NULL, '1576293996', 'deal_online', '-', '1', NULL, '2019-12-13 21:26:36', 'admin', NULL, NULL, NULL),
(62, 'F4956FEA75E8036', NULL, 6, 1, 5, NULL, NULL, 'sell', '1524.00', 'point', 'point', NULL, '1576293996', 'deal_online', '+', '1', NULL, '2019-12-13 21:26:36', 'admin', NULL, NULL, NULL),
(63, '8E1E8788A737726', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '14.70', 'point', 'point', NULL, '1576294870', 'deal_online', '-', '1', NULL, '2019-12-13 21:41:10', 'admin', NULL, NULL, NULL),
(64, '255BCCA298A6C96', NULL, 6, 1, 5, NULL, NULL, 'sell', '147.00', 'point', 'point', NULL, '1576294870', 'deal_online', '+', '1', NULL, '2019-12-13 21:41:10', 'admin', NULL, NULL, NULL),
(65, 'AB5123CEDC3DDC6', NULL, 6, 1, 1, NULL, NULL, 'COMMISSION_RATE', '14.70', 'point', 'point', NULL, '1576295091', 'deal_online', '-', '1', NULL, '2019-12-13 21:44:51', 'admin', NULL, NULL, NULL),
(66, 'EFD10107ACDF736', NULL, 6, 1, 1, NULL, NULL, 'sell', '147.00', 'point', 'point', NULL, '1576295091', 'deal_online', '+', '1', NULL, '2019-12-13 21:44:51', 'admin', NULL, NULL, NULL),
(67, '9D3C5AC3B941AD6', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '27.00', 'point', 'point', NULL, '1576466194', 'deal_online', '-', '1', NULL, '2019-12-15 21:16:34', 'admin', NULL, NULL, NULL),
(68, 'A5822C9ADFD8186', NULL, 6, 1, 5, NULL, NULL, 'sell', '270.00', 'point', 'point', NULL, '1576466194', 'deal_online', '+', '1', NULL, '2019-12-15 21:16:34', 'admin', NULL, NULL, NULL),
(69, '5FF8A2EDEC842515', NULL, 15, 1, NULL, NULL, NULL, 'deal', '100.00', 'point', 'point', NULL, '1576638007', 'order', '-', '1', NULL, '2019-12-17 21:00:07', 'phamvanlonghn@gmail.com', NULL, NULL, NULL),
(70, '4A4C733CB5B1226', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '10.00', 'point', 'point', NULL, '1576638007', 'deal_online', '-', '1', NULL, '2019-12-17 21:00:07', 'admin', NULL, NULL, NULL),
(71, 'F66A934D8B07836', NULL, 6, 1, 5, NULL, NULL, 'sell', '100.00', 'point', 'point', NULL, '1576638007', 'deal_online', '+', '1', NULL, '2019-12-17 21:00:07', 'admin', NULL, NULL, NULL),
(72, 'BE3AED7CAD2AF36', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '56.40', 'point', 'point', NULL, '1576655708', 'deal_online', '-', '1', NULL, '2019-12-18 01:55:08', 'admin', NULL, NULL, NULL),
(73, '879F9D84D63F606', NULL, 6, 1, 5, NULL, NULL, 'sell', '564.00', 'point', 'point', NULL, '1576655708', 'deal_online', '+', '1', NULL, '2019-12-18 01:55:08', 'admin', NULL, NULL, NULL),
(74, '03FCBC144B32206', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '41.20', 'point', 'point', NULL, '1576718908', 'deal_online', '-', '1', NULL, '2019-12-18 19:28:28', 'admin', NULL, NULL, NULL),
(75, '37E2B88C4D8E3A6', NULL, 6, 1, 5, NULL, NULL, 'sell', '412.00', 'point', 'point', NULL, '1576718908', 'deal_online', '+', '1', NULL, '2019-12-18 19:28:28', 'admin', NULL, NULL, NULL),
(76, '9951324DA35EB41', NULL, 1, 1, NULL, NULL, NULL, 'deal', '246.00', 'point', 'point', NULL, '1576749960', 'order', '-', '1', NULL, '2019-12-19 04:06:00', 'tri@gmail.com', NULL, NULL, NULL),
(77, 'CC3DB455CE74256', NULL, 6, 1, 5, NULL, NULL, 'COMMISSION_RATE', '24.60', 'point', 'point', NULL, '1576749960', 'deal_online', '-', '1', NULL, '2019-12-19 04:06:00', 'admin', NULL, NULL, NULL),
(78, '2743AAA962CD836', NULL, 6, 1, 5, NULL, NULL, 'sell', '246.00', 'point', 'point', NULL, '1576749960', 'deal_online', '+', '1', NULL, '2019-12-19 04:06:00', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_user_transaction_request`
--

CREATE TABLE `app_user_transaction_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `amount` float(13,2) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'data:redeem,transfer',
  `note` text,
  `status` int(1) DEFAULT NULL COMMENT 'data:PENDING=0,APPROVED=1,REJECTED=-1',
  `time` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `app_user_transaction_request`
--

INSERT INTO `app_user_transaction_request` (`id`, `user_id`, `destination_id`, `amount`, `type`, `note`, `status`, `time`, `created_date`, `modified_date`) VALUES
(1, 1, NULL, 1000.00, 'redeem', 'ôk', 1, '1576027976', '2019-12-10 19:32:56', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `id_user`, `name`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 625, 'Phone', 'admin', '2019-08-08 04:36:31', NULL),
(2, 625, 'Laptop', 'admin', '2019-08-08 04:37:41', NULL),
(3, 625, 'PC', 'admin', '2019-08-08 04:37:47', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_sub`
--

CREATE TABLE `category_sub` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category_sub`
--

INSERT INTO `category_sub` (`id`, `id_category`, `name`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 1, 'Smartphone', 'admin', '2019-08-08 04:36:42', '2019-08-08 04:36:51'),
(2, 1, 'Feature phone', 'admin', '2019-08-08 04:38:19', NULL),
(3, 2, 'Laptop Gaming', 'admin', '2019-08-08 04:38:30', '2019-08-08 04:38:47'),
(4, 2, 'Laptop Ultrabook', 'admin', '2019-08-08 04:38:59', NULL),
(5, 1, 'Tablet', 'admin', '2019-08-08 10:36:21', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `discount_amount`, `is_active`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 'VCB14', 100, 1, '', NULL, NULL),
(2, 'merdeka62', 10, 1, '', '2019-09-04 01:20:00', '2019-09-05 10:10:00'),
(3, 'magic007', 15, 2, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `person_push_name` varchar(5) NOT NULL DEFAULT 'admin',
  `message` text NOT NULL,
  `buyer_all` int(1) NOT NULL COMMENT '1: true, 0: false',
  `seller_all` int(1) DEFAULT NULL COMMENT '1: true, 0:false',
  `buyer_only` int(1) DEFAULT '0' COMMENT '1: true, 0:false',
  `buyer_id` int(11) DEFAULT NULL COMMENT '1: true, 0:false	',
  `seller_only` int(11) DEFAULT NULL COMMENT '1: true, 0:false',
  `seller_id` int(11) DEFAULT NULL COMMENT '1: true, 0:false	',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `notification`
--

INSERT INTO `notification` (`id`, `person_push_name`, `message`, `buyer_all`, `seller_all`, `buyer_only`, `buyer_id`, `seller_only`, `seller_id`, `created_at`) VALUES
(1, 'admin', 'Big sale', 1, 0, NULL, NULL, NULL, NULL, '2019-08-12 10:11:47'),
(2, 'admin', 'More discount for seller', 0, 1, NULL, NULL, NULL, NULL, '2019-08-12 10:12:28'),
(3, 'admin', 'Forgot something in your cart?', 0, 0, 1, 81, NULL, NULL, '2019-08-12 10:13:17'),
(4, 'admin', 'A report waiting', 0, 0, NULL, NULL, 1, 589, '2019-08-12 10:14:41'),
(5, 'admin', 'Chrismast sale 50%', 1, 0, NULL, NULL, NULL, NULL, '2019-08-13 10:07:15'),
(6, 'admin', 'hi testing', 1, 0, NULL, NULL, NULL, NULL, '2019-08-16 21:53:43'),
(7, 'admin', 'test power bro', 0, 1, NULL, NULL, NULL, NULL, '2019-08-17 06:29:36'),
(8, 'admin', 'test', 0, 1, NULL, NULL, NULL, NULL, '2019-08-20 00:03:02'),
(9, 'admin', 'haloooo', 1, 0, NULL, NULL, NULL, NULL, '2019-08-20 06:09:20'),
(10, 'admin', 'haloooo', 0, 1, NULL, NULL, NULL, NULL, '2019-08-21 03:13:43'),
(11, 'admin', 'test seller ', 0, 1, NULL, NULL, NULL, NULL, '2019-08-23 05:34:57'),
(12, 'admin', 'hello seller ', 0, 1, NULL, NULL, NULL, NULL, '2019-08-23 22:27:55'),
(13, 'admin', 'hello seller \r\n', 0, 1, NULL, NULL, NULL, NULL, '2019-08-24 04:16:53'),
(14, 'admin', 'hello buyer ', 1, 0, NULL, NULL, NULL, NULL, '2019-08-24 05:46:20'),
(15, 'admin', 'hi darling this is magic robot marketing testing', 0, 0, NULL, NULL, 1, 650, '2019-08-30 06:06:07'),
(16, 'admin', 'hi guys this magic robot marketing testing', 0, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:07:12'),
(17, 'admin', 'testing from robot marketing magic', 0, 0, NULL, NULL, 1, 638, '2019-08-30 06:15:02'),
(18, 'admin', 'hi jane', 0, 0, NULL, NULL, 1, 676, '2019-09-01 08:25:30'),
(19, 'admin', 'hi seller happy new year!', 0, 1, NULL, NULL, NULL, NULL, '2019-09-01 08:28:00'),
(20, 'admin', 'test seller', 0, 0, NULL, NULL, 1, 676, '2019-09-01 10:10:11'),
(21, 'admin', 'Sung kamu taymanghud,\r\nMagsukul in pag support niyyu..\r\n.\r\nSelamat datang Ke Dunia magic, Teruslah bersama kami \r\n#test', 0, 0, 1, 699, NULL, NULL, '2019-09-05 01:57:45'),
(22, 'admin', 'Hi we have miss you', 1, 0, NULL, NULL, NULL, NULL, '2019-09-06 04:25:43'),
(23, 'admin', 'hello guys', 0, 1, NULL, NULL, NULL, NULL, '2019-09-06 04:38:07'),
(24, 'admin', 'Assalamulaikum Sis Dr Ustazah Nurul Atiqah,\r\n.\r\nWe wish you best of luck, tabarakallhutaala and enjoyed your journey\r\nas your lucky day our ceo send his best regard to you..', 0, 0, NULL, NULL, 1, 636, '2019-09-06 04:53:09'),
(25, 'admin', 'dgfsdfgsdfgsdfg', 0, 1, NULL, NULL, NULL, NULL, '2019-11-27 03:18:42'),
(26, 'admin', 'wdrgwertwertert', 1, 0, NULL, NULL, NULL, NULL, '2019-11-27 03:19:13'),
(27, 'admin', 'TRi', 0, 0, 1, 15, NULL, NULL, '2019-11-28 02:20:38'),
(28, 'admin', 'dbfre', 0, 1, NULL, NULL, NULL, NULL, '2019-11-28 02:21:41'),
(29, 'admin', 'sbfntrjndg4374521', 1, 0, NULL, NULL, NULL, NULL, '2019-11-28 02:23:16'),
(30, 'admin', 'HelloWorld\r\n', 1, 0, NULL, NULL, NULL, NULL, '2019-11-28 02:26:02'),
(31, 'admin', 'dvsf', 1, 0, NULL, NULL, NULL, NULL, '2019-11-28 02:40:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `object_category`
--

CREATE TABLE `object_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `sort_order` int(5) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_top` tinyint(1) DEFAULT NULL,
  `is_hot` tinyint(1) DEFAULT NULL,
  `object_type` varchar(50) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `object_category`
--

INSERT INTO `object_category` (`id`, `parent_id`, `image`, `name`, `description`, `sort_order`, `is_active`, `is_top`, `is_hot`, `object_type`, `created_date`, `modified_date`) VALUES
(10, NULL, '1572490410853_object_category_image.jpg', 'Women\'s Fashion', '', 4, 1, 0, 1, '1', '2019-08-09 05:24:37', '2019-10-30 21:53:30'),
(14, NULL, '1572490423697_object_category_image.jpg', 'Books', '', 5, 1, 0, 0, 'book', '2019-08-17 04:20:04', '2019-10-30 21:53:43'),
(19, NULL, '1572490462428_object_category_image.jpg', 'Men\'s Fashion', '', 6, 1, 0, 0, 'men', '2019-08-17 04:28:41', '2019-10-30 21:54:22'),
(22, NULL, '15724904812_object_category_image.jpg', 'Electronics Accessories', '', 7, 1, 1, 1, 'e', '2019-08-17 04:30:29', '2019-10-30 21:54:41'),
(26, NULL, '1572490507755_object_category_image.jpg', 'Health and Household', '', 8, 1, 0, 0, 'h', '2019-08-17 04:34:20', '2019-10-30 21:55:07'),
(30, NULL, '1572490529568_object_category_image.jpg', 'Home & Kitchen', '', 9, 1, 1, 1, 'k', '2019-08-17 04:42:52', '2019-10-30 21:55:29'),
(40, NULL, '1572490598884_object_category_image.jpg', 'Restaurant', 'The best restaurant in town', 10, 1, 1, 1, 'more menu,more delicius,more cash back reward', '2019-08-21 18:49:55', '2019-10-30 21:56:38'),
(42, NULL, '1572490619761_object_category_image.jpg', 'Food Supplements', '', 11, 1, 1, 1, 'WE CARE YOUR HEALTH', '2019-08-21 19:33:54', '2019-10-30 21:56:59'),
(43, NULL, '1572490640136_object_category_image.jpg', 'Salon', '', 12, 1, 1, 1, 'the best oil', '2019-08-22 03:49:00', '2019-10-30 21:57:20'),
(45, NULL, '1572490658948_object_category_image.jpg', 'Preloved item', 'All product are preloved item', 13, 1, 1, 1, 'we sell quality preloved item', '2019-08-24 23:30:01', '2019-10-30 21:57:38'),
(47, NULL, '1572490672722_object_category_image.jpg', 'Hotel & Homestay', 'the best hotel and homestay valley.', 14, 1, 1, 1, 'Only the best service will give it to you.', '2019-08-30 06:47:29', '2019-10-30 21:57:52'),
(57, NULL, '1572490700219_object_category_image.jpg', 'Fresh Mart', 'The best fresh product, for you.', 15, 1, 1, 1, 'the more fresh product.', '2019-08-31 21:26:40', '2019-10-30 21:58:20'),
(63, NULL, '1572490724298_object_category_image.jpg', 'Agriculture', '', 16, 1, 1, 1, 'only the fresh', '2019-08-31 21:43:14', '2019-10-30 21:58:44'),
(67, NULL, '1572490762718_object_category_image.jpg', 'Software', '', 17, 1, 1, 1, 'only the best', '2019-09-02 05:39:37', '2019-10-30 21:59:22'),
(136, 10, '1572515095353_object_category_image.jpg', 'helo', '123', NULL, 1, 1, 1, '1', '2019-10-31 04:42:53', '2019-10-31 04:44:55'),
(137, 10, '1572515243629_object_category_image.jpg', 'asdfasdfasfdasdf', 'asdfasdfasdf', 123123, 1, 1, 1, '11', '2019-10-31 04:47:23', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `object_relation`
--

CREATE TABLE `object_relation` (
  `id` bigint(20) NOT NULL,
  `object_id` bigint(20) NOT NULL,
  `object_type` varchar(100) NOT NULL,
  `object2_id` bigint(20) NOT NULL,
  `object2_type` varchar(100) NOT NULL,
  `relation_type` varchar(100) DEFAULT NULL,
  `sort_order` int(5) NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `object_relation`
--

INSERT INTO `object_relation` (`id`, `object_id`, `object_type`, `object2_id`, `object2_type`, `relation_type`, `sort_order`, `created_date`, `created_user`) VALUES
(1, 1, 'product', 1, 'cms_blogs', '2', 0, NULL, NULL),
(2, 1, 'product', 2, 'cms_blogs', '2', 0, NULL, NULL),
(17, 1, 'music_artist', 1, 'music_song', '2', 1, '2016-09-26', '6'),
(24, 2, 'music_artist', 1, 'music_song', 'sing', 1, '2016-09-28', '6'),
(25, 2, 'music_artist', 2, 'music_song', 'sing', 2, '2016-09-28', '6'),
(26, 2, 'music_artist', 1, 'music_song', 'compose', 1, '2016-09-28', '6'),
(27, 2, 'music_artist', 3, 'music_song', 'compose', 2, '2016-09-28', '6'),
(89, 3, 'music_song', 3, 'music_artist', '', 1, '2016-10-09', '6'),
(116, 1, 'music_song', 1, 'music_artist', '', 1, '2016-10-20', '6'),
(117, 1, 'music_song', 3, 'music_artist', '', 2, '2016-10-20', '6'),
(118, 1, 'music_playlist', 1, 'music_song', '', 1, '2016-10-20', '6'),
(119, 1, 'music_playlist', 2, 'music_song', '', 2, '2016-10-20', '6'),
(120, 1, 'music_playlist', 3, 'music_song', '', 3, '2016-10-20', '6'),
(121, 1, 'music_artist', 1, 'music_song', '', 1, '2016-11-13', '6'),
(122, 1, 'music_artist', 2, 'music_song', '', 2, '2016-11-13', '6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'buyer_id',
  `status` int(1) NOT NULL COMMENT '1: Approved 0: Processing -1: Rejected 2: Canceled 3: Paid 4: Not Paid 5: Deliveried',
  `billingName` varchar(255) DEFAULT NULL,
  `billingPhone` varchar(255) DEFAULT NULL,
  `billingAddress` varchar(255) DEFAULT NULL,
  `billingEmail` varchar(255) DEFAULT NULL,
  `billingPostcode` varchar(255) DEFAULT NULL,
  `shippingName` varchar(255) DEFAULT NULL,
  `shippingPhone` varchar(255) DEFAULT NULL,
  `shippingAddress` varchar(255) DEFAULT NULL,
  `shippingEmail` varchar(255) DEFAULT NULL,
  `shippingPostcode` varchar(255) DEFAULT NULL,
  `paymentMethod` varchar(200) NOT NULL,
  `content` text,
  `status_user` int(11) NOT NULL DEFAULT '0',
  `total` float NOT NULL,
  `vat` float DEFAULT NULL,
  `transportFee` float DEFAULT NULL,
  `transportDes` varchar(250) DEFAULT NULL,
  `transportType` varchar(250) DEFAULT NULL,
  `type_product` varchar(20) NOT NULL DEFAULT 'product',
  `token_payment` varchar(100) DEFAULT NULL,
  `createDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seller_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `user_id`, `status`, `billingName`, `billingPhone`, `billingAddress`, `billingEmail`, `billingPostcode`, `shippingName`, `shippingPhone`, `shippingAddress`, `shippingEmail`, `shippingPostcode`, `paymentMethod`, `content`, `status_user`, `total`, `vat`, `transportFee`, `transportDes`, `transportType`, `type_product`, `token_payment`, `createDate`, `seller_id`) VALUES
(1, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 515, 0, 0, '', '', '\'p\'', NULL, '2019-11-18 22:30:06', 0),
(2, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 535, 0, 0, '', '', '\'p\'', NULL, '2019-11-18 22:34:15', 0),
(3, 5, 2, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 72, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 02:49:48', 0),
(4, 5, 2, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 72, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:01:43', 0),
(5, 5, 2, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 32, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:12:09', 0),
(6, 5, 2, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 72, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:13:11', 0),
(7, 5, 5, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 72, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:14:42', 0),
(8, 5, 2, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 32, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:17:16', 0),
(9, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 72, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:26:55', 0),
(10, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 72, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:30:19', 0),
(11, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 104, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:33:37', 0),
(12, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 4904, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 03:47:32', 0),
(13, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 32, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 04:20:47', 0),
(14, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 04:21:28', 0),
(15, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 04:24:53', 0),
(16, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 04:25:09', 0),
(17, 5, 5, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 04:25:46', 0),
(18, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-19 04:35:40', 0),
(19, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 520, 0, 0, '', '', '\'p\'', NULL, '2019-11-20 21:38:04', 0),
(20, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 520, 0, 0, '', '', '\'p\'', NULL, '2019-11-20 21:38:04', 0),
(21, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 02:57:22', 0),
(22, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 02:59:25', 0),
(23, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 02:59:46', 0),
(24, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 03:07:07', 0),
(25, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 03:27:11', 0),
(26, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 03:53:29', 0),
(27, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 03:53:57', 0),
(28, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 03:56:28', 0),
(29, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 04:02:17', 0),
(30, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 04:09:06', 0),
(31, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 04:09:58', 0),
(32, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 04:13:13', 0),
(33, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 04:16:14', 0),
(34, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 92, 0, 0, '', '', '\'p\'', NULL, '2019-11-21 04:18:46', 0),
(35, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 160, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-11-21 04:48:59', 0),
(36, 11, 0, 'tffff', '08596494', 'nxjsns', 'dđ', '', '', '', '', '', '', 'cash', 'ha dong- jdh- sjfjjs', 0, 928, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-11-23 03:14:23', 0),
(37, 14, 5, 'minb', '0998319709', 'phu thu - tay mo - ha noi', 'minbvu@gmail.com', '', '', '', '', '', '', 'cash', '18', 0, 684, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-11-26 20:13:24', 0),
(38, 11, 5, 'Hà Trần', '00080085', 'b.', 'tranha18042001@gmail.com', '', '', '', '', '', '', 'cash', 'ttygg', 0, 3652, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-11-26 21:00:41', 0),
(39, 10, 0, 'Trí Phạm', '008578898', '', 'tripmph05786@fpt.edu.vn', '', '', '', '', '', '', 'cash', 'h noi', 0, 547, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-11-27 01:12:27', 0),
(40, 15, 0, 'Phạm Văn Long', '664665', 'hdhdjjwjf', 'phamvanlonghn@gmail.com', '', '', '', '', '', '', 'cash', 'jjdjrjw', 0, 322, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-11-28 02:34:18', 0),
(41, 16, 0, 'Jone smith ken', '04690460044', '', 'jstrangpv@gmail.com', '', '', '', '', '', '', 'cash', 'mình lavhe. jajygeh', 0, 123, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-11-28 03:15:35', 0),
(42, 1, 5, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 433, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-09 20:29:14', 0),
(43, 16, 0, 'Jone smith ken', '2500', 'dđ', 'jstrangpv@gmail.com', '', '', '', '', '', '', 'cash', 'ffd', 0, 1178, 0, 60, '', 'Saving delivery', '\'p\'', NULL, '2019-12-09 20:41:20', 0),
(44, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 294, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-11 01:26:53', 0),
(45, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 590, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-11 01:54:06', 0),
(46, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 3010, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-11 01:55:25', 0),
(47, 5, 5, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 90080.9, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-11 22:21:45', 0),
(48, 5, 5, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 3111110, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-11 22:27:57', 0),
(49, 5, 5, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 1555560, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-11 22:31:11', 0),
(50, 5, 0, 'Trường Nguyễn', '+84 5457576', 'Hà Nội', 'truong@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 180162, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-11 22:43:20', 0),
(51, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 644, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 19:26:30', 0),
(52, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 644, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 19:27:53', 0),
(53, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 644, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 19:30:59', 0),
(54, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 123, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 19:36:30', 0),
(55, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 123, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 19:37:43', 0),
(56, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 123, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 19:41:36', 0),
(57, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 123, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 19:42:36', 0),
(58, 15, 0, 'Phạm Văn Long', '+84 3656427546', 'rsdk', 'phamvanlonghn@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 6299.72, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 21:09:56', 0),
(59, 15, 0, 'Phạm Văn Long', '+84 3656427546', 'rsdk', 'phamvanlonghn@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 1524, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 21:26:36', 0),
(60, 15, 0, 'Phạm Văn Long', '+84 3656427546', 'rsdk', 'phamvanlonghn@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 147, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 21:41:10', 0),
(61, 15, 0, 'Phạm Văn Long', '+84 3656427546', 'rsdk', 'phamvanlonghn@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 147, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-13 21:44:52', 0),
(62, 1, 0, 'Minh Trí', '+84 0392662642', 'phúc diễn bắc từ liêm hà nội', 'tri@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 270, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-15 21:16:35', 0),
(63, 15, 0, 'Phạm Văn Long', '+84 3656427546', 'rsdk', 'phamvanlonghn@gmail.com', '', '', '', '', '', '', 'point', 'no content!', 0, 100, 0, 60, '', 'Saving delivery', '\'p\'', NULL, '2019-12-17 21:00:07', 0),
(64, 15, 0, 'Phạm Văn Long', '+84 3656427546', 'rsdk', 'phamvanlonghn@gmail.com', '', '', '', '', '', '', 'cash', 'no content!', 0, 564, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-18 01:55:08', 0),
(65, 16, 0, 'Jone smith ken', '0968649409', '', 'jstrangpv@gmail.com', '', '', '', '', '', '', 'cash', 'van phu - ba do ng - ha noi', 0, 538.06, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-18 19:28:28', 0),
(66, 12, 0, 'Thien Tran', '0987949866', '', 'suusoft@gmail.com', '', '', '', '', '', '', 'cash', 'Joan keim - ha noi', 0, 116.8, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-19 03:09:27', 0),
(67, 12, 0, 'Thien Tran', '0987949866', '', 'suusoft@gmail.com', '', '', '', '', '', '', 'cash', 'Joan keim - ha noi', 0, 116.8, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-19 03:19:00', 0),
(68, 1, 0, 'Thien Tran', '0987949866', '', 'suusoft@gmail.com', '', '', '', '', '', '', 'point', 'Joan keim - ha noi', 0, 246, 0, 40, '', 'Fast delivery', '\'p\'', NULL, '2019-12-19 04:06:01', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(1) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `classId` int(11) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `schedule` text COMMENT 'json array',
  `quantity` int(10) NOT NULL,
  `price` float NOT NULL,
  `subTotal` float NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `orderId`, `productId`, `productName`, `classId`, `class`, `startDate`, `endDate`, `schedule`, `quantity`, `price`, `subTotal`, `color`, `size`, `created_at`) VALUES
(1, 17, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-19 10:25:46'),
(2, 18, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-19 10:35:40'),
(3, 19, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 15, 32, 480, 'red', 's', '2019-11-21 03:38:04'),
(4, 20, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 15, 32, 480, 'red', 's', '2019-11-21 03:38:04'),
(5, 21, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 08:57:22'),
(6, 22, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 08:59:25'),
(7, 23, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 08:59:46'),
(8, 24, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 09:07:07'),
(9, 25, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 09:27:11'),
(10, 26, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 09:53:29'),
(11, 26, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 09:53:29'),
(12, 27, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 09:53:57'),
(13, 27, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 09:53:57'),
(14, 28, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 09:56:28'),
(15, 28, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 09:56:28'),
(16, 29, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 10:02:17'),
(17, 29, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 10:02:17'),
(18, 30, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 10:09:06'),
(19, 30, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 10:09:06'),
(20, 31, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 10:09:58'),
(21, 31, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 10:09:58'),
(22, 32, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 10:13:13'),
(23, 32, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 10:13:13'),
(24, 33, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 10:16:14'),
(25, 33, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 10:16:14'),
(26, 34, 1, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 32, 32, 'red', 's', '2019-11-21 10:18:46'),
(27, 34, 2, '[FREESHIP50K] Hàng Mới Về Áo xẻ hông dài tay trơn GIÁ SỈ Ulzang', NULL, NULL, NULL, NULL, NULL, 1, 40, 40, 'red', 's', '2019-11-21 10:18:46'),
(28, 35, 1, 'Quần âu nam cao cấp lịch sự chống nhăn màu đen chuẩn soái ca Hàn Quốc', NULL, NULL, NULL, NULL, NULL, 5, 32, 160, 'red', 's', '2019-11-21 10:48:59'),
(29, 36, 1, 'Quần âu nam cao cấp lịch sự chống nhăn màu đen chuẩn soái ca Hàn Quốc', NULL, NULL, NULL, NULL, NULL, 29, 32, 928, 'red', 's', '2019-11-23 09:14:23'),
(30, 37, 10, 'Áo nữ tay dài form rộng phong cách Hàn Quốc cá tính 4.8', NULL, NULL, NULL, NULL, NULL, 1, 139, 139, 'red', 's', '2019-11-27 02:13:24'),
(31, 37, 11, 'Áo nữ kiểu rộng kẻ sọc thời trang Hàn Quốc', NULL, NULL, NULL, NULL, NULL, 1, 434, 434, 'red', 's', '2019-11-27 02:13:24'),
(32, 37, 16, 'Áo 2 dây chất liệu lụa sữa màu trơn thời trang cho nữ', NULL, NULL, NULL, NULL, NULL, 1, 150, 150, 'red', 's', '2019-11-27 02:13:24'),
(33, 38, 3, 'Quần Jogger Kaki nam Chất Xịn màu Đen', NULL, NULL, NULL, NULL, NULL, 8, 333, 2664, 'red', 's', '2019-11-27 03:00:41'),
(34, 38, 6, '[Quần Nam Đẹp] Quần Thể Thao Nam Phối Kẻ Cao Cấp Chất Thun Co Dãn SIêu Bền Đẹp', NULL, NULL, NULL, NULL, NULL, 2, 444, 888, 'red', 's', '2019-11-27 03:00:41'),
(35, 38, 10, 'Áo nữ tay dài form rộng phong cách Hàn Quốc cá tính 4.8', NULL, NULL, NULL, NULL, NULL, 1, 139, 139, 'red', 's', '2019-11-27 03:00:41'),
(36, 39, 4, 'Quần âu nam -Quần tây phong cách hàn quốc, chất liệu đẹp,co giãn nhẹ BIGMEN', NULL, NULL, NULL, NULL, NULL, 2, 200, 400, 'red', 's', '2019-11-27 07:12:28'),
(37, 39, 5, 'Quần nam đen/rằn ri', NULL, NULL, NULL, NULL, NULL, 1, 150, 150, 'red', 's', '2019-11-27 07:12:28'),
(38, 40, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 322, 322, 'red', 's', '2019-11-28 08:34:18'),
(39, 41, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 322, 322, 'red', 's', '2019-11-28 09:15:35'),
(40, 42, 10, 'HZSONNE Women\'s Lantern Sleeve Open Front Side Pocket Shawl Collar Chunky Knit Blouses Lightweight Cardigan Sweater', NULL, NULL, NULL, NULL, NULL, 1, 139, 139, 'red', 's', '2019-12-10 02:29:14'),
(41, 42, 13, 'HaoKe Women Girls Japanese Kawaii Strawberry Milk Box Graphic T-Shirt Fairy Kei Short Sleeve Pink Gift', NULL, NULL, NULL, NULL, NULL, 1, 150, 150, 'red', 's', '2019-12-10 02:29:14'),
(42, 42, 15, 'GK-O Mori Girl Cute Fashion False Two-Piece Printed Stitching Fleece Pullover Sweatshirt', NULL, NULL, NULL, NULL, NULL, 1, 150, 150, 'red', 's', '2019-12-10 02:29:14'),
(43, 43, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 2, 322, 644, 'red', 's', '2019-12-10 02:41:20'),
(44, 43, 10, 'HZSONNE Women\'s Lantern Sleeve Open Front Side Pocket Shawl Collar Chunky Knit Blouses Lightweight Cardigan Sweater', NULL, NULL, NULL, NULL, NULL, 1, 139, 139, 'red', 's', '2019-12-10 02:41:20'),
(45, 43, 11, 'Packitcute Autumn Women\'s Korean Cute Long Sleeve Loose False Two-Piece Sweatshirts', NULL, NULL, NULL, NULL, NULL, 1, 434, 434, 'red', 's', '2019-12-10 02:41:20'),
(46, 44, 12, 'WDIRARA Women\'s Casual Long Sleeve Plaid Cold Shoulder Pullover Sweatshirt', NULL, NULL, NULL, NULL, NULL, 1, 150, 150, 'red', 's', '2019-12-11 07:26:53'),
(47, 44, 19, 'The Testaments: The Sequel to The Handmaid\'s Tale', NULL, NULL, NULL, NULL, NULL, 1, 150, 150, 'red', 's', '2019-12-11 07:26:53'),
(48, 45, 2, 'Haggar Men\'s Cool 18 Hidden Expandable-Waist Plain-Front Pant', NULL, NULL, NULL, NULL, NULL, 1, 590, 590, 'red', 's', '2019-12-11 07:54:06'),
(49, 46, 2, 'Haggar Men\'s Cool 18 Hidden Expandable-Waist Plain-Front Pant', NULL, NULL, NULL, NULL, NULL, 4, 590, 2360, 'red', 's', '2019-12-11 07:55:25'),
(50, 46, 23, 'Nêw', NULL, NULL, NULL, NULL, NULL, 13, 50, 650, 'red', 's', '2019-12-11 07:55:25'),
(51, 47, 28, 'Fufyf', NULL, NULL, NULL, NULL, NULL, 1, 55532, 55532, 'red', 's', '2019-12-12 04:21:45'),
(52, 48, 28, 'Fufyf', NULL, NULL, NULL, NULL, NULL, 2, 1555560, 3111110, 'red', 's', '2019-12-12 04:27:57'),
(53, 49, 28, 'Fufyf', NULL, NULL, NULL, NULL, NULL, 1, 1555560, 1555560, 'red', 's', '2019-12-12 04:31:11'),
(54, 50, 28, 'Fufyf', NULL, NULL, NULL, NULL, NULL, 2, 90080.9, 180162, 'red', 's', '2019-12-12 04:43:20'),
(55, 51, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 2, 322, 644, 'red', 's', '2019-12-14 01:26:30'),
(56, 52, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 2, 322, 644, 'red', 's', '2019-12-14 01:27:53'),
(57, 53, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 2, 322, 644, 'red', 's', '2019-12-14 01:30:59'),
(58, 54, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 322, 322, 'red', 's', '2019-12-14 01:36:30'),
(59, 55, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 322, 322, 'red', 's', '2019-12-14 01:37:43'),
(60, 56, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 322, 322, 'red', 's', '2019-12-14 01:41:36'),
(61, 57, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 322, 322, 'red', 's', '2019-12-14 01:42:36'),
(62, 58, 2, 'Haggar Men\'s Cool 18 Hidden Expandable-Waist Plain-Front Pant', NULL, NULL, NULL, NULL, NULL, 2, 590, 1180, 'red', 's', '2019-12-14 03:09:56'),
(63, 58, 3, 'FANZHUAN Fashion Pants for Men Slim Fit Casual', NULL, NULL, NULL, NULL, NULL, 1, 6.72, 6.72, 'red', 's', '2019-12-14 03:09:56'),
(64, 58, 4, 'LEE Men\'s Performance Series Extreme Comfort Slim Pant', NULL, NULL, NULL, NULL, NULL, 1, 150, 150, 'red', 's', '2019-12-14 03:09:56'),
(65, 58, 5, 'ITALY MORN Men\'s Chino Jogger Pants', NULL, NULL, NULL, NULL, NULL, 3, 147, 441, 'red', 's', '2019-12-14 03:09:56'),
(66, 58, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 3, 123, 369, 'red', 's', '2019-12-14 03:09:56'),
(67, 58, 10, 'HZSONNE Women\'s Lantern Sleeve Open Front Side Pocket Shawl Collar Chunky Knit Blouses Lightweight Cardigan Sweater', NULL, NULL, NULL, NULL, NULL, 3, 100, 300, 'red', 's', '2019-12-14 03:09:56'),
(68, 58, 11, 'Packitcute Autumn Women\'s Korean Cute Long Sleeve Loose False Two-Piece Sweatshirts', NULL, NULL, NULL, NULL, NULL, 4, 412, 1648, 'red', 's', '2019-12-14 03:09:56'),
(69, 58, 12, 'WDIRARA Women\'s Casual Long Sleeve Plaid Cold Shoulder Pullover Sweatshirt', NULL, NULL, NULL, NULL, NULL, 2, 147, 294, 'red', 's', '2019-12-14 03:09:56'),
(70, 58, 13, 'HaoKe Women Girls Japanese Kawaii Strawberry Milk Box Graphic T-Shirt Fairy Kei Short Sleeve Pink Gift', NULL, NULL, NULL, NULL, NULL, 2, 147, 294, 'red', 's', '2019-12-14 03:09:56'),
(71, 58, 14, 'Womens Sweatshirts, Stripe Long Sleeve Fashion Casual Cute Sweatshirts Pullover', NULL, NULL, NULL, NULL, NULL, 1, 147, 147, 'red', 's', '2019-12-14 03:09:56'),
(72, 58, 16, 'GK-O Japanese Mori Girl Lolita Retro Patchwork Embroidery Cotton Loose Dress', NULL, NULL, NULL, NULL, NULL, 1, 147, 147, 'red', 's', '2019-12-14 03:09:56'),
(73, 58, 19, 'The Testaments: The Sequel to The Handmaid\'s Tale', NULL, NULL, NULL, NULL, NULL, 5, 147, 735, 'red', 's', '2019-12-14 03:09:56'),
(74, 58, 20, 'TWild Game: My Mother, Her Lover, and Me', NULL, NULL, NULL, NULL, NULL, 2, 147, 294, 'red', 's', '2019-12-14 03:09:56'),
(75, 58, 21, 'Quichotte: A Novel', NULL, NULL, NULL, NULL, NULL, 2, 147, 294, 'red', 's', '2019-12-14 03:09:56'),
(76, 59, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 10, 123, 1230, 'red', 's', '2019-12-14 03:26:36'),
(77, 59, 20, 'TWild Game: My Mother, Her Lover, and Me', NULL, NULL, NULL, NULL, NULL, 2, 147, 294, 'red', 's', '2019-12-14 03:26:36'),
(78, 60, 13, 'HaoKe Women Girls Japanese Kawaii Strawberry Milk Box Graphic T-Shirt Fairy Kei Short Sleeve Pink Gift', NULL, NULL, NULL, NULL, NULL, 1, 147, 147, 'red', 's', '2019-12-14 03:41:10'),
(79, 61, 5, 'ITALY MORN Men\'s Chino Jogger Pants', NULL, NULL, NULL, NULL, NULL, 1, 147, 147, 'red', 's', '2019-12-14 03:44:52'),
(80, 62, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 123, 123, 'red', 's', '2019-12-16 03:16:35'),
(81, 62, 21, 'Quichotte: A Novel', NULL, NULL, NULL, NULL, NULL, 1, 147, 147, 'red', 's', '2019-12-16 03:16:35'),
(82, 63, 10, 'HZSONNE Women\'s Lantern Sleeve Open Front Side Pocket Shawl Collar Chunky Knit Blouses Lightweight Cardigan Sweater', NULL, NULL, NULL, NULL, NULL, 1, 100, 100, 'red', 's', '2019-12-18 03:00:07'),
(83, 64, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 1, 123, 123, 'red', 's', '2019-12-18 07:55:09'),
(84, 64, 14, 'Womens Sweatshirts, Stripe Long Sleeve Fashion Casual Cute Sweatshirts Pullover', NULL, NULL, NULL, NULL, NULL, 3, 147, 441, 'red', 's', '2019-12-18 07:55:09'),
(85, 65, 11, 'Packitcute Autumn Women\'s Korean Cute Long Sleeve Loose False Two-Piece Sweatshirts', NULL, NULL, NULL, NULL, NULL, 1, 412, 412, 'red', 's', '2019-12-19 01:28:29'),
(86, 65, 24, 'Topstype Women\'s Color Block Chest Cutout Tunics Long Sleeve Shirts Scoop Neck Blouse Casual Loose Tops', NULL, NULL, NULL, NULL, NULL, 2, 32.01, 64.02, 'red', 's', '2019-12-19 01:28:29'),
(87, 65, 25, ' Chaps Women\'s Long Sleeve Non Iron Broadcloth-Shirt', NULL, NULL, NULL, NULL, NULL, 1, 62.04, 62.04, 'red', 's', '2019-12-19 01:28:29'),
(88, 66, 23, 'Halife Women\'s Long Sleeve/Short Sleeve Boat Neck Off Shoulder Blouse Tops', NULL, NULL, NULL, NULL, NULL, 1, 22.75, 22.75, 'red', 's', '2019-12-19 09:09:27'),
(89, 66, 24, 'Topstype Women\'s Color Block Chest Cutout Tunics Long Sleeve Shirts Scoop Neck Blouse Casual Loose Tops', NULL, NULL, NULL, NULL, NULL, 1, 32.01, 32.01, 'red', 's', '2019-12-19 09:09:27'),
(90, 66, 25, ' Chaps Women\'s Long Sleeve Non Iron Broadcloth-Shirt', NULL, NULL, NULL, NULL, NULL, 1, 62.04, 62.04, 'red', 's', '2019-12-19 09:09:27'),
(91, 67, 23, 'Halife Women\'s Long Sleeve/Short Sleeve Boat Neck Off Shoulder Blouse Tops', NULL, NULL, NULL, NULL, NULL, 1, 22.75, 22.75, 'red', 's', '2019-12-19 09:19:00'),
(92, 67, 24, 'Topstype Women\'s Color Block Chest Cutout Tunics Long Sleeve Shirts Scoop Neck Blouse Casual Loose Tops', NULL, NULL, NULL, NULL, NULL, 1, 32.01, 32.01, 'red', 's', '2019-12-19 09:19:00'),
(93, 67, 25, ' Chaps Women\'s Long Sleeve Non Iron Broadcloth-Shirt', NULL, NULL, NULL, NULL, NULL, 1, 62.04, 62.04, 'red', 's', '2019-12-19 09:19:00'),
(94, 68, 9, 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', NULL, NULL, NULL, NULL, NULL, 2, 123, 246, 'red', 's', '2019-12-19 10:06:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_deal`
--

CREATE TABLE `product_deal` (
  `id` bigint(11) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `attachment` varchar(300) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `content` text,
  `category_id` varchar(500) DEFAULT '0',
  `seller_id` int(11) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '0' COMMENT 'from product_id',
  `price` double(13,2) DEFAULT '0.00',
  `sale_price` double(13,2) DEFAULT '0.00',
  `discount` double(13,2) DEFAULT '0.00',
  `discount_rate` int(3) DEFAULT '0',
  `discount_type` varchar(20) DEFAULT NULL,
  `discount_expired` datetime DEFAULT NULL,
  `is_online` tinyint(1) DEFAULT '0' COMMENT 'group:online',
  `online_started` varchar(20) DEFAULT NULL COMMENT 'group:online',
  `online_duration` int(11) DEFAULT '0' COMMENT 'group:online',
  `is_premium` tinyint(1) UNSIGNED DEFAULT '0',
  `is_renew` tinyint(1) DEFAULT '0',
  `status` varchar(100) DEFAULT NULL COMMENT 'data:PENDING,NEW,HOT,SALE_OFF,REJECTED,EXPIRED',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL COMMENT 'group:LOCATION',
  `state` varchar(100) DEFAULT NULL COMMENT 'group:LOCATION',
  `city` varchar(100) DEFAULT NULL COMMENT 'group:LOCATION',
  `address` varchar(255) DEFAULT NULL COMMENT 'group:LOCATION',
  `view_count` int(11) DEFAULT '0',
  `like_count` int(11) DEFAULT '0',
  `rate` float(3,1) DEFAULT '0.0',
  `rate_count` int(11) DEFAULT '0',
  `reservation_count` int(11) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_user` varchar(100) DEFAULT NULL,
  `application_id` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_deal`
--

INSERT INTO `product_deal` (`id`, `image`, `attachment`, `name`, `description`, `content`, `category_id`, `seller_id`, `quantity`, `price`, `sale_price`, `discount`, `discount_rate`, `discount_type`, `discount_expired`, `is_online`, `online_started`, `online_duration`, `is_premium`, `is_renew`, `status`, `is_active`, `lat`, `long`, `country`, `state`, `city`, `address`, `view_count`, `like_count`, `rate`, `rate_count`, `reservation_count`, `created_date`, `created_user`, `modified_date`, `modified_user`, `application_id`) VALUES
(2, NULL, '1574732275313_product_deal_attachment.jpg', 'Haggar Men\'s Cool 18 Hidden Expandable-Waist Plain-Front Pant', 'cherries::cherries::cherries::cherries:Áo phông , áo nỉ , áo len , áo dài tay Nam - Nữ ', '100% Polyester\r\nImported\r\nMachine Wash\r\nNo iron dress pant with flat front and expandable waist\r\nSide slant pockets and jetted back pockets with button; Professional look\r\nIf your measurements are in between those listed in the size chart, pick the next larger size\r\nHidden Expandable Waistband: Expands up to 3 inches\r\nBreathable\r\n', '19', 1, 9998, 590.00, 0.00, 0.00, 0, '', NULL, 0, '', 0, 1, 0, '', 1, '', '', '', '', '', '', 0, 0, 7.0, 1, 0, NULL, '', '2019-11-27 19:44:58', '', '0'),
(3, '', '1574732131555_product_deal_attachment.jpg', 'FANZHUAN Fashion Pants for Men Slim Fit Casual', ' Cam kết chất lượng và mẫu mã sản phẩm giống với hình ảnh.', '95% Polyester/5% Spandex\r\nOriginal Designed by FANZHUAN - Mens Pants Trousers Fashion Trousers Men Men Slim Fit Trousers Slim Fit Pants Men\r\nEASY CARE - High quality, Wrinkle Free, Machine Wash / Hand Wash Recommended\r\nPANTS DESCRIPTION - Slim fit, high quality fancy printed on the front, solid black at the back. A luxurious garment characterized by simplicity and glamour, adds a touch of elegance to any tops.\r\nMATERIAL - 95% Polyester, 5% Spandex\r\nSIZE RECOMMANDATION - All the FANZHUAN clothes are Asian SLIM FIT size, it is quite DIFFERENT from US size. Our Model 183cm(6\'1\"), 65kg (143lb), and he wears size 31 for your reference. Please CHECK OUR SIZE CHART in below product description before order.\r\n\r\n', '19', 1, 9999, 333.00, 6.72, NULL, 4, 'percent', NULL, 1, '', 0, 1, 0, '', 1, '', '', '', '', '', 's', 0, 0, 0.0, 0, 0, '2019-11-23 04:00:53', '1', '2019-11-27 19:45:11', '', '0'),
(4, '', '1574731901180_product_deal_attachment.jpg', 'LEE Men\'s Performance Series Extreme Comfort Slim Pant', 'Khong co mo ta gi', 'Navy, Black, Gravel, Dove Gray, Taupe: 97% Cotton, 3% Spandex\r\nImported\r\nZip-Fly with button closure closure\r\nMachine Wash\r\nEXTREME COMFORT: These Men\'s Slim Pants feature a slim fit cut close to the body for men who want a modern look. These men\'s slim pants are still insanely comfortable with Active Comfort Fabric with stretch & Athletic Flex Waist that adapts to your body\r\nSTYLISH DESIGNS: Lee\'s full line of men\'s shorts, men\'s jeans, men\'s khakis, men\'s jackets and more provide you with a stylish wardrobe all year round. With cargo shorts for summer hiking trips and denim jackets for windy fall days, Lee keeps you going\r\nMORE THAN DENIM: You already trust Lee to bring you your favorite jeans, but we\'re so much more than that! Lee makes quality, stylish jeans, khakis, dresses, skirts, jackets, belts, shorts, shirts, uniforms and more! Fill your closet with Lee quality\r\n•	Ống: Côn\r\n•	Chất vải: Co giãn tốt, không bay màu, giữ dáng quần không bị bai\r\n•	Sản phẩm quần vải nam công sở cao cấp sử dụng chất liệu vải thun cotton dày dặn ,co giãn nhẹ giúp ôm dáng người mặc ,chất liệu mềm mịn ,thoáng mát thấm hút mồ hôi tốt giúp hoạt động thoải mái trong công việc hàng ngày..\r\n•	Thiết kế chi tiết ,tỉ mỉ từng chi tiết dù là nhỏ. Kiểu dáng slim trẻ trung ,ống đứng xếp li ôm dáng.\r\n•	Có nhiều màu sắc cho bạn lựa chon: đen , xanh đen ,ghi xám, trắng kem.\r\n•	➡️ HƯỚNG DẪN ĐẶT HÀNG:\r\n▶️ Cách chọn size: Shop có bảng size mẫu. Bạn NÊN INBOX, cung cấp chiều cao, cân nặng để SHOP TƯ VẤN SIZE\r\n▶️ Mã sản phẩm đã có trong ảnh hoặc trong bài đăng.\r\n▶️ Cách đặt hàng: Nếu bạn muốn mua 2 sản phẩm khác nhau hoặc 2 size khác nhau, để được freeship\r\n-           Bạn chọn từng sản phẩm rồi thêm vào giỏ hàng\r\n-           Khi giỏ hàng đã có đầy đủ các sản phẩm cần mua, bạn mới tiến hành ấn nút “ Thanh toán”\r\n▶️ Rough luôn hỗ trợ giải đáp thắc mắc sớm nhất của khách hàng.\r\n\r\n➡️ HƯỚNG DẪN CHỌN SIZE\r\n', '19', 1, 9999, 200.00, 150.00, NULL, 2, 'percent', NULL, 1, '1574504387', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-23 04:19:47', '1', '2019-11-27 19:45:54', '', '0'),
(5, '', '1574733077593_product_deal_attachment.jpg', 'ITALY MORN Men\'s Chino Jogger Pants', 'Khong co mo ta gi', '98% Cotton 2%Elastic Soft Stretch Twill\r\nElastic with Drawstring closure\r\nDrop crotch and slightly slim fit chino jogger casual pants; Sizing from XS to XL; fit for everyone; even athletic build; New essential for men; Our model is 6”; 154 Ibs; he wears size Medium; Best gift for youth\r\nElastic waistband with drawstring; 2 side slant pockets; 2 back pockets; elastic ankle cuffs; There is more room for thighs and legs with the dropped crotch and tapered style\r\nDurable material and stylish design blend well into any casual/leisure activity; Work-to weekend; sports; jogging; outdoor activities; exercise or everyday use\r\nBreathable and comfortable high quality stretch twill fabric; Pre-shrunk is done; will not shrink in future use\r\nPlease wash inside out; machine wash cold; Do not bleach; We guarantee that 100% money back if not satisfied', '19', 1, 9996, 150.00, 147.00, NULL, 2, 'percent', NULL, 1, '1574504491', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-23 04:21:31', '1', '2019-11-27 19:46:34', '', '0'),
(6, '', '1574733160364_product_deal_attachment.jpg', 'THE AWOKEN Men\'s Chino Jogger Pants Khaki Stretch Twill Slim Fit Sweatpants', 'Khong co mo ta gi', '98% cotton,2% elastic softy cotton twill\r\nImported\r\nElastic waist with Drawstring closure\r\nDropped crotch style jogger pants is different from regular loose and baggy fit sweatpants. This can fit for regular, big and tall people, even athletic build should fit fine. Our model is 6”,154Ibs,he wears size Medium\r\nElastic waistband with adjustable drawstring, two side slant pockets, two back pockets, open hem cuffs. Low crotch area , tapered in the legs; slightly slim/skinny\r\nFor Outdoor Sports Running Jogging Training Workout Hip Hop Dance and Normal DayAs a easygoing wear, you can wear joggers for pretty much every purpose, likely casual/leisure activity; Work-to weekend; sports; outdoor activities; exercise or everyday use.You can paired them with a stylish shirts/t-shirts,sweaters,hoodies, sneakers,trainers.\r\nSize from S to XL, you can see our size chart to choose your fitting. Soft and comfortable twill stretch fabric, midweight material perfect in Spring, Summer, Autumn and Winter all year round. Pre-washed, will not shrink\r\nPlease wash inside out; machine wash cold; Do not bleach. We guarantee that 100% money back if not satisfy', '19', 1, 10000, 444.00, 343.00, NULL, 2, 'percent', NULL, 1, '1574504517', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-23 04:21:57', '1', '2019-11-27 19:47:37', '', '0'),
(7, '', '157473321690_product_deal_attachment.jpg', 'KDNK Men\'s Tapered Skinny Fit Stretch Twill Cotton Drawstring Ankle Zip Pants', 'Khong co mo ta gi', 'Stretch Twill: 98% Cotton 2% Spandex\r\nCONSTRUCTION: 98% Cotton, 2% Spandex. Made out of comfortable stretch twill, our Ankle Zip Pants are perfect to wear all day.\r\nSTYLE: These pants feature an elastic waistband with fashionable ankle zipper. Stand out from the crowd and leave them unzipped or rolled up for casual occasions. Or zip them down for a sleek tapered look.\r\nFIT: Tapered Skinny - Please see the size chart for measurements of the Waist, Thigh, Knee, Inseam, and, Leg Opening.\r\nFEATURES: Our pants have an extra long cotton drawstring as well as a functional ankle zipper which allows you to put on or take off the pants without removing your shoes, making these jeans great for casual wear or perfect to throw on after hitting the gym!\r\nAVAILABLE COLORS: Black, Grey, Khaki, Red, and Timber. Find your style or match your pants to your personality.\r\n', '19', 1, 10000, 4356.00, 2445.00, NULL, 2, 'percent', NULL, 1, '1574504538', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-23 04:22:18', '1', '2019-11-27 19:48:13', '', '0'),
(8, '', '1574733283246_product_deal_attachment.jpg', 'Longe Mens American USA Flag Printed Washed Jeans White Fit Trousers Pants', 'Khong co mo ta gi', 'Styling and Zipper & Button Closure, slim fit skinny jeans Super comfy,excellent stretchy, stretch skinny jeans made of excellent polyester fabric that holds it shape throughout the day, Let you have no restriction and feeling comfort.\r\nFine workmanship, this elastic mens jeans features solid stitching, Confident Look, our skinny jeans with with knee to ankle tight fit design gives you a confident and fashion look.\r\nMade for fashionable Men, Juniors and teenager who will be more charming with our flattering jeans in the workplace & leisure place, colorful skinny jeans with elegant fashion element make you looks younger and more handsome.\r\nDenim Care: Machine wash cold, turn the jeans inside out and wash seperately with like colors. Do not bleach, gentle cycle, flat or line dry only.\r\n100% SATISFACTION GUARANTEE: We\'ve got you covered! comfortably constructed & backed by a 30 day ‘love it or your money back guarantee. Either you LOVE the product or you are entitled to a full refund', '19', 1, 10000, 450.00, 221.00, NULL, 2, 'percent', NULL, 0, '1574504574', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-23 04:22:54', '1', '2019-11-27 19:49:29', '', '0'),
(9, '', '1574734388attachment.jpg', 'QIYUN.Z Women\'s Winter Lantern Sleeve Knit Cardigans Korean Style Sweater Coat', 'Khong co mo ta gi', 'Our store is a professional company which is focus on clothing, accessory and fashion jewelry.\r\nYou can check our store for a full range of appear accessory and jewelry.Thank you.\r\nPlease allow 1-3cm measure error due to manual measurement\r\n\r\nNOTE:Please check the size measurement information carefully before you purchase.', '10', 5, 9973, 322.00, 123.00, NULL, 2, 'percent', NULL, 1, '1574734388', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 10.0, 2, 0, '2019-11-25 20:13:08', '5', '2019-11-27 19:51:18', '', '0'),
(10, '', '1574734433attachment.png', 'HZSONNE Women\'s Lantern Sleeve Open Front Side Pocket Shawl Collar Chunky Knit Blouses Lightweight Cardigan Sweater', 'Khong co mo ta gi', 'Care instructions:\r\n\r\n1. Sweater washing to use neutral detergent, can not use detergent, for fiber fabric, its alkaline is too strong, and the fiber is not alkali.\r\n\r\n2. Washing sweater, can not force rubbing, twisting twist, so as not to cause sweater deformation; only gently rubbing.\r\n\r\n3. If the sweater dyeing fastness is good, can be washed with warm water.\r\n\r\n4. Drying sweater, you should first hang with a few hangers or net bag sweater hanging up and control dry water until its semi-dry, and then Dry in the shade, so as not to deformation; sweater is best not to exposure in the sun.\r\n\r\n5. WASH INSTRUCTION: Hand Wash Recommended ; Lay Flat Dry .\r\n\r\n* Due to various types of computers and monitors, the actual color of the item may be little different from the picture.\r\n\r\n* If you aren\'t satisfied with the item,please contact us before you leave the feedback,thank you for your understanding.\r\n\r\n* Manual measurement may exist 1-3cm difference.Please check and compare the size carefully before buying~(1cm=0.39inch)', '10', 5, 9996, 139.00, 100.00, NULL, 2, 'percent', NULL, 1, '1574734433', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-25 20:13:53', '5', '2019-11-27 19:52:23', '', '0'),
(11, '', '1574734459attachment.jpg', 'Packitcute Autumn Women\'s Korean Cute Long Sleeve Loose False Two-Piece Sweatshirts', 'Khong co mo ta gi', 'Product description\r\nKorean Style Streetwear Soft Sweatshirt Spring Autumn Cool Casual Pullover Sweatshirt Drawstring Chic Black Sweatshirt for Women\r\n\r\nMaterial: Cotton\r\n\r\nColor: Black, White\r\n\r\nGender: Women, Teens\r\n\r\nSeason: Spring, Autumn and Winter\r\n\r\nSize (inch): bust 41.73\", sleeve 18.11\", shoulder 20.86\", length 25.59\"\r\n\r\n\r\nOther notes:\r\n\r\n1.This is the size of Asia, it will be smaller than the size you usually wear, please check the size table before ordering.\r\n\r\n2.The real color of the sweatshirt may be slightly different from the pictures shown on website caused by many factors such as brightness of your monitor and light brightness.\r\n\r\n3.Please allow 0.78~1.57 inch difference due to manual measurement. There maybe little deviation in different sizes, locations and stretch of fabrics. Size table is for reference only, there may be a little difference with what you get.\r\n\r\n4.This listing is for 1 Sweatshirt only, other accessories are not included. Our store offers more style, which is worth seeing.', '10', 5, 9995, 434.00, 412.00, NULL, 2, 'percent', NULL, 1, '1574734459', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 10.0, 1, 0, '2019-11-25 20:14:19', '5', '2019-11-27 19:53:18', '', '0'),
(12, '', '1574734482attachment.jpg', 'WDIRARA Women\'s Casual Long Sleeve Plaid Cold Shoulder Pullover Sweatshirt', 'Khong co mo ta gi', 'S - Shoulder: 18\'\', Bust: 39\'\', Sleeve Length: 24\'\', Length: 19\'\'\r\n\r\nM - Shoulder: 19\'\', Bust: 41\'\', Sleeve Length: 24\'\', Length: 19\'\'\r\n\r\nL - Shoulder: 19\'\', Bust: 42\'\', Sleeve Length: 24\'\', Length: 19\'\'\r\n\r\nXL - Shoulder: 19\'\', Bust: 44\'\', Sleeve Length: 25\'\', Length: 20\'\'', '10', 5, 9998, 150.00, 147.00, NULL, 2, 'percent', NULL, 1, '1574734482', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-25 20:14:42', '5', '2019-11-27 19:54:02', '', '0'),
(13, '', '1574734513attachment.jpg', 'HaoKe Women Girls Japanese Kawaii Strawberry Milk Box Graphic T-Shirt Fairy Kei Short Sleeve Pink Gift', 'Khong co mo ta gi', 'Buy with confidence! \r\nSize M: bust: 96 cm/37.8\", length: 60 cm/23.62\", \r\nshoulder: 46 cm/18.11\" Size L: bust: 100 cm/39.37\", length: 62 cm/24.4\", \r\nshoulder: 47 cm/18.5\" Size XL: bust: 104 cm/40.94\", length: 64 cm/24.8\", \r\nshoulder: 48 cm/18.9\" Size XXL: bust: 108 cm/42.52\", length: 66 cm/25.2\", \r\nshoulder: 49 cm/19.3\" Material: 31-50% cotton', '10', 5, 9997, 150.00, 147.00, NULL, 2, 'percent', NULL, 1, '1574734513', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-25 20:15:13', '5', '2019-11-27 19:55:29', '', '0'),
(14, '', '1574734539attachment.jfif', 'Womens Sweatshirts, Stripe Long Sleeve Fashion Casual Cute Sweatshirts Pullover', 'Khong co mo ta gi', 'Cotton, Polyester\r\nImported\r\nKorean style chic sweatshirt hoodie loose streetwear crewneck sweatshirt women juniors sweatshirts\r\nThis cold shoulder sweatshirt for women and teens, which is suitable for wearing in spring or autumn\r\nPlease note the size (inch): shoulder 21.26\", sleeve 18.9\", chest 43.3\", length 27.56\"\r\nThis green sweatshirt is made of cotton and polyester, please hand wash or machine wash with cold water, do not bleach, do not iron at high temperature.\r\nThis listing is for 1 Sweatshirt only, other accessories are not included. If you find a quality problem after receiving it, please feel free to contact us, we will deal with it at the first time', '10', 5, 9996, 150.00, 147.00, NULL, 2, 'percent', NULL, 1, '1574734539', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 10.0, 1, 0, '2019-11-25 20:15:39', '5', '2019-11-27 19:56:04', '', '0'),
(15, '', '1576146410attachment.jpg', 'GK-O Mori Girl Cute Fashion False Two-Piece Printed Stitching Fleece Pullover Sweatshirt', 'Khong co mo ta gi', '♥Contents:1 pcs Sweatshirt\r\n♥One Size: Length 28.74inch Bust 40.15inch Sleeve 23.22inch Shoulder 16.14inch\r\n♥Item condition: 100% Brand new. The owner of \"T shop Japan\" shop is a native Japanese, and our products are stored in Amazon Official Warehouses in USA, so you will get our products as soon as possible after you buy.\r\n♥Exclusively sold by T Shop Japan', '19', 10, 10000, 15000.00, 15000.00, NULL, 0, 'percent', NULL, 1, '1574734655', 1, NULL, NULL, '', 1, '', '', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 0.0, 0, 0, '2019-11-25 20:17:35', '5', '2019-12-12 04:26:50', '10', '0'),
(16, '', '1574734721attachment.jpg', 'GK-O Japanese Mori Girl Lolita Retro Patchwork Embroidery Cotton Loose Dress', 'Khong co mo ta gi', 'Contents:1 pcs Dress\r\n♥One Size: Length 35.43inch Bust 38.58inch Shoulder 15.35inch Model Height 63inch Weight 108ib\r\n♥Item condition: 100% Brand new. The owner of \"T shop Japan\" shop is a native Japanese, and our products are stored in Amazon Official Warehouses in USA, so you will get our products as soon as possible after you buy.\r\n♥Exclusively sold by T Shop Japan', '10', 5, 9999, 150.00, 147.00, NULL, 2, 'percent', NULL, 1, '1574734721', 1, 1, 0, '', 1, '21.0277644', '105.8341598', '', '', '', 'Quận Thanh Xuân, Hà Nội', 0, 0, 10.0, 1, 0, '2019-11-25 20:18:41', '5', '2019-11-27 19:57:35', '', '0'),
(22, '', '1576489162219_product_deal_attachment.jpg', 'Hibluco Women\'s Sexy Cold Shoulder Blouses Lace-up Ribbed Tops Casual T-Shirts', 'hfhhd', 'Material: Polyester and Spandex\r\nFeatures: splicing,lace up,off shoulder\r\nSuit for Going out,daily wear,party.\r\nIf you do not feel comfortable,please contact Amazon for a refund.\r\nSearch \"Hibluco\" on amazon for more of our products.\r\nDetails of the Blouse\r\nRibbed design, solid color, cold shoulder.\r\n\r\nThe fabrics are soft and comfortable.\r\nSexy Long Sleeve Cold Shoulder Top\r\nCriss cross hollow design.\r\n\r\nThe lace is elastic but has no function.\r\nI am pretty sure this just became my favorite shirt, but we\'ll see how it holds up, lol\r\n\r\nIt seems to be well-made, and the fabric feels very nice. It\'s kind of like a thin, ribbed sweater.\r\n\r\nI am 5\'10\", 200lbs and usually wear an XL in most tops. This one runs a tiny bit small, but it\'s not too bad if you\'re into a more slim fit, like I am. I\'m surprised by how sexy I feel in this top!\r\n\r\nAll-in-all, I like this top a lot and I think I\'ll buy another color.', '10', 15, 65, 65.00, 22.75, NULL, 65, 'percent', NULL, 0, '', 0, 0, 0, '', 1, '', '', '', '', '', 'hfjfhf', 0, 0, 0.0, 0, 0, '2019-12-16 03:29:57', '15', '2019-12-16 03:39:22', '', '0'),
(23, '', '1576488599attachment.jpg', 'Halife Women\'s Long Sleeve/Short Sleeve Boat Neck Off Shoulder Blouse Tops', 'hfhhd', ' Stretchy and Soft Material: cotton blended fabric t shirt, lightweight, soft, stretchy, comfy and easy to wear. Please Note It\'s a T-shirt, Not Sweater or Sweatshirt.\r\n♥ Trendy Design Tops: wide boat neck design with stretchy fabric, you can wear it as a both off the shoulders top or choose one shoulder to let it hang off.\r\n♥ Solid Color T-shirt: loose fitting off the shoulder t shirts, always in style solid color, can\'t be more amazing when pairing with a long necklace with it! You can also put various types of pattern on it as you want.\r\n♥ Great for casual, daily, going out, holiday, walk down the street, party, club wear in any seasons, perfect to pair with jeans, leggings, shorts, skirts, etc.\r\n♥ About Sizes: This off the shoulder top is loose style, and it\'s standard US Size, if you want a more fitted style, please choose one size down; if you just need a little loose fit like the pictures show, please choose you normal size; if you need a very loose style, please choose one size up, but then please note the band of the bottom maybe loose too. Please refer to the size chart in the product description if you need more information about the sizes.\r\nHalife Women\'s Long Sleeve/Short Sleeve Boat Neck Off Shoulder Blouse Tops\r\n\r\nPlease Note it is the T Shirt Material,Not the Sweater or Sweatshirt Material.\r\n\r\nFabric has generous amount of stretch, lightweight, soft and comfortable to wear.\r\n\r\nLong Sleeve / Short Sleeve Boat Neck Off the Shoulder Tops, casual and trendy style.\r\n\r\nEasy to pair with leggings, jeans, capris, shorts, skirts etc, perfect for daily, casual, work, dating or vacation wear.\r\n\r\nGreat for wearing in spring, summer, fall, winter, you can\'t miss it in your stylish wardrobe.\r\nSize Chart:\r\n\r\nS----Chest: 37.8 inch----Length: 26.7 inch\r\n\r\nM----Chest: 40.1 inch----Length: 27.1 inch\r\n\r\nL----Chest: 43.3 inch----Length: 27.5 inch\r\n\r\nXL----Chest: 46.4 inch----Length: 27.9 inch\r\n\r\nPlease allow 1 inch difference due to manual measurement\r\n\r\nPlease choose your normal size or refer to the size chart here before ordering\r\nWomens Off the Shoulder Tops Loose fit T-shirts\r\nMade of soft, stretchy and lightweight fabric,\r\n\r\nbreathable and comfortable to wear.\r\n\r\nThis off the shoulder top is such a cute top!\r\n\r\nIt’s so comfy and chic, you can\'t miss it!\r\n\r\nAs different computers display colors differently,\r\n\r\nthe color of the actual item may vary slightly from the images,\r\n\r\nthanks for your understanding.', '10', 15, 63, 65.00, 22.75, NULL, 65, 'percent', NULL, 0, '', 0, 0, 0, '', 1, '', '', '', '', '', 'Viet Nam', 0, 0, 0.0, 0, 0, '2019-12-16 03:29:59', '15', '2019-12-16 03:35:57', '', '0'),
(24, '', '1576488662attachment.jpg', 'Topstype Women\'s Color Block Chest Cutout Tunics Long Sleeve Shirts Scoop Neck Blouse Casual Loose Tops', 'jfjr', '30% polyester\r\nHand Wash Cold\r\nMaterial: 70% Cotton, 30% Polyester.\r\nThe fabrication is luxurious and great quality, very comfortable, and easy to be worn.\r\nFeatures: Long sleeve tunic, Chest cutout, Circle neckline, Soft, Stretchy, Relaxed fit.\r\nOccasion: Good for party, club, daily life, office, home, etc. Struggling to find the perfect date night tee? This is it!\r\nHand wash cold with like colors, lay flat to dry, do not bleach, cool iron if needed.', '10', 15, 61, 33.00, 32.01, NULL, 3, 'percent', NULL, 0, '', 0, 0, 0, '', 1, '', '', '', '', '', 'Viet Nam', 0, 0, 0.0, 0, 0, '2019-12-16 03:31:02', '15', '2019-12-16 03:34:18', '', '0'),
(25, '', '1576489226attachment.jpg', ' Chaps Women\'s Long Sleeve Non Iron Broadcloth-Shirt', 'vvb', '100% Cotton\r\nImported\r\nButton closure\r\nMachine Wash\r\n100 percent cotton\r\nButton front\r\nShirttail hem\r\nSolid no iron shirt', '14', 15, 3, 66.00, 62.04, NULL, 6, 'percent', NULL, 0, '', 0, 0, 0, '', 1, '', '', '', '', '', 'hjh', 0, 0, 0.0, 0, 0, '2019-12-16 03:40:26', '15', '2019-12-16 03:41:38', '', '0'),
(26, '', '1576747682attachment.jpg', 'Hot', 'ok', 'very good', '10', 1, 96, 10.00, 10.00, NULL, 0, 'percent', NULL, 0, NULL, 0, NULL, NULL, NULL, 0, '', '', NULL, NULL, NULL, 'ha noi', 0, 0, 0.0, 0, 0, '2019-12-19 03:28:02', '1', '2019-12-19 03:28:02', NULL, '0'),
(27, '', '1576747778attachment.jpg', 'Hot', 'ok', 'very good', '10', 1, 13, 15.00, 15.00, NULL, 0, 'percent', NULL, 0, NULL, 0, NULL, NULL, NULL, 0, '', '', NULL, NULL, NULL, 'ha noi', 0, 0, 0.0, 0, 0, '2019-12-19 03:29:38', '1', '2019-12-19 03:29:38', NULL, '0'),
(28, '', '1576747789attachment.jpg', 'Hot', 'ok', 'very good', '10', 1, 13, 15.00, 15.00, NULL, 0, 'percent', NULL, 0, NULL, 0, NULL, NULL, NULL, 0, '', '', NULL, NULL, NULL, 'ha noi', 0, 0, 0.0, 0, 0, '2019-12-19 03:29:49', '1', '2019-12-19 03:29:49', NULL, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_deal_image`
--

CREATE TABLE `product_deal_image` (
  `id` int(11) NOT NULL,
  `product_deal_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_deal_image`
--

INSERT INTO `product_deal_image` (`id`, `product_deal_id`, `image`, `created_at`, `modified_at`) VALUES
(19, 3, '1574503254_product_deal_image.jpg', '2019-11-23 04:00:53', NULL),
(20, 3, '1574503255_product_deal_image.jpg', '2019-11-23 04:00:53', NULL),
(21, 3, '1574503256_product_deal_image.jpg', '2019-11-23 04:00:53', NULL),
(22, 3, '1574503257_product_deal_image.jpg', '2019-11-23 04:00:53', NULL),
(23, 4, '1574504388_product_deal_image.jpeg', '2019-11-23 04:19:47', NULL),
(24, 4, '1574504389_product_deal_image.png', '2019-11-23 04:19:47', NULL),
(25, 5, '1574504492_product_deal_image.jpg', '2019-11-23 04:21:31', NULL),
(26, 5, '1574504493_product_deal_image.jpg', '2019-11-23 04:21:31', NULL),
(27, 5, '1574504494_product_deal_image.jpg', '2019-11-23 04:21:31', NULL),
(28, 6, '1574504518_product_deal_image.jpg', '2019-11-23 04:21:57', NULL),
(29, 6, '1574504519_product_deal_image.jpg', '2019-11-23 04:21:57', NULL),
(30, 6, '1574504520_product_deal_image.jpg', '2019-11-23 04:21:57', NULL),
(31, 7, '1574504539_product_deal_image.jpg', '2019-11-23 04:22:18', NULL),
(32, 7, '1574504540_product_deal_image.jpg', '2019-11-23 04:22:18', NULL),
(33, 7, '1574504541_product_deal_image.jpg', '2019-11-23 04:22:18', NULL),
(34, 8, '1574504575_product_deal_image.png', '2019-11-23 04:22:54', NULL),
(35, 8, '1574504576_product_deal_image.jpg', '2019-11-23 04:22:54', NULL),
(36, 8, '1574504577_product_deal_image.jpg', '2019-11-23 04:22:54', NULL),
(37, 9, '1574734389_product_deal_image.jpg', '2019-11-25 20:13:08', NULL),
(38, 9, '1574734390_product_deal_image.png', '2019-11-25 20:13:08', NULL),
(39, 9, '1574734391_product_deal_image.jpg', '2019-11-25 20:13:08', NULL),
(40, 10, '1574734434_product_deal_image.jpg', '2019-11-25 20:13:53', NULL),
(41, 10, '1574734435_product_deal_image.jpg', '2019-11-25 20:13:53', NULL),
(42, 10, '1574734436_product_deal_image.png', '2019-11-25 20:13:53', NULL),
(43, 11, '1574734460_product_deal_image.jpg', '2019-11-25 20:14:19', NULL),
(44, 11, '1574734461_product_deal_image.jpg', '2019-11-25 20:14:19', NULL),
(45, 11, '1574734462_product_deal_image.jpg', '2019-11-25 20:14:19', NULL),
(46, 12, '1574734483_product_deal_image.jpg', '2019-11-25 20:14:42', NULL),
(47, 12, '1574734484_product_deal_image.jpg', '2019-11-25 20:14:42', NULL),
(48, 12, '1574734485_product_deal_image.jpg', '2019-11-25 20:14:42', NULL),
(49, 13, '1574734514_product_deal_image.jpg', '2019-11-25 20:15:13', NULL),
(50, 13, '1574734515_product_deal_image.jfif', '2019-11-25 20:15:13', NULL),
(51, 13, '1574734516_product_deal_image.jpg', '2019-11-25 20:15:13', NULL),
(52, 14, '1574734540_product_deal_image.jfif', '2019-11-25 20:15:39', NULL),
(53, 14, '1574734541_product_deal_image.jpg', '2019-11-25 20:15:39', NULL),
(54, 14, '1574734542_product_deal_image.jpg', '2019-11-25 20:15:39', NULL),
(55, 15, '1574734656_product_deal_image.jpg', '2019-11-25 20:17:35', NULL),
(56, 15, '1574734657_product_deal_image.jpg', '2019-11-25 20:17:35', NULL),
(57, 15, '1574734658_product_deal_image.jpg', '2019-11-25 20:17:35', NULL),
(58, 16, '1574734722_product_deal_image.jpg', '2019-11-25 20:18:41', NULL),
(59, 16, '1574734723_product_deal_image.png', '2019-11-25 20:18:41', NULL),
(60, 16, '1574734724_product_deal_image.jpg', '2019-11-25 20:18:41', NULL),
(61, 17, '1574823497_product_deal_image.jpg', '2019-11-26 20:58:16', NULL),
(62, 17, '1574823498_product_deal_image.jpg', '2019-11-26 20:58:16', NULL),
(63, 17, '1574823499_product_deal_image.jpg', '2019-11-26 20:58:16', NULL),
(64, 17, '1574823500_product_deal_image.jpg', '2019-11-26 20:58:16', NULL),
(89, 15, '1576145293_product_deal_image.jpg', '2019-12-12 04:08:09', NULL),
(90, 15, '1576146414_product_deal_image.jpg', '2019-12-12 04:26:50', NULL),
(91, 22, '1576488598_product_deal_image.jpg', '2019-12-16 03:29:57', NULL),
(92, 22, '1576488599_product_deal_image.jpg', '2019-12-16 03:29:57', NULL),
(93, 22, '1576488600_product_deal_image.jpg', '2019-12-16 03:29:57', NULL),
(94, 23, '1576488600_product_deal_image.jpg', '2019-12-16 03:29:59', NULL),
(95, 23, '1576488601_product_deal_image.jpg', '2019-12-16 03:29:59', NULL),
(96, 23, '1576488602_product_deal_image.jpg', '2019-12-16 03:29:59', NULL),
(97, 24, '1576488663_product_deal_image.jpg', '2019-12-16 03:31:02', NULL),
(98, 25, '1576489227_product_deal_image.jpg', '2019-12-16 03:40:26', NULL),
(99, 26, '1576747683_product_deal_image.jpg', '2019-12-19 03:28:02', NULL),
(100, 26, '1576747684_product_deal_image.jpg', '2019-12-19 03:28:02', NULL),
(101, 27, '1576747779_product_deal_image.jpg', '2019-12-19 03:29:38', NULL),
(102, 27, '1576747780_product_deal_image.jpeg', '2019-12-19 03:29:38', NULL),
(103, 28, '1576747790_product_deal_image.jpg', '2019-12-19 03:29:49', NULL),
(104, 28, '1576747791_product_deal_image.jpeg', '2019-12-19 03:29:49', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `metaKey` varchar(255) DEFAULT NULL,
  `metaValue` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `metaKey`, `metaValue`) VALUES
(1, 'ADMIN_EMAIL', 'admin-email@gmail.com'),
(2, 'GOOGLE_API_KEY', 'AIzaSyDvZTRyP5BicNaOfesyleWxdEhwC_ANcyk'),
(3, 'PEM_FILE', '1488869720.pem'),
(4, 'COMPANY_NAME', 'PT'),
(5, 'COMPANY_DESCRIPTION', 'App & Template'),
(6, 'COMPANY_HOMEPAGE', 'suusoft.com'),
(7, 'EXCHANGE_RATE', '1'),
(8, 'DEAL_ONLINE_RATE', '0'),
(9, 'PREMIUM_DEAL_ONLINE_RATE', '0'),
(10, 'DRIVER_ONLINE_RATE', '2'),
(11, 'SEARCHING_DEAL_DISTANCE', '100'),
(12, 'SEARCHING_DRIVER_DISTANCE', '500'),
(13, 'EXCHANGE_FEE', '0'),
(14, 'TRANSFER_FEE', '0'),
(15, 'REDEEM_FEE', '10'),
(16, 'TRIP_PAYMENT_FEE', '0'),
(17, 'DEAL_PAYMENT_FEE', '0'),
(18, 'PAGE_FAQ', '<p>Will update soon...stay tuned!</p>\r\n'),
(19, 'PAGE_ABOUT', '<p><span style=\"font-size:22px\"><span style=\"font-family:arial,helvetica,sans-serif\">Welcome to Magic</span></span></p>\r\n\r\n<h4 style=\"text-align:center\">&nbsp;</h4>\r\n\r\n<h4><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">We believe technology 4.0 has changed the climate of the world economy, as well as online and offline shopping. Customers not only want quality products but they also want more rewards, discounts and more friendly and professional services.</span></span></h4>\r\n\r\n<h4><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">.</span></span></h4>\r\n\r\n<h4><span style=\"font-size:16px\"><span style=\"font-family:arial,helvetica,sans-serif\">Our Team will help you market your products and services, Online shop, chat, email marketing and push notifications to attract prospects and customers to your premises.</span></span></h4>\r\n\r\n<h4><span style=\"font-size:16px\">Through our magicPAY payment system we are very concerned about the safety of our customers and customers, each customer will make a payment first through magicPay and you as a dealer can redeem the payment from magicPAY automatically by bank transfer.</span></h4>\r\n\r\n<h4><span style=\"font-size:16px\">The magic party will charge a service charge for every transaction made by the all our member at the store. The 10 to 15% service charge will be distributed to all members according to the magicshoppe marketing plan.</span></h4>\r\n'),
(20, 'PAGE_HELP', '<h1 style=\"text-align:center\">Stay tune will update soon</h1>\r\n\r\n<h4 style=\"text-align:center\">&nbsp;</h4>\r\n'),
(21, 'PAGE_TERM', '<h1 style=\"text-align:center\">&nbsp;</h1>\r\n\r\n<div id=\"Content\" style=\"margin: 0px; padding: 0px; position: relative; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: center;\">\r\n<div class=\"boxed\" style=\"margin: 10px 28.7969px; padding: 0px; clear: both;\">\r\n<div id=\"lipsum\" style=\"margin: 0px; padding: 0px; text-align: justify;\">\r\n<p>Lorem Ipsum Dolor Sit Amet, Eletet Adipiscing Elit. Phasellus accumsan sapien ut dolor blandit, vitae volutpat speechus eestas. Duis Interdum Tortor Eget Ultrices. Ееееее ее е е е е е е е е е е е е е е е е е е Nam placerat molestie diam eu placerat. Vestibulum ac Libero metus. Proin eget congue eros. Ante kh&ocirc;ng sollicitudin. Ut carula coectetur turpis, id Pretium augue viverra id. Curabitur Elementum metus sed nibh malesuada, dapibus molestie metus aliquam. Morbi eleifend quis turpis posuere finibus. Nullam aliquam nisl et sollicitudin porta. L&agrave;m thế n&agrave;o để l&agrave;m g&igrave; đ&oacute; tốt hơn. Ut Scelerisque Tristique Mauris в malesuada. Tiếng Ph&aacute;p.</p>\r\n</div>\r\n</div>\r\n</div>\r\n'),
(22, 'key_push', 'AIzaSyBwDTuAGar7wfcSFJ09MPq18fy62J2SYeM'),
(23, 'SEARCHING_PRODUCT_DISTANCE', '10'),
(24, 'INVITE_BONUS_POINT', '20000'),
(25, 'COMMISSION_RATE', '10'),
(26, 'IMAGE_BANNER_1', '1575426986316_image_banner_1.png'),
(27, 'IMAGE_BANNER_2', '1575426986951_image_banner_2.png'),
(28, 'IMAGE_BANNER_3', '1575427817475_image_banner_3.png'),
(29, 'IMAGE_BANNER_4', '1575426986339_image_banner_4.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL COMMENT 'nguoi sub',
  `subscribed_id` int(11) NOT NULL COMMENT 'nguoi duoc sub - seller_id',
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `subscribe`
--

INSERT INTO `subscribe` (`id`, `subscriber_id`, `subscribed_id`, `created_at`, `modified_at`) VALUES
(22, 644, 643, '2019-08-24 04:25:17', NULL),
(23, 1, 2, '2019-08-24 04:41:35', NULL),
(26, 653, 643, '2019-08-24 05:43:26', NULL),
(27, 639, 650, '2019-08-24 08:32:59', NULL),
(28, 650, 639, '2019-08-24 09:15:21', NULL),
(29, 639, 639, '2019-08-25 06:52:44', NULL),
(30, 664, 643, '2019-08-27 04:10:38', NULL),
(31, 638, 650, '2019-08-28 21:51:00', NULL),
(32, 643, 675, '2019-08-31 05:39:12', NULL),
(33, 675, 674, '2019-08-31 06:18:29', NULL),
(34, 637, 676, '2019-09-04 06:31:48', NULL),
(35, 699, 698, '2019-09-05 10:12:54', NULL),
(36, 676, 701, '2019-09-05 23:29:38', NULL),
(37, 701, 676, '2019-09-06 06:16:13', NULL),
(38, 676, 704, '2019-09-06 09:24:52', NULL),
(46, 710, 650, '2019-11-10 22:29:20', NULL),
(47, 2, 1, '2019-11-14 22:31:58', NULL),
(49, 6, 1, '2019-11-17 22:06:40', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overview` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(2) DEFAULT NULL COMMENT 'data:10:USER,20:MODERATOR,30:ADMIN',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT 'data:DISABLED=0,ACTIVE=10',
  `application_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `image`, `overview`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `application_id`, `created_at`, `updated_at`) VALUES
(6, 'admin', 'user6_image.png', NULL, 'WmzV9waECMlzP_EhXKd4PLw-_sGeMz12', '$2y$13$s5yLryk16awaMfDWpiQy7OZbs/ueqFKNE7DG5UA6yDbmrGwfL8I7i', 'Nph5RP9UXI9F0I0jITJqUnzxnhobKs2S_1473239211', 'hung.hoxuan@gmail.com', 30, 10, 'education', 1473239211, 1546932233),
(7, 'admin1', NULL, NULL, 'LeNs3kDGz0UUG7PCNaGjUQS5BuVAro5x', '$2y$13$eRUdaVtOwjprWTYVZ/7gG.z6upakOkIfvQDKc6dOg5H1z4SGgHc1m', NULL, 'admin1@gmail.com', 10, 10, NULL, 1560221021, 1560221021),
(8, 'admin2', NULL, NULL, 'ezBvhnKnQoZ3zO2x7DKAKb1r_Z67oLYY', '$2y$13$GBH/CA5XV14wt7nKD4qhEeSdUiD62AuYVsc6V5vE6mM87RioqQkZ.', NULL, 'admin2@gmail.com', 10, 10, NULL, 1560222150, 1560222150);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_device`
--
ALTER TABLE `app_user_device`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_favourite`
--
ALTER TABLE `app_user_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_invite_code`
--
ALTER TABLE `app_user_invite_code`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_pro`
--
ALTER TABLE `app_user_pro`
  ADD UNIQUE KEY `user_id_unique` (`user_id`);

--
-- Chỉ mục cho bảng `app_user_refund_request`
--
ALTER TABLE `app_user_refund_request`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_report_image`
--
ALTER TABLE `app_user_report_image`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_report_request`
--
ALTER TABLE `app_user_report_request`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_review`
--
ALTER TABLE `app_user_review`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_token`
--
ALTER TABLE `app_user_token`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_transaction`
--
ALTER TABLE `app_user_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_user_transaction_request`
--
ALTER TABLE `app_user_transaction_request`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_sub`
--
ALTER TABLE `category_sub`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Chỉ mục cho bảng `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `object_category`
--
ALTER TABLE `object_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `object_relation`
--
ALTER TABLE `object_relation`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_deal`
--
ALTER TABLE `product_deal`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_deal_image`
--
ALTER TABLE `product_deal_image`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `app_user_device`
--
ALTER TABLE `app_user_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `app_user_favourite`
--
ALTER TABLE `app_user_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `app_user_invite_code`
--
ALTER TABLE `app_user_invite_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `app_user_refund_request`
--
ALTER TABLE `app_user_refund_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `app_user_report_image`
--
ALTER TABLE `app_user_report_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `app_user_report_request`
--
ALTER TABLE `app_user_report_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `app_user_review`
--
ALTER TABLE `app_user_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `app_user_token`
--
ALTER TABLE `app_user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `app_user_transaction`
--
ALTER TABLE `app_user_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `app_user_transaction_request`
--
ALTER TABLE `app_user_transaction_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `category_sub`
--
ALTER TABLE `category_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `object_category`
--
ALTER TABLE `object_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT cho bảng `object_relation`
--
ALTER TABLE `object_relation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT cho bảng `product_deal`
--
ALTER TABLE `product_deal`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `product_deal_image`
--
ALTER TABLE `product_deal_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
