-- --------------------------------------------------------

--
-- テーブルの構造 `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(100) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL COMMENT 'お名前',
  `furigana` varchar(100) NOT NULL COMMENT 'ふりがな',
  `gender` varchar(20) NOT NULL COMMENT '性別',
  `date_of_birth` date NOT NULL COMMENT '生年月日',
  `postalcode` varchar(20) NOT NULL COMMENT '郵便番号',
  `prefecture_id` int(11) NOT NULL COMMENT '都道府県',
  `address` varchar(255) NOT NULL COMMENT '住所',
  `house_address` varchar(255) DEFAULT NULL COMMENT '番地',
  `nearest_station` varchar(255) DEFAULT NULL,
  `tel` varchar(100) NOT NULL COMMENT '携帯電話',
  `tel_home` varchar(255) DEFAULT NULL COMMENT '固定電話',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `email_mobile` varchar(255) DEFAULT NULL COMMENT '携帯メールアドレス',
  `contact_time` varchar(255) NOT NULL COMMENT '連絡時間帯',
  `education` varchar(255) DEFAULT NULL COMMENT '最終学歴',
  `year_of_experience` varchar(255) NOT NULL COMMENT 'ご経験年数',
  `desired_joining_time` varchar(255) NOT NULL COMMENT '入職希望',
  `employment_pattern` varchar(255) NOT NULL COMMENT '就業形態',
  `places_of_employment` varchar(500) DEFAULT NULL COMMENT '就業場所',
  `annual_income` varchar(255) DEFAULT NULL COMMENT '年収',
  `holiday` varchar(255) DEFAULT NULL COMMENT '休日',
  `working_hours` varchar(255) DEFAULT NULL COMMENT '勤務時間',
  `commuting_time` varchar(255) DEFAULT NULL COMMENT '通勤時間',
  `commuting` varchar(255) DEFAULT NULL COMMENT '交通',
  `employment_status` varchar(255) NOT NULL COMMENT '就業状況',
  `desired_location_first_id` int(11) NOT NULL COMMENT '希望勤務地１',
  `desired_location_second_id` int(11) NOT NULL COMMENT '希望勤務地１',
  `qualification_year` varchar(255) NOT NULL COMMENT '資格取得年',
  `contract_document` text COMMENT '書類関係',
  `desired_department` varchar(255) DEFAULT NULL COMMENT '希望部署',
  `desired_working_days` varchar(255) DEFAULT NULL COMMENT '勤務日数',
  `remarks` text NOT NULL COMMENT '備考',
  `work_type_id` int(4) NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `progress_status_id` int(2) DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL COMMENT '法人施設番号',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `note_count` int(11) NOT NULL DEFAULT '0',
  `upload_document_count` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gender` (`gender`,`prefecture_id`,`work_type_id`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100198 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(2) NOT NULL,
  `area_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='マスター　エリアデータ';

-- --------------------------------------------------------

--
-- テーブルの構造 `cake_sessions`
--

CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `contact_people`
--

CREATE TABLE IF NOT EXISTS `contact_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_id` int(11) NOT NULL,
  `department` varchar(255) DEFAULT NULL COMMENT '部署',
  `name` varchar(255) DEFAULT NULL COMMENT '担当者名',
  `title` varchar(255) DEFAULT NULL COMMENT '役職名',
  `direct_phone_number` varchar(255) DEFAULT NULL COMMENT '直通電話番号',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `institutions`
--

CREATE TABLE IF NOT EXISTS `institutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `furigana` varchar(100) NOT NULL,
  `corporate_name` varchar(255) DEFAULT NULL COMMENT '法人名',
  `corporate_furigana` varchar(255) DEFAULT NULL COMMENT '法人名 ふりがな',
  `postalcode` varchar(50) NOT NULL,
  `prefecture_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nearest_station` varchar(255) DEFAULT NULL COMMENT '最寄駅',
  `tel` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `contact_method` varchar(255) DEFAULT NULL,
  `classification` varchar(255) DEFAULT NULL COMMENT '区分',
  `clinical_departments` varchar(255) DEFAULT NULL COMMENT '科目',
  `number_of_beds` varchar(255) DEFAULT NULL COMMENT '病床数',
  `nursing_standards` varchar(255) DEFAULT NULL COMMENT '看護基準',
  `number_of_users` varchar(255) DEFAULT NULL COMMENT '利用者数',
  `expected_annual_income` varchar(255) DEFAULT NULL COMMENT '想定年収',
  `agreement_date` date DEFAULT NULL COMMENT '契約締結年月',
  `contract_percentage` varchar(255) DEFAULT NULL COMMENT '契約パーセンテージ',
  `contract_refund_policy` text COMMENT '返金規定',
  `contract_document` text COMMENT '書類関係',
  `interview_information` text COMMENT '面接情報',
  `other` text COMMENT '備考欄（文字制限無し）',
  `contact_person_count` int(5) NOT NULL DEFAULT '0',
  `applicant_count` int(5) NOT NULL DEFAULT '0',
  `note_count` int(11) NOT NULL DEFAULT '0',
  `upload_document_count` int(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `remarks` text NOT NULL,
  `select_institution_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `target_id` (`target_id`,`type`,`date_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `prefectures`
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
-- テーブルの構造 `progress_statuses`
--

CREATE TABLE IF NOT EXISTS `progress_statuses` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `qualification_histories`
--

CREATE TABLE IF NOT EXISTS `qualification_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '資格名',
  `year` varchar(255) DEFAULT NULL COMMENT '取得年',
  `month` varchar(255) DEFAULT NULL COMMENT '取得月',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `upload_documents`
--

CREATE TABLE IF NOT EXISTS `upload_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `document_dir` varchar(255) DEFAULT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `document_size` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `target_id` (`target_id`,`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_number` int(11) DEFAULT NULL COMMENT '社員番号',
  `name` varchar(255) DEFAULT NULL COMMENT '担当者名',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') NOT NULL DEFAULT 'member',
  `ip_address` varchar(100) DEFAULT NULL,
  `applicant_count` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`role`,`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `work_histories`
--

CREATE TABLE IF NOT EXISTS `work_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL COMMENT '勤務先名称',
  `department_name` varchar(255) DEFAULT NULL COMMENT '部署',
  `discipline` varchar(255) DEFAULT NULL COMMENT '科目',
  `employment_pattern` varchar(255) DEFAULT NULL COMMENT '雇用形態',
  `enrollment_year` varchar(255) DEFAULT NULL COMMENT '在籍年',
  `business_id` int(11) DEFAULT NULL COMMENT '職歴施設ID',
  `service_period_id` int(11) DEFAULT NULL COMMENT '職歴年数ID',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `applicant_id` (`applicant_id`,`business_id`,`service_period_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=322 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `work_types`
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