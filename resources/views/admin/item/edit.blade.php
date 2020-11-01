@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{{ Form::model($item, ['route' => ['items.update', $item->id], 'method' => 'put']) }}
<p>商品名<br />{{ Form::text('name', $item->name) }}</p>
<p>商品説明<br />{{ Form::text('description', $item->description) }}</p>
<p>在庫数<br />{{ Form::number('stocks', $item->stocks) }}</p>
<div>
    {{ Form::reset('リセット', ['class' => 'btn btn-outline-success btn-lg']) }}
    {{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
</div>
{{ Form::close() }}
