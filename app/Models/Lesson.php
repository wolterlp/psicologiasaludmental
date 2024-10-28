<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['name', 'description', 'content_uri', 'pdf_uri', 'level_id', 'is_free'];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_lesson');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
