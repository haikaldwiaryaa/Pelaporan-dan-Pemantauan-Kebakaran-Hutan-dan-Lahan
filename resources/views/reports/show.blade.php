@extends('layouts.app')

@section('content')
    <a href="{{ route('reports.index') }}">&larr; Daftar Laporan</a>
    <h2>Detail Laporan #{{ $report->id }}</h2>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (Auth::user()->role === 'pelapor')
        <p><a href="{{ route('reports.edit', $report) }}">Ubah Laporan</a></p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th style="width: 30%; text-align: left;">Status</th>
            <td><strong>{{ $report->status }}</strong></td>
        </tr>
        <tr>
            <th style="text-align: left;">Pelapor</th>
            <td>{{ $report->user->name }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Wilayah</th>
            <td>{{ $report->area }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Patokan lokasi</th>
            <td>{{ $report->location_detail ?? '-' }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Latitude</th>
            <td>{{ $report->latitude }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Longitude</th>
            <td>{{ $report->longitude }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Waktu kejadian</th>
            <td>{{ $report->incident_at->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Tingkat kondisi</th>
            <td>{{ $report->condition_level }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Kondisi yang dilihat</th>
            <td>{{ $report->description }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Bukti</th>
            <td>
                @if ($report->evidence_path)
                    <a href="{{ asset('storage/' . $report->evidence_path) }}" target="_blank">Lihat bukti</a>
                @else
                    Tidak ada bukti
                @endif
            </td>
        </tr>
    </table>
    <h3 style="margin-top: 1.5rem;">Catatan Peninjauan</h3>
    <ul>
        @forelse ($report->reviewNotes as $note)
            <li>
                {{ $note->created_at->format('d-m-Y H:i') }} - {{ $note->user->name }}:
                {{ $note->note }}
            </li>
        @empty
            <li>Belum ada catatan.</li>
        @endforelse
    </ul>
    @if (Auth::user()->role === 'relawan')
        <form action="{{ route('reports.review', $report) }}" method="POST" style="margin-bottom: 1rem;">
            @csrf
            <label for="note">Tambah catatan:</label><br>
            <textarea id="note" name="note" rows="3" style="width: 100%; padding: 0.5rem;">{{ old('note') }}</textarea>
            @error('note')
                <p class="error">{{ $message }}</p>
            @enderror
            <div style="margin: 0.5rem 0;">
                <label for="status">Ubah status:</label>
                <select id="status" name="status" style="padding: 0.3rem;">
                    <option value="">-- Tidak diubah --</option>
                    <option value="ditinjau" {{ old('status') == 'ditinjau' ? 'selected' : '' }}>ditinjau</option>
                    <option value="perlu_diteruskan" {{ old('status') == 'perlu_diteruskan' ? 'selected' : '' }}>perlu_diteruskan
                    </option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>selesai</option>
                </select>
                @error('status')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit">Simpan Catatan</button>
        </form>
    @endif
    <h3>Riwayat Penerusan</h3>
    <ul>
        @forelse ($report->forwardings as $forwarding)
            <li>
                {{ $forwarding->forwarded_at->format('d-m-Y H:i') }} - diteruskan ke
                {{ $forwarding->externalParty->name }}
                oleh {{ $forwarding->user->name }}
                @if ($forwarding->note)
                    ({{ $forwarding->note }})
                @endif
            </li>
        @empty
            <li>Belum pernah diteruskan.</li>
        @endforelse
    </ul>
@endsection