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

class Orm_Behaviour_Cachemanager extends \Nos\Orm_Behaviour
{

    public function before_save(\Nos\Orm\Model $item)
    {
        if ($item->is_changed('comm_state') || $item->is_new()) {
            $item->deleteCacheItem($item);
        }
    }

    public function after_delete(\Nos\Orm\Model $item)
    {
        $this->deleteCacheItem($item);
    }

    public function deleteCacheItem($item)
    {
        $relatedItem = $item->getRelatedItem();
        if (!empty($relatedItem)) {
            $relatedItem->event('deleteCacheComments');
        }
    }
}
