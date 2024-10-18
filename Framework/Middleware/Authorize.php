<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            return redirect('/');
        } elseif ($role === 'auth' && !$this->isAuthenticated()) {
            return redirect('/auth/login');
        }
    }

    /**
     * Check if the user is authenticated
     * 
     * @param string $role
     * @return bool
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }
}
