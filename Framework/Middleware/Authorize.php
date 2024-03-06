<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Check if the user is authenticated
     * 
     * @param string $role
     * @return boolean
     */
    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            return redirect('/');
        } else if ($role === 'auth' && !$this->isAuthenticated()) {
            return redirect('/auth/login');
        }
    }

    /**
     * Check if the user is authenticated
     * 
     * @param string $role
     * @return boolean
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }
}
