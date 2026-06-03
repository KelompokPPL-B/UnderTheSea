@extends('layouts.app')

@section('content')
    @if(auth()->check() && auth()->user()->isAdmin())
        @include('ikan.index-admin')
    @else
        @include('ikan.index-user')
    @endif
@endsection