@extends('layouts.app')
@section('content')
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<h1>会員詳細ページ</h1>
<table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>会員者名</th>
<th>メールアドレス</th>
</tr>
<tr>
<td>{{ $user_info->name }}</td>
<td>{{ $user_info->email }}</td>
</tr>
</table>
@if (!$members_detail->count())
現在、お届け先住所の登録はありません
@else
<table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>お届け先住所</th>
</tr>
@foreach ($members_detail as $member_detail)
<tr>
<td>
{{ $member_detail->post_number . $member_detail->prefectures . $member_detail->address1 . $member_detail->address2 }}
</td>
</tr>
@endforeach
@endif
</table>
@endsection
