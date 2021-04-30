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
<form action="{{ route('profile.edit') }}" method="post">
{{ csrf_field() }}
<p>ユーザー名<input type="text" name="user_name" value="{{ old('user_name', $edit_user_info->name)}}"></p>
<p>メールアドレス<input type="email" name="email" value="{{ old('email', $edit_user_info->email) }}"></p>
<p>新しいパスワード<input type="password" name="new_password"></p>
<p>新しいパスワード（確認用)<input type="password" name="new_password_confirmation"></p>
<p>現在のパスワード<input type="password" name="current_password"></p>
<p><input type="submit" value="アカウント情報を変更する"></p>
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
</form>
@if (session('flash_message'))
	<div class="flash_message bg-success text-center py-3 my-0">
	{{ session('flash_message') }}
	</div>
@endif
@endsection
