<?php
$now_route = \Route::currentRouteName();
//ログイン者の属性条件選択の例
//ルート名からガード選択
$loginName = '';
if (strpos($now_route, 'admin') === false) {
	    $loginName = Auth::guard('user')->user()->name;
} elseif (strpos($now_route, 'admin') !== false) {
	    $loginName = Auth::guard('admin')->user()->name;
}
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>
					{{ $loginName . 'さん' }}
				</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
					@endif
					@if (!empty(Auth::guard('user')->user()) && strpos($now_route, 'admin') === false)
						<a href="{{ route('user.index') }}">購入商品情報ページへ</a>
					@endif
                    You are logged in!
				</div>
        </div>
    </div>
</div>
@endsection
