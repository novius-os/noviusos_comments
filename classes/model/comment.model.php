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

class Model_Comment extends \Nos\Orm\Model
{
    protected static $_table_name = 'nos_comment';
    protected static $_primary_key = array('comm_id');

    protected static $_properties = array(
        'comm_id' => array(
            'default' => null,
            'data_type' => 'int unsigned',
            'null' => false,
        ),
        'comm_foreign_model' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'comm_foreign_id' => array(
            'default' => null,
            'data_type' => 'int unsigned',
            'null' => false,
        ),
        'comm_email' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'comm_author' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'comm_content' => array(
            'default' => null,
            'data_type' => 'text',
            'null' => false,
        ),
        'comm_created_at' => array(
            'default' => null,
            'data_type' => 'datetime',
            'null' => false,
        ),
        'comm_ip' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'comm_state' => array(
            'default' => null,
            'data_type' => 'enum',
            'null' => false,
        ),
    );

    protected static $_title_property = 'comm_content';

    public function getRelatedItem()
    {
        $model = $this->comm_foreign_model;
        return $model::find($this->comm_foreign_id);
    }
}
