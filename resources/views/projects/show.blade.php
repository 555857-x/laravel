@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <section style="max-width: 800px; min-height: 500px; margin: 40px auto; padding: 0 20px;">
        @include('partials.flash')

        <article class="card card-body">
            <h1 class="mt-0">{{ $project->title }}</h1>

            <p class="mb-1">
                <span class="badge {{ $project->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($project->status) }}
                </span>
            </p>

            <table class="table table-sm w-auto mt-2">
                <tr>
                    <th>Tanggal Mulai</th>
                    <td>{{ $project->started_at?->format('d/m/Y') ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Anggaran</th>
                    <td>{{ $project->budget !== null ? 'Rp ' . number_format($project->budget, 2, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $project->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Diubah</th>
                    <td>{{ $project->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>

            {{-- Deskripsi di-escape lebih dulu, lalu baris barunya ditampilkan. --}}
            <div style="line-height: 1.8;">
                {!! nl2br(e($project->description)) !!}
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">Edit Project</a>

                <form
                    action="{{ route('projects.destroy', $project->id) }}"
                    method="POST"
                    onsubmit="return confirm('Pindahkan project ini ke trash?')"
                    class="m-0"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Project</button>
                </form>
            </div>
        </article>
    </section>
@endsection
