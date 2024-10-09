<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name', 'description', 'price', 'category_id'];

    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship to categories (many-to-many)
    public function categories()
    {
        return $this->belongsToMany(Category::class);
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

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }
}
