@extends('layouts.app')
@section('content')
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
@endsection
