@extends('layouts.app')

@section('content')
    <a href="{{ route('dashboard') }}">&larr; Dashboard</a>
    <h2>Daftar Laporan</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (Auth::user()->role === 'pelapor')
        <p><a href="{{ route('reports.create') }}">+ Buat Laporan</a></p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Wilayah</th>
                <th>Waktu Kejadian</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th>Pelapor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->area }}</td>
                    <td>{{ $report->incident_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $report->condition_level }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td><a href="{{ route('reports.show', $report) }}">Detail</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada laporan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1rem;">
        {{ $reports->links() }}
    </div>
@endsection