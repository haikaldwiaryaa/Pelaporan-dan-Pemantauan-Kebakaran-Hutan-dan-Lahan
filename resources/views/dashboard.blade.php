@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>
    <p>Selamat datang, {{ Auth::user()->name }}.</p>
    <p>Username: {{ Auth::user()->username }} | Role: <strong>{{ Auth::user()->role }}</strong></p>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <p><a href="{{ route('reports.index') }}">Daftar Laporan</a></p>
    @if (Auth::user()->role === 'pelapor')
        <p><a href="{{ route('reports.create') }}">+ Buat Laporan</a></p>
    @endif
    @if (Auth::user()->role === 'koordinator')
        <p><a href="{{ route('external-parties.index') }}">Pihak Terkait</a></p>
    @endif
@endsection