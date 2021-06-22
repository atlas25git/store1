@extends('layouts.app')

@section('content')
    <h2>Atlas25</h2>

    {{dd(\Cart::session(auth()->id())->getContent())}}
@endsection