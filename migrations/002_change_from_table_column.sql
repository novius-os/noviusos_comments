ALTER TABLE  `nos_comment` CHANGE  `comm_from_table`  `comm_foreign_model` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
UPDATE `nos_comment` SET comm_foreign_model = '\\Nos\\BlogNews\\Blog\\Model_Post' WHERE comm_foreign_model = 'nos_blog_post';
UPDATE `nos_comment` SET comm_foreign_model = '\\Nos\\BlogNews\\News\\Model_Post' WHERE comm_foreign_model = 'nos_news_post';