@extends('layouts.app')
@section('content')
@if (0 < $shipping_target->count())
現在設定されているお届け先
<table border="1">
<tr style="background-color:yellow">    
<th>名前</th>
<th>郵便番号</th>
<th>住所</th>
<th>電話番号</th>
</tr>
<tr>
<td>{{ $shipping_target->shipping_name }}</td>
<td>{{ $shipping_target->post_number }}</td>
<td>{{ $shipping_target->prefectures . $shipping_target->address1 . $shipping_target->address2 }}</td>
<td>{{ $shipping_target->phone_number }}</td>
@else
お届け先住所は現在設定されていません
@endif
@endsection
