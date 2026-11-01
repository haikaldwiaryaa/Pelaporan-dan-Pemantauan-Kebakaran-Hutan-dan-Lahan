@extends('layouts.app')

@section('content')
    <a href="{{ route('reports.show', $report) }}">&larr; Kembali ke Detail</a>
    <h2>Ubah Laporan #{{ $report->id }}</h2>
    @error('status')
        <p class="error">{{ $message }}</p>
    @enderror

    <form action="{{ route('reports.update', $report) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('reports._form')
        <button type="submit">Simpan Perubahan</button>
    </form>
@endsection