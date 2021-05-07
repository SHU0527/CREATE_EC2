<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品詳細</title>
</head>
<body>
@extends('layouts.app')
@section('content')
<h1>商品詳細画面</h1>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<a href="{{ route('admin.items.edit', ['id' => $item->id]) }}">商品を編集する</a>
 <table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫の有無</th>
<th>商品画像</th>
<tr>
<td>{{$item->name}}</td>
<td>{{$item->description}}</td>
<td>{{$item->price}}</td>
<td>{{$item->stocks}}</td>
@if (!empty($item->image_name))
<td><img src="{{ asset('/storage/img/' . $item->image_name) }}" width="150" height="150"></td>
@else
<td>画像未登録</td>
@endif
</tr>
</table>
<a href="{{ route('admin.items.index')}}">商品一覧へ戻る</a>
@endsection

