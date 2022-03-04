<?php
namespace App\Models;

class Users extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'user';
    public $timestamps = false;
    
    protected $fillable = [
     'emil',
     'name',
     'password_hash',
     'role'
    ];
}
