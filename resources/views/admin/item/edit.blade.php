@extends('layouts.app')
@section('content')
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
{{ Form::model($item, ['route' => ['admin.items.update', $item->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) }}
<p>商品名<br />{{ Form::text('name', old('name', $item->name)) }}</p>
<p>商品説明<br />{{ Form::text('description', old('description', $item->description)) }}</p>
<p>在庫数<br />{{ Form::number('stocks', old('stocks', $item->stocks)) }}</p>
<p>{{ Form::file("image_name") }}</p>
<div>
    {{ Form::submit('編集する', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
</div>
{{ Form::close() }}
<a href="{{ route('admin.items.index')}}">商品一覧へ戻る</a>
@endsection
