<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Nos\Comments;

class Model_Comment extends \Nos\Orm\Model {
    protected static $_table_name = 'nos_comment';
    protected static $_primary_key = array('comm_id');
}

