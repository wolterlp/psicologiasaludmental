<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLesson extends Model
{
    use HasFactory;
    protected $table = 'category_lesson'; 

    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'lesson_id',
    ];
}
