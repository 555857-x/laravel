{{-- Tabel project dipakai di halaman index dan search. --}}
<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Tgl. Mulai</th>
                <th>Anggaran</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    {{-- Nomor urut berlanjut antar halaman, halaman 2 mulai dari 11. --}}
                    <td>{{ $projects->firstItem() + $loop->index }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="text-decoration-none">
                            {{ $project->title }}
                        </a>
                    </td>
                    <td>
                        <span class="badge {{ $project->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($project->status) }}
                        </span>
                    </td>
                    <td>{{ $project->started_at?->format('d/m/Y') ?? '-' }}</td>
                    <td>
                        {{ $project->budget !== null ? 'Rp ' . number_format($project->budget, 2, ',', '.') : '-' }}
                    </td>
                    <td>{{ $project->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form
                            action="{{ route('projects.destroy', $project->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Pindahkan project ini ke trash?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3 small text-muted">
    Halaman : {{ $projects->currentPage() }} <br>
    Jumlah Data : {{ $projects->total() }} <br>
    Data Per Halaman : {{ $projects->perPage() }}
</div>

<div class="mt-3">
    {{ $projects->links() }}
</div>
