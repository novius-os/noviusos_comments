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

class Orm_Behaviour_Commentable extends \Nos\Orm_Behaviour
{
    public static function _init()
    {
        \Nos\I18n::current_dictionary('noviusos_comments::common');
    }

    /**
     * parent_relation
     * children_relation
     */
    protected $_properties = array();

    public function __construct($class)
    {
        parent::__construct($class);

        if (!isset($this->_properties['show_states'])) {
            $this->_properties['show_states'] = array('published');
        }
        if (!is_array($this->_properties['show_states'])) {
            $this->_properties['show_states'] = array($this->_properties['show_states']);
        }
    }

    /**
     * Add relations for linked media and wysiwyg shared with other context
     */
    public function buildRelations()
    {
        $class = $this->_class;
        $pk = $class::primary_key();
        $pk = $pk[0];

        $class::addRelation('has_many', 'comments', array(
            'key_from' => $pk,
            'model_to' => 'Nos\Comments\Model_Comment',
            'key_to' => 'comm_foreign_id',
            'cascade_save' => false,
            'cascade_delete' => true,
            'conditions' => array(
                'where' => array(
                    array('comm_foreign_model', '=', $class),
                    array('comm_state', 'IN', $this->_properties['show_states']),
                ),
                'order_by' => array('comm_created_at' => 'ASC')
            ),
        ));
    }

    public function getProperties()
    {
        return $this->_properties;
    }


    protected $nb_comments = array();
    public function count_comments(\Nos\Orm\Model $item)
    {
        if (!isset($this->nb_comments[$item->id])) {
            $item->setNbComments(
                \Nos\Comments\Model_Comment::count(
                    array(
                        'where' => array(
                            array('comm_foreign_id' => $item->id),
                            array('comm_foreign_model' => $this->_class),
                            array('comm_state', 'IN', $this->_properties['show_states']),
                        )
                    )
                )
            );
        }
        return $this->nb_comments[$item->id];
    }

    public function setNbComments(\Nos\Orm\Model $item, $nb)
    {
        $this->nb_comments[$item->id] = $nb;
    }

    public function count_multiple_comments($items)
    {
        if (count($items) === 0) {
            return $items;
        }
        $class = $this->_class;
        $ids = array();

        foreach ($items as $post) {
            $ids[] = $post->id;
        }

        $comments_count = \Db::select(\Db::expr('COUNT(comm_id) AS count_result'), 'comm_foreign_id')
            ->from(\Nos\Comments\Model_Comment::table())
            ->where('comm_foreign_id', 'in', $ids)
            ->and_where('comm_foreign_model', '=', $class)
            ->and_where('comm_state', 'IN', $this->_properties['show_states'])
            ->group_by('comm_foreign_id')
            ->execute()->as_array();

        $comments_count = \Arr::assoc_to_keyval($comments_count, 'comm_foreign_id', 'count_result');

        foreach ($items as $key => $item) {
            if (isset($comments_count[$items[$key]->id])) {
                $items[$key]->setNbComments($comments_count[$items[$key]->id]);
            } else {
                $items[$key]->setNbComments(0);
            }
        }

        return $items;
    }

}
