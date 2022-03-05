<?php
namespace App\Services;

use App\Models\Users;

class LogoutService
{
    /**
     * Logout User method.
     */
    public function logout()
    {
        var_dump('in');
        session_destroy();
    }
}
