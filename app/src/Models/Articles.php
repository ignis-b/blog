<?php
namespace App\Models;

class Articles extends \Illuminate\Database\Eloquent\Model
{
    const UPDATED_AT = 'updated';
    const CREATED_AT = 'created';
    protected $table = 'articles';
    protected $fillable = ['title', 'content', 'summary', 'image', 'authorId'];
    
    protected $attributes = [
        'image' => ''
    ];
}
