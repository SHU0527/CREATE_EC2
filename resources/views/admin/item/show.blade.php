<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品一覧</title>
</head>
<body>
@extends('layouts.app')
@section('content')
<h1>商品詳細</h1>
<a href="{{ route('items.edit', ['id' => $item->id]) }}">商品を編集する</a>
 <table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫の有無</th>
<tr>
<td>{{$item->name}}</td>
<td>{{$item->description}}</td>
<td>{{$item->price}}</td>
<td>{{$item->stocks}}</td>
</tr>
@endsection
</table>
</body>
</html>
