/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

CREATE TABLE IF NOT EXISTS `nos_comment` (
  `comm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comm_from_table` varchar(255) NOT NULL,
  `comm_foreign_id` int(10) unsigned NOT NULL,
  `comm_email` varchar(255) NOT NULL,
  `comm_author` varchar(255) NOT NULL,
  `comm_content` text NOT NULL,
  `comm_created_at` datetime NOT NULL,
  `comm_ip` varchar(15) NOT NULL,
  `comm_state` enum('published','pending','refused') NOT NULL,
  PRIMARY KEY (`comm_id`),
  KEY `comm_created_at` (`comm_created_at`),
  KEY `comm_parent_id` (`comm_foreign_id`),
  KEY `comm_from_table` (`comm_from_table`,`comm_foreign_id`)
) DEFAULT CHARSET=utf8;