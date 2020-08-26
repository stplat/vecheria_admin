<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

  /**
   * Сохраняем фото и возвращаем названия
   *
   * @param $name string
   * @return boolean
   */
  public function storeImage($name)
  {
    $path = [];

    foreach (request('file') as $key => $file) {
      $name = $key > 0 ? $name . '_' . ($key + 1) : $name;
      $temp = Storage::disk('local')->putFile('public/images/items', $file);

      $this->resizeImage($temp, $name, 'medium', null, 380);
      $this->resizeImage($temp, $name, 'small', null, 120);
      $this->resizeImage($temp, $name, 'thumb', 78, 78);
      $resultPath = $this->resizeImage($temp, $name);

      Storage::delete($temp);
      array_push($path, $resultPath);
    }

    return implode(';', $path);
  }

  /**
   * Обрезаем фотографии и добавляем формат-webp
   *
   * @param $img string
   * @param $name string
   * @param $salt string
   * @param $width int
   * @param $height int
   *
   * @return string
   */
  public function resizeImage($img, $name, $salt = '', $width = null, $height = null)
  {
    $img = Image::make(Storage::path($img));
    $extension = $img->extension;
    $salt = $salt ? '-' . $salt : '';
    $path = Storage::path("public/images/items/$name$salt.");

    if ($width || $height) {
      $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      });
    }

    $img->save($path . $extension);

    $img = $extension == 'png'
      ? imagecreatefrompng($path . $extension)
      : imagecreatefromjpeg($path . $extension);
    imagewebp($img, $path . 'webp', 100);

    return "storage/images/items/$name.$extension";
  }
}
