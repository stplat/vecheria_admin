<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'product';
  protected $primaryKey = 'product_id';

  public function categories()
  {
    return $this->belongsToMany(Category::class, 'product_to_category', 'product_id', 'category_id', 'product_id', 'category_id');
  }
}
