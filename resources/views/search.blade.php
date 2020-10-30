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
<form action="{{ route('search.word') }}" method="post">
{{ csrf_field() }}
<input type="text" name="word">
<input type="submit" value="ツイートを検索">
</form>

@endsection
