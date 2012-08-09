ALTER TABLE  `nos_comment` CHANGE  `comm_parent_id`  `comm_foreign_id` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE  `nos_comment` ADD  `comm_from_table` VARCHAR( 255 ) NOT NULL AFTER  `comm_id`;
ALTER TABLE  `nos_comment` ADD INDEX (  `comm_from_table` ,  `comm_foreign_id` ) ;