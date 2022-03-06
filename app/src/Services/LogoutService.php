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
        session_destroy();
    }
}
