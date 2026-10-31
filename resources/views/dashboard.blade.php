@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>
    <p>Selamat datang, {{ Auth::user()->name }}.</p>
    <p>Username: {{ Auth::user()->username }} | Role: <strong>{{ Auth::user()->role }}</strong></p>
@endsection