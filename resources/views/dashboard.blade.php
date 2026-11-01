@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>
    <p>Selamat datang, {{ Auth::user()->name }}.</p>
    <p>Username: {{ Auth::user()->username }} | Role: <strong>{{ Auth::user()->role }}</strong></p>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (Auth::user()->role === 'pelapor')
        <p><a href="{{ route('reports.create') }}">+ Buat Laporan</a></p>
    @endif
@endsection