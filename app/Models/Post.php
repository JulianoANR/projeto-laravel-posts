<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    //essa linha n é sempre necessaria, ela relaciona manualmante esse model a table post no sql
    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'image'];
}
