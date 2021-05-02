@extends('layouts.app')
@section('content')

@for($i = 0; $i < count($texts); $i++)
  <p>{{ $texts[$i] }}</p>
@endfor

@endsection
