/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

ALTER TABLE  `nos_comment` CHANGE  `comm_from_table`  `comm_foreign_model` VARCHAR( 255 ) NOT NULL;
UPDATE `nos_comment` SET comm_foreign_model = 'Nos\\BlogNews\\Blog\\Model_Post' WHERE comm_foreign_model = 'nos_blog_post';
UPDATE `nos_comment` SET comm_foreign_model = 'Nos\\BlogNews\\News\\Model_Post' WHERE comm_foreign_model = 'nos_news_post';