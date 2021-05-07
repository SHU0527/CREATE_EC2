@extends('layouts.app')
@section('content')
<h1>新規商品登録画面</h1>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{{ Form::open(['route' => 'admin.items.store', 'enctype' => 'multipart/form-data']) }}
<p>商品名<br/>{{ Form::text('name', old('name'), ['size' => 50, 'placeholder' => '商品名を入力してください']) }}</p>
<p>商品説明<br/>{{ Form::text('description', old('description'), ['size' => '50', 'placeholder' => '商品内容を入力してください']) }}</p>
<p>値段<br/>{{ Form::text('price', old('price'), ['size' => '50', 'placeholder' => '値段を入力してください']) }}</p>
<p>在庫数<br/>{{ Form::text('stocks', old('stocks'), ['size' => '50', 'placeholder' => '在庫数を入力してください']) }}</p>
<p>登録商品画像ファイル</br>{{ Form::file("image_name") }}</p>
<div>
{{ Form::reset('リセット', ['class' => 'btn btn-outline-success btn-lg']) }}
{{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
</div>
{{ Form::close() }}
<a href="{{ route('admin.items.index')}}">商品一覧へ戻る</a>
@endsection