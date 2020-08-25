<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\ProductService;
use App\Http\Requests\Admin\ProductStore;

use App\Models\Product;

class ProductController extends Controller
{
  protected $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
//    dd($this->productService->getProducts()->toArray());
    return view('admin/product')->with([
      'products' => $this->productService->getProducts(),
      'categories' => $this->productService->getCategories()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin/product-create')->with([
      'categories' => $this->productService->getCategories()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \App\Http\Requests\Admin\ProductStore
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   */
  public function store(ProductStore $request)
  {
    Product::create([
      'name' => $request->input('name'),
      'slug' => 'blalbla',
      'category_id' => '1',
      'manufacturer' => $request->input('manufacturer'),
      'article' => $request->input('article'),
      'meta_keywords' => $request->input('meta_keywords'),
      'meta_description' => $request->input('meta_description'),
      'meta_title' => $request->input('meta_title'),
      'available' => $request->input('available'),
      'weight' => $request->input('weight'),
      'price' => $request->input('price'),
      'dimension' => $request->input('dimension'),
      'comment' => $request->input('comment'),
      'material' => $request->input('material'),
      'technic' => $request->input('technic'),
      'description' => $request->input('description'),
      'video' => $request->input('video'),
      'image_path' => $request->input('image_path'),
      'similar_product_id' => implode(';', $request->input('similar_product_id')),
    ])->categories()->attach($request->input('category_id'));

    return $this->productService->getProducts();
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
