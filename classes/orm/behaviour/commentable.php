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

    protected $_api;

    /**
     * Add relations for comments
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
            'cascade_delete' => false,
            'conditions' => array(
                'where' => array(
                    array('comm_foreign_model', '=', $class),
                    array('comm_state', '=', 'published'),
                ),
                'order_by' => array('comm_created_at' => 'ASC')
            ),
        ));

        $class::addRelation('has_many', 'comments_cascade_delete', array(
            'key_from' => $pk,
            'model_to' => 'Nos\Comments\Model_Comment',
            'key_to' => 'comm_foreign_id',
            'cascade_save' => false,
            'cascade_delete' => true,
            'conditions' => array(
                'where' => array(
                    array('comm_foreign_model', '=', $class),
                ),
            ),
        ));
    }

    /**
     * Return an instance of the comment's API class in order to allow custom processing.
     *
     * @param null|string $context set context for the comment Api
     * @return \Nos\Comments\Api An instance of Nos\Comments\Api, configured for this item.
     */
    public function commentApi($context = null)
    {
        if (empty($this->_api)) {
            if ($context === null) {
                $context = \Nos\Nos::main_controller()->getContext();
            }
            $config = \Config::load('noviusos_comments::api', true);
            $api_config = \Arr::get($config, 'default', array());
            if (!empty($context)) {
                $api_config = \Arr::merge($api_config, \Arr::get($config, 'setups.'.$context, array()));
            }
            $api_config = \Arr::merge($api_config, \Arr::get($config, 'setups.'.$this->_class, array()));
            $api_config['model'] = $this->_class;

            $this->_api = API::forge($api_config);
        }
        return $this->_api;
    }

    protected $nb_comments = array();

    /**
     * Returns and caches the number of comments related to one item
     *
     * @param \Nos\Orm\Model $item
     * @return integer number of comments
     */
    public function count_comments(\Nos\Orm\Model $item)
    {
        if (!isset($this->nb_comments[$item->id])) {
            $item->setNbComments(
                \Nos\Comments\Model_Comment::count(
                    array(
                        'where' => array(
                            array('comm_foreign_id' => $item->id),
                            array('comm_foreign_model' => $this->_class),
                            array('comm_state', '=', 'published'),
                        )
                    )
                )
            );
        }
        return $this->nb_comments[$item->id];
    }

    /**
     * Allow to enter a custom cached number of comments related to the item. Can be useful when
     * adding or removing a comment for instance.
     *
     * @param \Nos\Orm\Model $item
     * @param $nb number of comments
     */
    public function setNbComments(\Nos\Orm\Model $item, $nb)
    {
        $this->nb_comments[$item->id] = $nb;
    }

    /*
     * From a items' list, retrieve the number of comments in an optimal way.
     *
     * @return array updated items' list
     */
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
            ->and_where('comm_state', '=', 'published')
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
