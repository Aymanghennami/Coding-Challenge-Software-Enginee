<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
       // Getters
       public function getId():int {
        return $this->attributes['id'];
    }
       public function getName(): string
       {
           return $this->attributes['name'];
       }
   
       public function getDescription(): string
       {
           return $this->attributes['description'];
       }
   
       public function getPrice(): float
       {
           return (float)$this->attributes['price'];
       }
   
       public function getImage(): ?string
       {
           return $this->attributes['image'];
       }
    
}
