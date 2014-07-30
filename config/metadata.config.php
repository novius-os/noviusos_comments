<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

return array(
    'name'    => 'Comments',
    'version' => '5.0.1 (Elche)',
    'provider' => array(
        'name' => 'NoviusOS',
    ),
    'namespace' => 'Nos\\Comments',
    'permission' => array(

    ),
    'i18n_file' => 'noviusos_comments::metadata',
    'icons' => array(
        16 => 'static/apps/noviusos_comments/img/comment-16.png',
        32 => 'static/apps/noviusos_comments/img/comment-32.png',
        64 => 'static/apps/noviusos_comments/img/comment-64.png',
    ),
    'launchers' => array(
        'noviusos_comments' => array(
            'name'    => 'Comments',
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'admin/noviusos_comments/comment/appdesk',
                ),
            ),
        ),
    ),
);
