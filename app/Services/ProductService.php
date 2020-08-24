<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class ProductService
{

  /**
   * Получаем товар
   *
   * @param int $id
   *
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   * @return \Illuminate\Support\Collection
   */
  public function getProduct($id)
  {
    return Product::with('categories')->find($id);
  }

  /**
   * Получаем товары
   *
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   * @return \Illuminate\Support\Collection
   */
  public function getProducts()
  {
    return Product::with('categories')->get();
  }

  /**
   * Получаем категории
   *
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   * @return \Illuminate\Support\Collection
   */
  public function getCategories()
  {
    return Category::all();
  }
}
