@extends('layouts.app')
@section('content')
@if ($search_words)
{{ $search_words[0]->text }}
@else
そのキーワードが含まれるツイートが見つかりません
@endif
@endsection
