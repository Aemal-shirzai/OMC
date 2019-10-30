@extends("layouts.MainLayout")
@section("title",Auth::user()->username)

@section("content")

    <h1>Welcome {{Auth::user()->username}}</h1>

@endsection