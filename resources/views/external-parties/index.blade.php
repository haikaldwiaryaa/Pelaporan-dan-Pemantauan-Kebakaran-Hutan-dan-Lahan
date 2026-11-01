@extends('layouts.app')

@section('content')
    <a href="{{ route('dashboard') }}">&larr; Dashboard</a>
    <h2>Pihak Terkait</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($parties as $party)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $party->name }}</td>
                    <td>{{ $party->contact ?? '-' }}</td>
                    <td><a href="{{ route('external-parties.edit', $party) }}">Ubah</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada pihak terkait.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3 style="margin-top: 1.5rem;">Tambah Pihak Terkait</h3>
    <form action="{{ route('external-parties.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 0.5rem;">
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 100%; padding: 0.5rem;">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div style="margin-bottom: 0.5rem;">
            <label for="contact">Kontak (boleh kosong):</label><br>
            <input type="text" id="contact" name="contact" value="{{ old('contact') }}" style="padding: 0.5rem;">
            @error('contact')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection