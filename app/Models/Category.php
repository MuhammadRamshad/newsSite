<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'tbl_category';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';
    protected $guarded = [];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id', 'category_id');
    }

    public function newsCount()
    {
        return $this->hasMany(News::class, 'category_id', 'category_id');
    }

    /**
     * Slug attribute — used in all routes.
     * If a `slug` column exists on the table it is used directly;
     * otherwise it is derived from category_name.
     */
    public function getSlugAttribute(): string
    {
        return isset($this->attributes['slug']) && $this->attributes['slug']
            ? $this->attributes['slug']
            : Str::slug($this->category_name);
    }

    /**
     * Allow Category::where('slug', $slug) to work
     * whether or not the DB has a slug column.
     */
    public static function findBySlug(string $slug): ?self
    {
        // Try a real DB column first
        $cat = static::where('slug', $slug)->first();
        if ($cat) {
            return $cat;
        }
        // Fall back to in-memory slug derivation
        return static::get()->first(fn($c) => Str::slug($c->category_name) === $slug);
    }
}
