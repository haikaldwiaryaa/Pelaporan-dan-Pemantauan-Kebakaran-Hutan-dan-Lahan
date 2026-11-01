<div style="margin-bottom: 1rem;">
    <label for="area">Wilayah:</label><br>
    <select id="area" name="area" style="padding: 0.5rem;">
        <option value="">-- Pilih Wilayah --</option>
        @foreach ($areas as $area)
            <option value="{{ $area }}" {{ old('area', $report->area ?? '') == $area ? 'selected' : '' }}>{{ $area }}</option>
        @endforeach
    </select>
    @error('area')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 1rem;">
    <label for="location_detail">Patokan lokasi (boleh kosong):</label><br>
    <input type="text" id="location_detail" name="location_detail"
        value="{{ old('location_detail', $report->location_detail ?? '') }}" style="width: 100%; padding: 0.5rem;">
    @error('location_detail')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 1rem;">
    <label for="latitude">Latitude (-11 sampai 6):</label><br>
    <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $report->latitude ?? '') }}"
        style="padding: 0.5rem;">
    @error('latitude')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 1rem;">
    <label for="longitude">Longitude (95 sampai 141):</label><br>
    <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $report->longitude ?? '') }}"
        style="padding: 0.5rem;">
    @error('longitude')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 1rem;">
    <label for="incident_at">Waktu kejadian:</label><br>
    <input type="datetime-local" id="incident_at" name="incident_at"
        value="{{ old('incident_at', isset($report) ? $report->incident_at->format('Y-m-d\TH:i') : '') }}"
        style="padding: 0.5rem;">
    @error('incident_at')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 1rem;">
    <label for="condition_level">Tingkat kondisi:</label><br>
    <select id="condition_level" name="condition_level" style="padding: 0.5rem;">
        <option value="">-- Pilih Kondisi --</option>
        @foreach ($conditionLevels as $level)
            <option value="{{ $level }}" {{ old('condition_level', $report->condition_level ?? '') == $level ? 'selected' : '' }}>{{ $level }}</option>
        @endforeach
    </select>
    @error('condition_level')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 1rem;">
    <label for="description">Kondisi yang dilihat (min 10 karakter):</label><br>
    <textarea id="description" name="description" rows="3"
        style="width: 100%; padding: 0.5rem;">{{ old('description', $report->description ?? '') }}</textarea>
    @error('description')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 1rem;">
    <label for="evidence">Bukti (JPG, PNG, atau PDF, maks 2 MB, boleh kosong):</label><br>
    <input type="file" id="evidence" name="evidence" accept=".jpg,.jpeg,.png,.pdf">
    @error('evidence')
        <p class="error">{{ $message }}</p>
    @enderror
    @if (isset($report) && $report->evidence_path)
        <p>Bukti saat ini: <a href="{{ asset('storage/' . $report->evidence_path) }}" target="_blank">Lihat bukti</a></p>
    @endif
</div>