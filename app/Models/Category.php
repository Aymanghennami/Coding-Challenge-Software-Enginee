<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name', 'parent_id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship to products (many-to-many)
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // Relationship to parent category (self-referencing)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relationship to child categories (self-referencing)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Getters
    public function getId(): int
    {
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
    public function getDescription(): ?string
    {
        return $this->attributes['description'] ?? null; // Ensure null return if no description
    }
}
