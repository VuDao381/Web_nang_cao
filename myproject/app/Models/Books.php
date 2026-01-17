<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //
    protected $fillable = [
        'title',
        'author',
        'description',
        'published_date',
        'pages',
        'price',
        'quantity',
        'category_id',
        'publisher_id',
        'image'
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
