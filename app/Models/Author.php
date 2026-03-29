<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'tbl_authors';
    protected $primaryKey = 'author_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'slug',
        'name',
        'image',
        'designation',
        'bio',
        'joined_year',
        'location',
        'social'
    ];

    protected $casts = [
        'social' => 'array',
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'author_id', 'author_id');
    }
}
