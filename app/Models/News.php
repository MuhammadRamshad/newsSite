<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'tbl_news';
    protected $primaryKey = 'news_id';
    public $timestamps = false;

    /**
     * Returns the public URL for the news photo stored locally.
     * Place uploaded images in: public/assets/images/uploads/
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('assets/images/uploads/' . $this->photo);
        }
        return asset('assets/images/foxiz.webp'); // fallback placeholder
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_id');
    }
}
