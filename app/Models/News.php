<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    //Menyatakan bahwa model ini berhubungan dengan tabel students di database.
    protected $table = "news";

    // mass assigntment field
    protected $fillable = ['id', 'title', 'author', 'description', 'content', 'url', 'url_image', 'published_at', 'category'];
}
