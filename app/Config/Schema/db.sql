-- phpMyAdmin SQL Dump
-- version wadax
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2015 at 08:58 午前
-- Server version: 5.1.73-log
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ot-work-jp01`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'お名前',
  `furigana` varchar(100) NOT NULL COMMENT 'ふりがな',
  `gender` varchar(20) NOT NULL COMMENT '性別',
  `date_of_birth` date NOT NULL COMMENT '生年月日',
  `postalcode` varchar(20) NOT NULL COMMENT '郵便番号',
  `prefecture_id` int(11) NOT NULL COMMENT '都道府県',
  `address` varchar(255) NOT NULL COMMENT '住所',
  `tel` varchar(100) NOT NULL COMMENT '携帯電話',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `contact_time` varchar(255) NOT NULL COMMENT '連絡時間帯',
  `year_of_experience` varchar(255) NOT NULL COMMENT 'ご経験年数',
  `desired_joining_time` varchar(255) NOT NULL COMMENT '入職希望',
  `employment_pattern` varchar(255) NOT NULL COMMENT '就業形態',
  `employment_status` varchar(255) NOT NULL COMMENT '就業状況',
  `desired_location_first_id` int(11) NOT NULL COMMENT '希望勤務地１',
  `desired_location_second_id` int(11) NOT NULL COMMENT '希望勤務地１',
  `qualification_year` varchar(255) NOT NULL COMMENT '資格取得年',
  `remarks` text NOT NULL COMMENT '備考',
  `work_type_id` int(4) NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `note_count` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gender` (`gender`,`prefecture_id`,`work_type_id`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100180 ;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(2) NOT NULL,
  `area_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='マスター　エリアデータ';

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE IF NOT EXISTS `businesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '事業所名',
  `sort_no` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sort_no` (`sort_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `cake_sessions`
--

CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `desired_jobs`
--

CREATE TABLE IF NOT EXISTS `desired_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL COMMENT '求職者ID',
  `business_id` int(11) NOT NULL COMMENT '事業所ID',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `applicant_id` (`applicant_id`,`business_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=836 ;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE IF NOT EXISTS `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `gengo`
--

CREATE TABLE IF NOT EXISTS `gengo` (
  `serial` varchar(100) NOT NULL,
  `お名前` varchar(100) NOT NULL,
  `ふりがな` varchar(100) NOT NULL,
  `生年月日` varchar(100) NOT NULL,
  `郵便番号` varchar(100) NOT NULL,
  `都道府県` varchar(100) NOT NULL,
  `市区町村` varchar(255) NOT NULL,
  `番地・建物名` varchar(255) NOT NULL,
  `携帯番号` varchar(100) NOT NULL,
  `メールアドレス` varchar(255) NOT NULL,
  `連絡の取りやすい時間帯` varchar(100) NOT NULL,
  `経験年数` varchar(100) NOT NULL,
  `入職希望時期` varchar(100) NOT NULL,
  `就業形態` varchar(100) NOT NULL,
  `就業状況` varchar(100) NOT NULL,
  `希望勤務地１` varchar(100) NOT NULL,
  `希望勤務地２` varchar(100) NOT NULL,
  `希望事業所形態` varchar(500) NOT NULL,
  `資格取得年` varchar(100) NOT NULL,
  `職務施設１` varchar(100) NOT NULL,
  `職務年数１` varchar(100) NOT NULL,
  `職務施設２` varchar(100) NOT NULL,
  `職務年数２` varchar(100) NOT NULL,
  `職務施設３` varchar(100) NOT NULL,
  `職務年数３` varchar(100) NOT NULL,
  `職務施設４` varchar(100) NOT NULL,
  `職務年数４` varchar(100) NOT NULL,
  `職務施設５` varchar(100) NOT NULL,
  `職務年数５` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  KEY `serial` (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE IF NOT EXISTS `institutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `furigana` varchar(100) NOT NULL,
  `postalcode` varchar(50) NOT NULL,
  `prefecture_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `contact_person_name` varchar(100) NOT NULL,
  `contact_person_title` varchar(100) NOT NULL,
  `contact_method` varchar(255) NOT NULL,
  `note_count` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `institution_features`
--

CREATE TABLE IF NOT EXISTS `institution_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `institution_id` (`institution_id`,`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `institution_nursing_facilities`
--

CREATE TABLE IF NOT EXISTS `institution_nursing_facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_id` int(11) NOT NULL,
  `maximum_acceptance` varchar(255) NOT NULL,
  `acceptance_level` int(2) DEFAULT NULL,
  `dementia_patient_support_status` tinyint(1) NOT NULL DEFAULT '0',
  `dementia_supported_symptoms` text NOT NULL,
  `chronic_disease_support_status` tinyint(1) NOT NULL DEFAULT '0',
  `chronic_disease_supported_symptoms` text NOT NULL,
  `medical_support_status` tinyint(1) NOT NULL DEFAULT '0',
  `medical_support_detail` text,
  `oxygen_day_in_liter` varchar(100) DEFAULT NULL,
  `oxygen_night_in_liter` varchar(100) DEFAULT NULL,
  `insulin_per_day` int(2) NOT NULL DEFAULT '0',
  `insulin_timing` varchar(255) DEFAULT NULL,
  `suction_of_phlegm_per_day` int(2) NOT NULL DEFAULT '0',
  `artificial_dialysis_per_week` int(2) NOT NULL DEFAULT '0',
  `medical_aid_at_night` tinyint(1) NOT NULL DEFAULT '0',
  `nursing_services` text,
  `other_requirements` text,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `institution_residency_requirements`
--

CREATE TABLE IF NOT EXISTS `institution_residency_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_id` int(11) NOT NULL,
  `vacant_rooms` varchar(255) NOT NULL,
  `vacant_single_rooms` varchar(255) NOT NULL,
  `vacant_family_rooms` varchar(255) NOT NULL,
  `scheduled_moving_type` varchar(255) NOT NULL,
  `single_room_status` varchar(255) NOT NULL,
  `family_room_status` varchar(255) NOT NULL,
  `moving_in_cost_per_person` varchar(255) NOT NULL,
  `monthly_cost_per_person` varchar(255) NOT NULL,
  `repayment_lump_sum` varchar(255) NOT NULL,
  `repayment_period` varchar(255) NOT NULL,
  `refund` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `remarks` text NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `target_id` (`target_id`,`type`,`date_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Table structure for table `nursing_welfare_consulters`
--

CREATE TABLE IF NOT EXISTS `nursing_welfare_consulters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `furigana` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `postalcode` varchar(50) NOT NULL,
  `prefecture_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_method` varchar(255) NOT NULL,
  `scheduled_occupancy_timing` varchar(255) NOT NULL,
  `desired_area` varchar(255) NOT NULL,
  `scheduled_occupancy_type` varchar(255) NOT NULL,
  `scheduled_moving_type` varchar(255) NOT NULL,
  `required_tenant_form` varchar(255) NOT NULL,
  `moving_in_cost_per_person` varchar(255) NOT NULL,
  `monthly_cost_per_person` varchar(255) NOT NULL,
  `required_facilities` text NOT NULL,
  `note_count` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nursing_welfare_patients`
--

CREATE TABLE IF NOT EXISTS `nursing_welfare_patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nursing_welfare_consulter_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'お名前',
  `furigana` varchar(100) NOT NULL COMMENT 'ふりがな',
  `gender` varchar(20) NOT NULL COMMENT '性別',
  `date_of_birth` date NOT NULL COMMENT '生年月日',
  `maximum_acceptance` varchar(255) NOT NULL,
  `acceptance_level` int(2) DEFAULT NULL,
  `dementia_patient_support_status` tinyint(1) NOT NULL DEFAULT '0',
  `dementia_supported_symptoms` text NOT NULL,
  `chronic_disease_support_status` tinyint(1) NOT NULL DEFAULT '0',
  `chronic_disease_supported_symptoms` text NOT NULL,
  `medical_support_status` tinyint(1) NOT NULL DEFAULT '0',
  `medical_support_detail` text NOT NULL,
  `oxygen_day_in_liter` varchar(100) DEFAULT NULL,
  `oxygen_night_in_liter` varchar(100) DEFAULT NULL,
  `insulin_per_day` int(2) NOT NULL DEFAULT '0',
  `insulin_timing` varchar(255) DEFAULT NULL,
  `suction_of_phlegm_per_day` int(2) NOT NULL DEFAULT '0',
  `artificial_dialysis_per_week` int(2) NOT NULL DEFAULT '0',
  `medical_aid_at_night` tinyint(1) NOT NULL DEFAULT '0',
  `nursing_services` text NOT NULL,
  `other_requirements` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `nursing_welfare_consulter_id` (`nursing_welfare_consulter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prefectures`
--

CREATE TABLE IF NOT EXISTS `prefectures` (
  `id` int(4) NOT NULL DEFAULT '0' COMMENT '都道府県ID',
  `ken_name` varchar(32) NOT NULL COMMENT '県名',
  `division` varchar(4) NOT NULL COMMENT '都道府県',
  `prefecture_name` varchar(32) NOT NULL,
  `area_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='マスター　都道府県情報';

-- --------------------------------------------------------

--
-- Table structure for table `reha_works`
--

CREATE TABLE IF NOT EXISTS `reha_works` (
  `serial` varchar(100) NOT NULL,
  `お名前` varchar(100) NOT NULL,
  `ふりがな` varchar(100) NOT NULL,
  `生年月日` varchar(100) NOT NULL,
  `郵便番号` varchar(100) NOT NULL,
  `都道府県` varchar(100) NOT NULL,
  `市区町村` varchar(255) NOT NULL,
  `番地・建物名` varchar(255) NOT NULL,
  `携帯番号` varchar(100) NOT NULL,
  `メールアドレス` varchar(255) NOT NULL,
  `連絡の取りやすい時間帯` varchar(100) NOT NULL,
  `経験年数` varchar(100) NOT NULL,
  `入職希望時期` varchar(100) NOT NULL,
  `就業形態` varchar(100) NOT NULL,
  `就業状況` varchar(100) NOT NULL,
  `希望勤務地１` varchar(100) NOT NULL,
  `希望勤務地２` varchar(100) NOT NULL,
  `希望事業所形態` varchar(500) NOT NULL,
  `資格取得年` varchar(100) NOT NULL,
  `職務施設１` varchar(100) NOT NULL,
  `職務年数１` varchar(100) NOT NULL,
  `職務施設２` varchar(100) NOT NULL,
  `職務年数２` varchar(100) NOT NULL,
  `職務施設３` varchar(100) NOT NULL,
  `職務年数３` varchar(100) NOT NULL,
  `職務施設４` varchar(100) NOT NULL,
  `職務年数４` varchar(100) NOT NULL,
  `職務施設５` varchar(100) NOT NULL,
  `職務年数５` varchar(100) NOT NULL,
  `work_type` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  KEY `serial` (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rigaku`
--

CREATE TABLE IF NOT EXISTS `rigaku` (
  `serial` varchar(100) NOT NULL,
  `お名前` varchar(100) NOT NULL,
  `ふりがな` varchar(100) NOT NULL,
  `生年月日` varchar(100) NOT NULL,
  `郵便番号` varchar(100) NOT NULL,
  `都道府県` varchar(100) NOT NULL,
  `市区町村` varchar(255) NOT NULL,
  `番地・建物名` varchar(255) NOT NULL,
  `携帯番号` varchar(100) NOT NULL,
  `メールアドレス` varchar(255) NOT NULL,
  `連絡の取りやすい時間帯` varchar(100) NOT NULL,
  `経験年数` varchar(100) NOT NULL,
  `入職希望時期` varchar(100) NOT NULL,
  `就業形態` varchar(100) NOT NULL,
  `就業状況` varchar(100) NOT NULL,
  `希望勤務地１` varchar(100) NOT NULL,
  `希望勤務地２` varchar(100) NOT NULL,
  `希望事業所形態` varchar(500) NOT NULL,
  `資格取得年` varchar(100) NOT NULL,
  `職務施設１` varchar(100) NOT NULL,
  `職務年数１` varchar(100) NOT NULL,
  `職務施設２` varchar(100) NOT NULL,
  `職務年数２` varchar(100) NOT NULL,
  `職務施設３` varchar(100) NOT NULL,
  `職務年数３` varchar(100) NOT NULL,
  `職務施設４` varchar(100) NOT NULL,
  `職務年数４` varchar(100) NOT NULL,
  `職務施設５` varchar(100) NOT NULL,
  `職務年数５` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  KEY `serial` (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sagyo`
--

CREATE TABLE IF NOT EXISTS `sagyo` (
  `serial` varchar(100) NOT NULL,
  `お名前` varchar(100) NOT NULL,
  `ふりがな` varchar(100) NOT NULL,
  `生年月日` varchar(100) NOT NULL,
  `郵便番号` varchar(100) NOT NULL,
  `都道府県` varchar(100) NOT NULL,
  `市区町村` varchar(255) NOT NULL,
  `番地・建物名` varchar(255) NOT NULL,
  `携帯番号` varchar(100) NOT NULL,
  `メールアドレス` varchar(255) NOT NULL,
  `連絡の取りやすい時間帯` varchar(100) NOT NULL,
  `経験年数` varchar(100) NOT NULL,
  `入職希望時期` varchar(100) NOT NULL,
  `就業形態` varchar(100) NOT NULL,
  `就業状況` varchar(100) NOT NULL,
  `希望勤務地１` varchar(100) NOT NULL,
  `希望勤務地２` varchar(100) NOT NULL,
  `希望事業所形態` varchar(500) NOT NULL,
  `資格取得年` varchar(100) NOT NULL,
  `職務施設１` varchar(100) NOT NULL,
  `職務年数１` varchar(100) NOT NULL,
  `職務施設２` varchar(100) NOT NULL,
  `職務年数２` varchar(100) NOT NULL,
  `職務施設３` varchar(100) NOT NULL,
  `職務年数３` varchar(100) NOT NULL,
  `職務施設４` varchar(100) NOT NULL,
  `職務年数４` varchar(100) NOT NULL,
  `職務施設５` varchar(100) NOT NULL,
  `職務年数５` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  KEY `serial` (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_periods`
--

CREATE TABLE IF NOT EXISTS `service_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '職歴年数',
  `sort_no` smallint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sort_no` (`sort_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'admin',
  `ip_address` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`role`,`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `work_histories`
--

CREATE TABLE IF NOT EXISTS `work_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT NULL COMMENT '職歴施設ID',
  `service_period_id` int(11) DEFAULT NULL COMMENT '職歴年数ID',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `applicant_id` (`applicant_id`,`business_id`,`service_period_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=307 ;

-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

CREATE TABLE IF NOT EXISTS `work_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_no` smallint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sort_no` (`sort_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
