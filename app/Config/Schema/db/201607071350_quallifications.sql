CREATE TABLE  `medical-jobs_development`.`qualifications` (
`id` INT( 4 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 255 ) NOT NULL ,
`is_other` TINYINT( 1 ) NOT NULL DEFAULT  '0',
`created_at` DATETIME NOT NULL ,
`updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = MYISAM ;