@extends('layouts.app')
@section('content')
<h1>会員一覧ページ</h1>
<table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>会員者名</th>
</tr>
@foreach ($members as $member)
@if(!empty($member->user->name))
<tr>
<td><a href="{{ route('admin.detail', ['id' => $member->user_id]) }}">{{ $member->user->name }}</a></td>
</tr>
@endif
@endforeach
</table>
@if (session('flash_message'))
	<div class="flash_message bg-success text-center py-3 my-0">
	{{ session('flash_message') }}
	</div>
@endif
@endsection
