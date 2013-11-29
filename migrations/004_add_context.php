<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Nos\Comments\Migrations;

class Add_Context extends \Nos\Migration
{
    public function up()
    {
        parent::up();

        $foreign_models = \DB::select('comm_foreign_model')->from('nos_comment')->distinct()->execute();
        foreach ($foreign_models->as_array() as $foreign_model) {
            $model = $foreign_model['comm_foreign_model'];
            $contextable = $model::behaviours('Nos\Orm_Behaviour_Contextable', array());
            if (empty($contextable)) {
                $contextable = $model::behaviours('Nos\Orm_Behaviour_Twinnable', array());
            }
            if (!empty($contextable)) {
                $pk = $model::primary_key();
                \DB::query(
                    'UPDATE `nos_comment`, `'.$model::table().'`'.
                    ' SET `comm_context` = `'.$contextable['context_property'].'`'.
                    ' WHERE `comm_foreign_model` = '.\DB::quote($model, $model::connection(true)).
                    ' AND `comm_foreign_id` = `'.$pk[0].'`'
                )->execute();
            }

            \DB::query(
                'DELETE FROM `nos_comment`'.
                ' WHERE `comm_foreign_model` = '.\DB::quote($model, $model::connection(true)).
                ' AND `comm_foreign_id` NOT IN (SELECT `'.$pk[0].'` FROM `'.$model::table().'`)'
            )->execute();
        }
    }
}
