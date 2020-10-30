@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{{ Form::open(['route' => 'items.store']) }}
<p>商品名<br />{{ Form::text('name') }}</p>
<p>商品説明<br />{{ Form::text('description', '', ['size' => 50]) }}</p>
<p>値段<br />{{ Form::number('price') }}</p>
<p>在庫数<br />{{ Form::number('stocks') }}</p>
<div>
    {{ Form::reset('リセット', ['class' => 'btn btn-outline-success btn-lg']) }}
    {{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
</div>
{{ Form::close() }}
