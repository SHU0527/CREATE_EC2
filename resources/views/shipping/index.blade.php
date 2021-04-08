@extends('layouts.app')
@section('content')
<div class="container">
<div class="page-header" style="margin-top:-30px;padding-bottom:0px;">
<body>
<h3>お届け先選択画面</h3>
    @if (0 < $shippings->count())
    <table border="1">
    <tr style="background-color:yellow">
    <th>◉</th>
    <th>お届け先</th>
    <th>名前</th>
    <th>郵便番号</th>
    <th>住所</th>
    <th>電話番号</th>
    <th>編集</th>
    <th>削除</th>
    </tr>
    @foreach ($shippings as $shipping)
    <tr>
    <td>
    @if ($shipping->id == $shipping_id)
    <input type="radio">
    @endif
    </td>
    <td align="center">
    <form method="post" action="{{ route('shipping.save') }}">
    {{ csrf_field() }}
    <input type="hidden" name="shipping_id" value="{{ $shipping->id }}">
    <button type="submit">選択</button>
    </form>
    </td>
    <td>{{ $shipping->shipping_name }}</td>
    <td>{{ $shipping->post_number }}</td>
    <td>{{ $shipping->prefectures . $shipping->address1 . $shipping->address2 }}</td>
    <td>{{ $shipping->phone_number }}</td>
    <td><a href="{{ route('edit.form', ['id' => $shipping->id]) }}">お届け先住所編集画面へ</a></td>
    <td>
    <form method="post" action="{{ route('shipping.delete') }}">
    {{ csrf_field() }}
    <input type="hidden" name="shipping_id" value="{{ $shipping->id }}">
    <button type="submit">削除</button>
    </form>
    </td>
    @endforeach
    </table>
@endif
@if (isset($shipping_target))
    @if (0 < $shipping_target->count())
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
@endif
<h4><a href="{{ route('create.form') }}">お届け先登録画面へ</a></h4>
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
</body>
@endsection
