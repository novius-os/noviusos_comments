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

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Contextable' => array(
            'context_property'      => 'comm_context',
        ),
    );

    protected static $_observers = array(
        'Orm\Observer_Self',
    );

    protected static $_title_property = 'comm_content';

    public function getRelatedItem()
    {
        $model = $this->comm_foreign_model;
        return $model::find($this->comm_foreign_id);
    }

    public function deleteCacheItem()
    {
        $relatedItem = $this->getRelatedItem();
        if (!empty($relatedItem)) {
            try {
                $relatedItem->deleteCacheItem();
            } catch (\Exception $e) {
                // Item doesn't have the behaviour Urlenhancer, nothing to do
            }
        }
    }

    public function _event_before_save()
    {
        parent::_event_before_save();
        if ($this->is_changed('comm_state') || $this->is_new()) {
            $this->deleteCacheItem();
        }
    }

    public function _event_after_delete()
    {
        $this->deleteCacheItem();
    }

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
