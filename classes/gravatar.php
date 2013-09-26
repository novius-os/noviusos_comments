<?php
namespace Nos\Comments;

class Gravatar
{
    public static function url($email, array $options = array())
    {
        $params = \Arr::merge(
            array(
                'gravatar_id'   => md5(strtolower(trim($email))),
                'rating'        => 'G',
                'size'          => 80,
                'default'		=> 'http://www.gravatar.com/avatar/00000000000000000000000000000000', //default image
            ),
            $options
        );

        return 'http://gravatar.com/avatar.php?'.http_build_query($params, '', '&');
    }
}
