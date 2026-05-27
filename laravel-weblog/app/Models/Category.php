<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function getCategories()
    {
        return self::orderBy('name')->get();
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    protected $fillable = ['name'];
}
