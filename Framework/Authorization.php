<?php

namespace Framework;

use Framework\Session;

class Authorization
{
    /**
     * Check if the currently logged-in user owns a resource
     * 
     * @param int $resourceUserId
     * @return bool
     */
    public static function isOwner($resourceUserId)
    {
        $sessionUser = Session::get('user');

        if ($sessionUser !== null && isset($sessionUser['id'])) {
            $sessionUserId = (int) $sessionUser['id'];
            return $sessionUserId === $resourceUserId;
        }

        return false;
    }
}
