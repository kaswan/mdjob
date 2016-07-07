ALTER TABLE  `applicants` ADD  `mail_magazine_subscription` TINYINT( 1 ) NOT NULL DEFAULT  '0' COMMENT  'メルマガ希望' AFTER  `post_id`;
ALTER TABLE  `applicants` ADD  `sort_modified_date` DATETIME NULL AFTER  `mail_magazine_subscription`, ADD INDEX (  `sort_modified_date` );
