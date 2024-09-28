<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'body',
        'views'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category():HasMany{
        return $this->belongsTo(Category::class);
    }
}
