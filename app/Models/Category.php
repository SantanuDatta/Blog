<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_parent',
        'is_featured',
        'status',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'is_parent');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
