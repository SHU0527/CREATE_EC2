@extends('layouts.app')
@section('title', '商品の一覧(管理者用)')
@section('content')
<div class="container">
<div class="page-header" style="margin-top:-30px;padding-bottom:0px;">
<h1><small>商品の一覧 (<span style="color:red">管理者用</span>)</small></h1>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
<a href="{{ route('admin.items.create') }}">商品を登録する</a>
</div>
<table class="table table-striped table-hover table-centered">
<tr>
<th>商品名</th>
<th>値段</th>
<th>在庫の有無</th>
<th>商品画像</th>
</tr>
@foreach ($items as $item)
<tr>
<td>
<a href="{{ route('admin.items.show', ['id' => $item->id]) }}">{{ $item->name }}</a>
</td>
<td>¥{{ number_format($item->price) }} -</td>
@if ($item->stocks > 0)
	<td style="color:blue">在庫あり</td>
@else
	<td style="color:red">在庫なし</td>
@endif
</td>
@if (!empty($item->image_name))
<td><img src="{{ asset('/storage/img/' . $item->image_name) }}" width="150" height="150"></td>
@else
<td>画像未登録</td>
@endif
</tr>
@endforeach
</div>
@endsection

