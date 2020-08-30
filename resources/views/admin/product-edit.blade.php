@extends('admin.layouts.app', ['title' => 'Редактирование товара'])
@section('content')
  <product-edit :categories="{{ $categories }}" :product="{{ $product }}"></product-edit>
@endsection
