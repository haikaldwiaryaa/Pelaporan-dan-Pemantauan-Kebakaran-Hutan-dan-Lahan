@extends('layouts.app')

@section('content')
    <a href="{{ route('external-parties.index') }}">&larr; Pihak Terkait</a>
    <h2>Ubah Pihak Terkait</h2>

    <form action="{{ route('external-parties.update', $externalParty) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 0.5rem;">
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $externalParty->name) }}"
                style="width: 100%; padding: 0.5rem;">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div style="margin-bottom: 0.5rem;">
            <label for="contact">Kontak (boleh kosong):</label><br>
            <input type="text" id="contact" name="contact" value="{{ old('contact', $externalParty->contact) }}"
                style="padding: 0.5rem;">
            @error('contact')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>
@endsection