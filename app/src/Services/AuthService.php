<?php
namespace App\Services;

use App\Models\Users;

class AuthService
{
    /**
     * Check User method.
     * @param array $params
     * @return boolean
     */
    public function check($params)
    {
        $query = Users::where('email', $params['email']);
        if ($query->first()->email && password_verify($params['password'], $query->first()->password)) {
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $query->first()->FullName;
            $_SESSION['id'] = $query->first()->id;
            return TRUE;
        }
        return FALSE;
    }
}
