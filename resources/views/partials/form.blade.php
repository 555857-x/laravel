{{-- Field form dipakai bersama oleh create dan edit. $project kosong saat create. --}}
@php
    $project = $project ?? null;
@endphp

<div class="mb-3">
    <label for="title" class="form-label fw-bold">Judul Project</label>
    <input
        type="text"
        id="title"
        name="title"
        maxlength="200"
        value="{{ old('title', $project?->title) }}"
        placeholder="Masukkan judul project"
        class="form-control @error('title') is-invalid @enderror"
    >
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label fw-bold">Deskripsi Project</label>
    <textarea
        id="description"
        name="description"
        rows="6"
        placeholder="Masukkan deskripsi project"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $project?->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="status" class="form-label fw-bold">Status</label>
        <select
            id="status"
            name="status"
            class="form-select @error('status') is-invalid @enderror"
        >
            @foreach (['draft' => 'Draft', 'published' => 'Published'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $project?->status ?? 'draft') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        {{-- Datepicker bawaan browser; nilai terkirim dalam format database Y-m-d. --}}
        <label for="started_at" class="form-label fw-bold">Tanggal Mulai</label>
        <input
            type="date"
            id="started_at"
            name="started_at"
            value="{{ old('started_at', $project?->started_at?->format('Y-m-d')) }}"
            class="form-control @error('started_at') is-invalid @enderror"
        >
        @error('started_at')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="budget" class="form-label fw-bold">Anggaran (Rp)</label>
        <input
            type="number"
            id="budget"
            name="budget"
            min="0"
            value="{{ old('budget', $project?->budget) }}"
            placeholder="contoh: 1500000"
            class="form-control @error('budget') is-invalid @enderror"
        >
        @error('budget')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
