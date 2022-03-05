<?php
namespace App\Models;

class Users extends \Illuminate\Database\Eloquent\Model
{
    const UPDATED_AT = 'updated';
    const CREATED_AT = 'created';
    protected $table = 'users';
    protected $fillable = ['FullName', 'email', 'password'];
}
