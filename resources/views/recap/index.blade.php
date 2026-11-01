@extends('layouts.app')

@section('content')
    <a href="{{ route('dashboard') }}">&larr; Dashboard</a>
    <h2>Rekap Laporan</h2>

    <form method="GET" action="{{ route('recap.index') }}" style="margin-bottom: 1rem;">
        <label for="area">Wilayah:</label>
        <select id="area" name="area" style="padding: 0.3rem;">
            <option value="">Semua</option>
            @foreach ($areaOptions as $item)
                <option value="{{ $item }}" {{ $area == $item ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
        <a href="{{ route('recap.index') }}" style="margin-left: 0.5rem;">Reset</a>
        @error('area')
            <p class="error">{{ $message }}</p>
        @enderror
    </form>

    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
        <div style="flex: 1; border: 1px solid #e2e8f0; border-radius: 6px; padding: 1rem;">
            <p style="margin: 0;">Total laporan</p>
            <p style="margin: 0; font-size: 1.5rem;"><strong>{{ $total }}</strong></p>
        </div>
        <div style="flex: 1; border: 1px solid #e2e8f0; border-radius: 6px; padding: 1rem;">
            <p style="margin: 0;">Laporan aktif</p>
            <p style="margin: 0; font-size: 1.5rem;"><strong>{{ $active }}</strong></p>
        </div>
        <div style="flex: 1; border: 1px solid #e2e8f0; border-radius: 6px; padding: 1rem;">
            <p style="margin: 0;">Laporan selesai</p>
            <p style="margin: 0; font-size: 1.5rem;"><strong>{{ $done }}</strong></p>
        </div>
    </div>

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Wilayah</th>
                @foreach ($statuses as $status)
                    <th>{{ $status }}</th>
                @endforeach
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row['area'] }}</td>
                    @foreach ($statuses as $status)
                        <td>{{ $row[$status] }}</td>
                    @endforeach
                    <td>{{ $row['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection