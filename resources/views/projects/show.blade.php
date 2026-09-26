@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <section style="
        max-width: 800px;
        min-height: 500px;
        margin: 40px auto;
        padding: 0 20px;
    ">
        <article style="
            padding: 28px;
            background-color: white;
            border: 1px solid #dddddd;
            border-radius: 8px;
        ">
            <h1 style="margin-top: 0;">
                {{ $project->title }}
            </h1>

            <p style="color: #6b7280; font-size: 14px;">
                Dibuat pada
                {{ $project->created_at->format('d-m-Y H:i') }}
            </p>

            <div style="margin-top: 24px; line-height: 1.8;">
                {!! nl2br(e($project->description)) !!}
            </div>

            <div style="
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-top: 30px;
            ">
                <a
                    href="{{ route('projects.index') }}"
                    style="
                        display: inline-block;
                        padding: 10px 16px;
                        color: #374151;
                        background-color: #e5e7eb;
                        border-radius: 6px;
                        text-decoration: none;
                    "
                >
                    Kembali
                </a>

                <a
                    href="{{ route('projects.edit', $project->id) }}"
                    style="
                        display: inline-block;
                        padding: 10px 16px;
                        color: white;
                        background-color: #2563eb;
                        border-radius: 6px;
                        text-decoration: none;
                    "
                >
                    Edit Project
                </a>

                <a
                    href="{{ route('projects.create') }}"
                    style="
                        display: inline-block;
                        padding: 10px 16px;
                        color: #2563eb;
                        background-color: #dbeafe;
                        border-radius: 6px;
                        text-decoration: none;
                    "
                >
                    Tambah Project
                </a>

                <form
                    action="{{ route('projects.destroy', $project->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus project ini?')"
                    style="margin: 0;"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        style="
                            padding: 10px 16px;
                            color: white;
                            background-color: #dc2626;
                            border: none;
                            border-radius: 6px;
                            cursor: pointer;
                        "
                    >
                        Hapus Project
                    </button>
                </form>
            </div>
        </article>
    </section>
@endsection