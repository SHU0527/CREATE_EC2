@extends('layouts.app')
@section('content')
<div class="container">
<div class="page-header" style="margin-top:-30px;padding-bottom:0px;">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<body>
<h3>お届け先住所編集画面</h3>
<form method="post" action="{{ route('shipping.edit', ['id' => $edit_shipping_info->id]) }}">
        {{ csrf_field() }}
        <div><label>送り先名:</label> <input type="text" name="shipping_name" value="{{ $edit_shipping_info->shipping_name }}"></div>
        <div><label>郵便番号:</label> <input type="text" name="post_number" value="{{ $edit_shipping_info->post_number }}"></div>
        <div><label>都道府県:</label> <input type="text" name="prefectures" value="{{ $edit_shipping_info->prefectures }}"></div>
        <div><label>市区町村:</label> <input type="text" name="address1" value="{{ $edit_shipping_info->address1 }}"></div>
        <div><label>番地以降の住所:</label> <input type="text" name="address2" value="{{ $edit_shipping_info->address2 }}"></div>
        <div><label>電話番号:</label> <input type="text" name="phone_number" value="{{ $edit_shipping_info->phone_number }}"></div>
        <div><button type="submit">編集する</button></div>
    </form>
    @if (session('flash_message'))
    <div class="flash_message bg-success text-center py-3 my-0">
    {{ session('flash_message') }}
    </div>
@endif
</body>
@endsection
