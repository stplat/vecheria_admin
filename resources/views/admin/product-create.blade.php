@extends('admin.layouts.app', ['title' => 'Создание товара'])
@section('content')
  <product-create :categories="{{ $categories }}"></product-create>
@endsection
