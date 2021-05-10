@extends('layouts.app')
@section('content')
ログイン後のページにある商品購入ページへのリンク: <a href="{{ $items_link }}">{{ $items_link }}</a><br>
ログイン後のページに表示されるユーザー名:{{ $user_name }}
@endsection