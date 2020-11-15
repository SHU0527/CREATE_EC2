@extends('layouts.app')
@section('content')
<div class="container">
<div class="page-header" style="margin-top:-30px;padding-bottom:0px;">
<body>
@if (0 < $carts->count())
	</div>
	<table class="table table-striped table-hover table-centered">
	<h1>カート内容</h1>
	<tr style="background-color:#e3f0fb">
	<th>商品名</th>
	<th>購入数</th>
	<th>価格</th>
	<th>削除</th>
	</tr>
@foreach ($carts as $cart)
<tr style="background-color:#f5f5f5">
<td>{{ $cart->item->name }}</td>
<td>{{ $cart->quantity }}</td>
<td>{{ $cart->item->price }}</td>
<td>
<form method="POST" action="{{ route('carts.destroy', ['id' => $cart->id]) }}">
{{ csrf_field() }}
{{ method_field('DELETE') }}
<button type="submit">削除</button>
</form>
</td>
</tr>
@endforeach
</table>
@else
<div style="padding:100px">
<h1 style="color:lightgray;text-align:center;">カートが空です</h1>
</div>
@endif
<br>
<h2><a href="{{ route('user.index') }}">商品一覧へ戻る</a></h2>
</body>
@endsection
