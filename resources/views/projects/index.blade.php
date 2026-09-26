@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <section style="
        max-width: 900px;
        min-height: 500px;
        margin: 40px auto;
        padding: 0 20px;
    ">
        <div style="
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        ">
            <div>
                <h1 style="margin-bottom: 8px;">
                    Projects
                </h1>

                <p style="margin: 0; color: #6b7280;">
                    Beberapa project yang pernah saya kerjakan.
                </p>
            </div>

            <a
                href="{{ route('projects.create') }}"
                style="
                    display: inline-block;
                    padding: 10px 16px;
                    color: white;
                    background-color: #2563eb;
                    border-radius: 6px;
                    text-decoration: none;
                "
            >
                Tambah Project
            </a>
        </div>

        @if (session('success'))
            <div style="
                padding: 14px 16px;
                margin-bottom: 20px;
                color: #166534;
                background-color: #dcfce7;
                border: 1px solid #86efac;
                border-radius: 6px;
            ">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($projects as $project)
            <article style="
                padding: 22px;
                margin-bottom: 18px;
                background-color: white;
                border: 1px solid #dddddd;
                border-radius: 8px;
            ">
                <h2 style="margin-top: 0; margin-bottom: 8px;">
                    <a
                        href="{{ route('projects.show', $project->id) }}"
                        style="color: #2563eb; text-decoration: none;"
                    >
                        {{ $project->title }}
                    </a>
                </h2>

                <p style="
                    margin-top: 0;
                    color: #6b7280;
                    font-size: 14px;
                ">
                    Dibuat pada
                    {{ $project->created_at->format('d-m-Y H:i') }}
                </p>

                <p style="line-height: 1.7;">
                    {{ \Illuminate\Support\Str::limit($project->description, 180) }}
                </p>

                <a
                    href="{{ route('projects.show', $project->id) }}"
                    style="color: #2563eb; text-decoration: none;"
                >
                    Lihat detail
                </a>
            </article>
        @empty
            <div style="
                padding: 30px;
                text-align: center;
                background-color: white;
                border: 1px dashed #9ca3af;
                border-radius: 8px;
            ">
                <h2>Belum ada project</h2>

                <p>
                    Tambahkan data project melalui form tambah project.
                </p>
            </div>
        @endforelse
    </section>
@endsection