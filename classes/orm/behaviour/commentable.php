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

}
