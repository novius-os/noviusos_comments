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

    protected $_comments_relation = null;

    /**
     * parent_relation
     * children_relation
     */
    protected $_properties = array();

    public function __construct($class)
    {
        parent::__construct($class);
        $this->_comments_relation = call_user_func($class . '::relations', $this->_properties['comments_relation']);

        if (false === $this->_comments_relation) {
            throw new \Exception('Relation "comments" not found by commentable behaviour: '.$this->_class);
        }
    }

    public function common(&$config)
    {
        $class = $this->_class;
        $comments_relation = $this->_comments_relation;
        $prefix = $class::prefix();

        if (!isset($config['actions']['list']['comments'])) {
            $config['actions']['list']['comments'] = array();
        }

        if ($config['actions']['list']['comments'] !== false) {
            $comments_action_config = array(
                'label' => __('Comments'),
                'icon' => 'comment',
                'targets' => array(
                    'grid' => true,
                    'toolbar-edit' => true,
                ),
                'action' => array(
                    'action' => 'nosTabs',
                    'tab' => array(
                        'url' => 'admin/noviusos_comments/comment/appdesk?model={{_model}}&id={{_id}}',
                        'label' => __('Comments to ‘{{title}}’'),
                    ),
                ),
                'visible' => function($params) {
                    return !isset($params['item']) || !$params['item']->is_new();
                },
                'disabled' =>
                function($item) {
                    return ($item->is_new() || !\Nos\Comments\Model_Comment::count(array(
                        'where' => array(
                            array(
                                'comm_foreign_model' => get_class($item),
                                'comm_foreign_id' => $item->id
                            )
                        ),
                    ))) ? __('This item has no comments.') : false;
                }
            );

            $config['actions']['list']['comments'] = \Arr::merge(
                $comments_action_config,
                $config['actions']['list']['comments']
            );
        }

        if (!isset($config['data_mapping']['comments_count'])) {
            $config['data_mapping']['comments_count'] = array();
        }

        if ($config['data_mapping']['comments_count'] !== false) {
            $comments_data_mapping_config = array(
                'title' => __('Comments'),
                'cellFormatters' => array(
                    'center' => array(
                        'type' => 'css',
                        'css' => array('text-align' => 'center'),
                    ),
                    'link' => array(
                        'type' => 'link',
                        'action' => array(
                            'action' => 'nosTabs',
                            'tab' => array(
                                'url' => 'admin/noviusos_comments/comment/appdesk?model={{_model}}&id={{_id}}',
                                'label' => __('Comments to ‘{{title}}’'),
                            ),
                        ),
                    ),
                ),
                'value' => function($item) use ($class) {
                    return $item->is_new() ? 0 : \Nos\Comments\Model_Comment::count(
                        array(
                            'where' => array(array('comm_foreign_model' => $class,'comm_foreign_id' => $item->id)),
                        )
                    );
                },
                'sorting_callback' => function(&$query, $sortDirection) use ($comments_relation, $prefix) {
                    $join = array();
                    $query->_join_relation($comments_relation, $join);
                    $query->group_by($join['alias_from'].'.'.$prefix.'id');
                    $query->order_by(\Db::expr('COUNT(*)'), $sortDirection);
                },
                'width' => 100,
                'ensurePxWidth' => true,
                'allowSizing' => false,
            );

            $config['data_mapping']['comments_count'] = \Arr::merge(
                $comments_data_mapping_config,
                $config['data_mapping']['comments_count']
            );
        }
    }
}
