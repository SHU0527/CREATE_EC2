@extends('layouts.app')
@section('content')

<table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>ユーザー名</th>
<th>回答数</th>
<th>いいねされた数</th>
</tr>
<tr>
<td>{{ $user_name }}</td>
<td>{{ $answered_count }}</td>
<td>{{ $favorite_count}}</td>
</tr>
</table>

<table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>回答した質問の詳細URL</th>
</tr>
@for ($i = 0; $i < $ans_before_count; $i++)
<tr>
<td><a href="{{ $ans_before[$i] }}">{{ $ans_before[$i] }}</a></td>
</tr>
@endfor
</table>

@endsection