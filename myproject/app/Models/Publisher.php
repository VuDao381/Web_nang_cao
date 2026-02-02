<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'slug',
    ];
    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
