@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
    <section style="
        max-width: 700px;
        min-height: 500px;
        margin: 40px auto;
        padding: 0 20px;
    ">
        <h1>Edit Project</h1>

        <p style="color: #6b7280;">
            Ubah judul atau deskripsi project.
        </p>

        @if ($errors->any())
            <div style="
                padding: 14px 16px;
                margin-bottom: 20px;
                color: #991b1b;
                background-color: #fee2e2;
                border: 1px solid #fca5a5;
                border-radius: 6px;
            ">
                <strong>Data belum dapat disimpan.</strong>

                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('projects.update', $project->id) }}"
            method="POST"
            style="
                padding: 24px;
                background-color: white;
                border: 1px solid #dddddd;
                border-radius: 8px;
            "
        >
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label
                    for="title"
                    style="display: block; margin-bottom: 8px; font-weight: bold;"
                >
                    Judul Project
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    maxlength="200"
                    value="{{ old('title', $project->title) }}"
                    style="
                        width: 100%;
                        padding: 11px 12px;
                        border: 1px solid #cccccc;
                        border-radius: 6px;
                        box-sizing: border-box;
                    "
                >

                @error('title')
                    <small style="display: block; margin-top: 6px; color: #dc2626;">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label
                    for="description"
                    style="display: block; margin-bottom: 8px; font-weight: bold;"
                >
                    Deskripsi Project
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="7"
                    style="
                        width: 100%;
                        padding: 11px 12px;
                        border: 1px solid #cccccc;
                        border-radius: 6px;
                        box-sizing: border-box;
                        resize: vertical;
                    "
                >{{ old('description', $project->description) }}</textarea>

                @error('description')
                    <small style="display: block; margin-top: 6px; color: #dc2626;">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <button
                type="submit"
                style="
                    padding: 10px 16px;
                    color: white;
                    background-color: #2563eb;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;
                "
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('projects.show', $project->id) }}"
                style="
                    display: inline-block;
                    margin-left: 8px;
                    padding: 10px 16px;
                    color: #374151;
                    background-color: #e5e7eb;
                    border-radius: 6px;
                    text-decoration: none;
                "
            >
                Batal
            </a>
        </form>
    </section>
@endsection