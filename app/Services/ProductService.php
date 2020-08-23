<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

  /**
   * Получаем товары (или товар)
   *
   * @param int $id
   *
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   * @return \Illuminate\Support\Collection
   */
  public function getProduct($id = null)
  {
    return $id
      ? Product::with('categories')->find($id)
      : Product::with('categories')->get();
  }
}
