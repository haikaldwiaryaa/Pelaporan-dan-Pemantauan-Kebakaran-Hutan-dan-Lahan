@extends('layouts.app')

@section('content')
    <a href="{{ route('dashboard') }}">&larr; Kembali</a>
    <h2>Buat Laporan</h2>

    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('reports._form')
        <button type="submit">Kirim Laporan</button>
    </form>
@endsection