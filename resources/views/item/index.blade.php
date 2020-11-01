<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品一覧</title>
</head>
<body>
@extends('layouts.app')
@section('content')
<h1>商品一覧</h1>
@if (Auth::check())
	<a href="{{ route('carts.index') }}">カートの中身を確認する</a>
@endif

 <table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>商品名</th>
<th>値段</th>
<th>在庫の有無</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href="{{ route('detail', ['id' => $item->id]) }}">{{$item->name}}</a></td>
<td>{{$item->price}}</td>
<td>
@if ($item->stocks >= 1)
在庫あり
@else
在庫なし
@endif
</td>
</tr>
@endforeach
@endsection
</table>
</body>
</html>
