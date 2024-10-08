<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model

{
    use HasFactory;


    protected $guarded = ['id','created_at', 'updated_at' ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    // Getters
    public function getId():int {
        return $this->attributes['id'];
    }
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getParentId(): ?int
    {
        return $this->attributes['parent_id'];
    }
}
