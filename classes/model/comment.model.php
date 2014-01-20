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
        'comm_context' => array(
            'default' => null,
            'data_type' => 'varchar',
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
        'comm_subscribed' => array(
            'default' => 1,
            'data_type' => 'tinyint',
            'null' => false,
        ),
    );

    protected static $_has_one = array();
    protected static $_belongs_to  = array();
    protected static $_has_many  = array();
    protected static $_many_many = array();
    protected static $_twinnable_has_one = array();
    protected static $_twinnable_has_many = array();
    protected static $_twinnable_belongs_to = array();
    protected static $_twinnable_many_many = array();

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Contextable' => array(
            'context_property'      => 'comm_context',
        ),
        'Nos\Comments\Orm_Behaviour_Cachemanager' => array(),
    );

    protected static $_observers = array(
        'Orm\Observer_Self',
    );

    protected static $_title_property = 'comm_content';

    /**
     * Retrieves the instance of the related item model, if it exists.
     *
     * @return \Orm\Model|\Orm\Model
     */
    public function getRelatedItem()
    {
        if (empty($this->comm_foreign_id)) {
            // When deleting the related item, the cascade_save will put this field to null. When this happens, this
            // mean we don't need to delete the cache here, because it's already done from the related item.
            return;
        }
        $model = $this->comm_foreign_model;
        return $model::find($this->comm_foreign_id);
    }

    /**
     * Changes the user subscription status to new comments on an item.
     *
     * @param \Nos\Orm\Model $from Related item
     * @param string $email The user's email address
     * @param boolean $subscribe false to disable the subscription, true to enabled it
     */
    public static function changeSubscriptionStatus($from, $email, $subscribe)
    {
        \DB::update(static::$_table_name)
            ->set(array(
                'comm_subscribed' => $subscribe ? 1 : 0
            ))
            ->where(array(
                'comm_foreign_model'    => get_class($from),
                'comm_foreign_id'       => $from->id,
                'comm_email'            => $email
            ))
            ->execute();
    }
}
