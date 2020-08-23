@extends('admin.layouts.app', ['title' => 'Продукция'])
@section('content')
  <product :products="{{ $products }}"></product>
@endsection
