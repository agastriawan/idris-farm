<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = [
        'user_id',
        'isi',
        'judul',
        'image',
        'slug',
        'tags',
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


