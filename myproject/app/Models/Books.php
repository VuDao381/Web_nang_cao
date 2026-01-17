<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //
    protected $fillable = [
        'title',
        'author',
        'price',
        'quantity',
        'published_year',
        'pages',
        'description',
        'image',
        'category_id',
        'publisher_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
